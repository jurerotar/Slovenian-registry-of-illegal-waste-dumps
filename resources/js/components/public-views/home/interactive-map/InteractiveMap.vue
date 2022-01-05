<template>
  <div class="flex flex-col max-w-[1400px] gap-4">
    <div class="flex flex-col gap-4">
      <app-section-heading>
        Interaktivni zemljevid odlagališč
      </app-section-heading>
      <p class="dark:text-white">
        Regije so obarvane z različnimi barvami, ki korelirajo z izračunano vrednostjo pri izbranem kriteriju,
        kjer so regije z boljšimi rezultati obarvane bolj
        <span
          class="font-semibold"
          style="color:#02cf45"
        >
          zeleno
        </span>,
        regije z slabšim rezultatom pa bolj
        <span
          class="font-semibold"
          style="color:#ff0000"
        >
          rdeče
        </span>.
      </p>
      <p class="dark:text-white text-lg font-semibold">
        Prikaži stanje v regijah po:
      </p>
    </div>
    <region-map-select />

    <svg viewBox="28 192 900 600">
      <g
        v-for="region in regionShapes"
        :key="region.id"
        stroke="#FFF"
        stroke-width=".4"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <!-- Link around each region -->
        <inertia-link
          :href="url(region.id)"
          :title="`${region.name} regija`"
          :aria-label="`${region.name} regija`"
        >
          <path
            :fill="color(region.id)"
            class="colors-transition"
            :d="region.path"
          />
          <svg
            :x="region.flagCoordinates.x"
            :y="region.flagCoordinates.y"
            width="70"
            height="65"
            text-anchor="middle"
          >
            <svg viewBox="0 0 34.21 29.62">
              <polygon
                class="svg-poly"
                points="0 0 0 20.84 27.35 20.84 34.21 29.62 34.21 20.84 34.21 0 0 0"
              />
            </svg>
            <text
              x="50%"
              y="47%"
              class="svg-text"
            >
              {{ amount(region.id) }}
              <tspan v-if="unit">
                {{ unit }}
              </tspan>
            </text>
          </svg>
        </inertia-link>
      </g>
    </svg>
  </div>
</template>


<script
    setup
    lang="ts"
>
import RegionMapSelect from "@/js/components/public-views/home/interactive-map/InteractiveMapSelect.vue";

import {computed} from 'vue';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import {InertiaPageProps, InteractiveMapData} from "@/js/types/inertia";
import {usePage} from "@inertiajs/inertia-vue3";
import {colors, regionShapes} from "@/js/helpers/interactive-map";
import AppSectionHeading from "@/js/components/common/AppSectionHeading.vue";

interface Methods {
    [property: string]: MethodProperties
}

interface MethodProperties {
    orderBy: OrderBy;
    // eslint-disable-next-line no-unused-vars
    fn: (el: InteractiveMapData) => number;
    unit: string | null;
    best?: number;
}

interface ViewData {
    id: number;
    n: number
}

type OrderBy = 'desc' | 'asc';

const store = useStore<State>();
const interactiveMapSelectedRegion = computed<string>(() => store.state.appState.interactiveMapSelectedRegion);

const {interactiveMapData} = usePage<InertiaPageProps>().props.value;

// Defines methods and order direction by which to display data on region map
const methods: Methods = {
    total: {
        orderBy: 'desc',
        fn: (el) => el.total,
        unit: null
    },
    clearedPercentage: {
        orderBy: 'asc',
        fn: (el) => (el.total / el.cleared) * 10,
        best: 100,
        unit: '%'
    },
    uncleared: {
        orderBy: 'desc',
        fn: (el) => el.uncleared,
        unit: null
    },
    totalByArea: {
        orderBy: 'desc',
        fn: (el) => el.total / el.area,
        unit: null
    },
    unclearedByArea: {
        orderBy: 'desc',
        fn: (el) => el.uncleared / el.area,
        unit: null
    },
    totalByPopulation: {
        orderBy: 'desc',
        fn: (el) => el.total / el.population,
        unit: null
    },
    unclearedByPopulation: {
        orderBy: 'desc',
        fn: (el) => el.uncleared / el.population,
        unit: null
    },
}

// Sorts the data based on the selected method
const sorted = computed<ViewData[]>(() => {
    const selected: MethodProperties = methods[interactiveMapSelectedRegion.value];
    return interactiveMapData.map((el: InteractiveMapData) => {
        return {
            id: el.id,
            n: selected.fn(el)
        }
    }).sort(orderBy(selected.orderBy));
});

// Fetches currently used unit
const unit = computed<string | null>(() => methods[interactiveMapSelectedRegion.value].unit);

// Returns the highest value of currently used values based on sorting direction
const highest = computed<number>(() => {
    const direction: OrderBy = methods[interactiveMapSelectedRegion.value].orderBy;
    return (direction === 'asc') ? sorted.value[sorted.value.length - 1].n : sorted.value[0].n;
});

// Retrieves the region url
const url = (regionId: number): string => {
    const slug: string | undefined = interactiveMapData.find(
        (el: InteractiveMapData) => el.id === regionId
    )!.slug;
    return `/regions/${slug}`;
}

// Calculates color code by calculating relative value to max value by selected orderBy method
const color = (regionId: number): string => {
    const selectedSortingMethod = methods[interactiveMapSelectedRegion.value];
    const highestValue: number = highest.value;
    const regionValue: number = sorted.value.find(el => el.id === regionId)!.n;
    const partial: number = regionValue / highestValue;
    // We define relative value depending on order direction.
    const relativeValue: number = (selectedSortingMethod.orderBy === 'asc') ? partial : 1 - partial;
    return colors[Math.round(relativeValue * colors.length)] ?? colors[colors.length - 1];
}

// Determines the order function to be used
const orderBy = (direction: OrderBy) => {
    return (a: ViewData, b: ViewData) => (direction === 'asc') ? a.n - b.n : b.n - a.n;
}

// Calculates the amount that will be displayed on the map
const amount = (regionId: number): number => {
    const multiplier: number = (unit.value === '%') ? 10 : 1000;
    return Math.round(sorted.value!.find((el: ViewData) => el.id === regionId)!.n * multiplier) / multiplier;
}

</script>

<style scoped>
svg .svg-text {
    stroke-width: 0;
    fill: white;
    font-family: Montserrat, sans-serif;
    font-size: 20px;
}

svg .svg-poly {
    stroke-width: 0;
}
</style>

