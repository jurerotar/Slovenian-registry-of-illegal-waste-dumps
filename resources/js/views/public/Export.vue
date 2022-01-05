<template>
  <div class="flex flex-col gap-4">
    <app-head />
    <app-section-heading>
      Izvoz podatkov
    </app-section-heading>
    <app-paragraph>
      Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck
      bacon,
      drumstick salami beef ribs ball tip porchetta. Bacon ipsum dolor amet hamburger doner filet mignon pork
      shankle chuck bacon, drumstick salami beef ribs ball tip porchetta. Bacon ipsum dolor amet hamburger
      doner
      filet mignon pork shankle chuck bacon, drumstick salami beef ribs ball tip porchetta.
    </app-paragraph>
    <!-- Terms and conditions -->
    <extendable
      :opened="true"
      :summary="'Pogoji uporabe'"
    >
      <export-terms-and-conditions class="my-2" />
      <p
        v-if="!agreed"
        class="text-red-600 font-semibold"
      >
        Izvoz podatkov je mogoč šele po potrditvi pogojev uporabe.
      </p>
      <p
        v-else
        class="text-green-600 font-semibold"
      >
        Podatki so pripravljeni za izvoz.
      </p>
      <div class="inline-flex items-center mt-3 items-center justify-start">
        <app-checkbox
          :checked="agreed"
          @change="toggleExportAgreement()"
        />
        <app-input-label class="ml-2 mb-0">
          Strinjam se z zgoraj naštetimi pogoji uporabe
        </app-input-label>
      </div>
    </extendable>
    <!-- Filter -->
    <div class="flex flex-col gap-2">
      <app-input-label for="export_filter">
        Filtriraj po imenu
      </app-input-label>
      <app-input
        id="export_filter"
        v-model.trim="filter"
        type="text"
        placeholder="..."
        class="max-w-[400px]"
        @input="updateFilter($event.target.value)"
      />
    </div>
    <!-- Unfiltered data -->
    <div
      v-if="filter === ''"
      class="flex flex-col gap-y-4 w-full"
    >
      <!-- All data -->
      <app-section-heading>
        Izvoz vseh podatkov
      </app-section-heading>
      <div class="w-full overflow-x-scroll lg:overflow-x-auto">
        <export-table :data="allData" />
      </div>
      <!-- Region data -->
      <app-section-heading>
        Izvoz podatkov po regijah
      </app-section-heading>
      <div class="w-full overflow-x-scroll lg:overflow-x-auto">
        <export-table :data="regionData" />
      </div>
      <!-- Municipality data -->
      <div class="flex flex-col w-full">
        <app-section-heading>
          Izvoz podatkov po občinah
        </app-section-heading>
        <div
          v-for="letter in firstLetters"
          :id="letter"
          :key="letter"
          class="flex flex-col w-full"
        >
          <h4 class="text-black dark:text-white text-xl my-4">
            {{ letter }}
          </h4>
          <div class="w-full overflow-x-scroll lg:overflow-x-auto">
            <export-table :data="dataByFirstLetter(letter)" />
          </div>
        </div>
      </div>
    </div>
    <!-- Filtered data -->
    <div
      v-else
      class="flex flex-col gap--4 w-full"
    >
      <div
        v-for="letter in firstLetters"
        :id="letter"
        :key="letter"
        class="flex flex-col w-full"
      >
        <h3 class="text-black dark:text-white text-2xl my-4">
          {{ letter }}
        </h3>
        <div class="w-full overflow-x-scroll lg:overflow-x-auto">
          <export-table :data="dataByFirstLetter(letter)" />
        </div>
      </div>
    </div>
  </div>
</template>


<script setup lang = "ts">
import ExportTable from "@/js/components/public-views/export/ExportTable.vue";
import ExportTermsAndConditions from "@/js/components/public-views/export/ExportTermsAndConditions.vue";
import Extendable from "@/js/components/common/AppExtendable.vue";
import AppHead from "@/js/components/common/AppHead.vue";
import {computed, ref} from 'vue';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import AppSectionHeading from "@/js/components/common/AppSectionHeading.vue";
import AppCheckbox from "@/js/components/common/AppCheckbox.vue";
import AppInputLabel from "@/js/components/common/AppInputLabel.vue";
import AppInput from "@/js/components/common/AppInput.vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {InertiaPageProps, MunicipalityExportData, RegionExportData} from "@/js/types/inertia";
import AppParagraph from "@/js/components/common/AppParagraph.vue";

export interface ExportDataObject {
    id: number;
    name: string;
    type: string;
    updated_at: number;
    dump_count: number;
}

const store = useStore<State>();
const agreed = computed<boolean>(() => store.state.appState.agreements.dataExport);
const toggleExportAgreement = (): void => store.commit('appState/setExportAgreement', !agreed.value);

const {exports} = usePage<InertiaPageProps>().props.value;

console.log(exports);

// User search query
const filter = ref<string>('');
const updateFilter = (value: string) => filter.value = value;

const flattenedExports: ExportDataObject[] = [
    // All dumps
    {
        id: 0,
        name: 'Skupno',
        type: 'all',
        updated_at: Math.max(...exports.map(r => r.updated_at)),
        dump_count: exports.reduce((carry, item) => carry + item.dump_count, 0)
    },
    // Dumps by region
    ...exports.map((region: RegionExportData) => [
        {
            id: region.id,
            name: region.name,
            type: 'region',
            updated_at: region.updated_at,
            dump_count: region.dump_count
        },
        // Dumpy by municipality
        ...region.municipalities.map((municipality: MunicipalityExportData) => [
            {
                id: municipality.id,
                name: municipality.name,
                type: 'municipality',
                updated_at: municipality.updated_at,
                dump_count: municipality.dump_count
            }
        ])
    ]).flat()
].flat();

const allData: ExportDataObject[] = flattenedExports.filter((dataset: ExportDataObject) => dataset.type === 'all');
const regionData: ExportDataObject[] = flattenedExports.filter((dataset: ExportDataObject) => dataset.type === 'region');
const municipalityData: ExportDataObject[] = flattenedExports.filter((dataset: ExportDataObject) => dataset.type === 'municipality');

// Joins regions and municipalities, filters them by typed letters in filter input field and sorts alphabetically
const filtered = computed<ExportDataObject[]>(
    () => flattenedExports.filter((el: ExportDataObject) => el.name.toLowerCase().includes(filter.value.toLowerCase()))
    .sort((a: ExportDataObject, b: ExportDataObject) => a.name.localeCompare(b.name)));

// Returns array of first letters of currently filtered objects
const firstLetters = computed<string[]>(() => {
    const arrayToFilter = filter.value === '' ? municipalityData : filtered.value;
    return Array.from(new Set(arrayToFilter.map(el => el.name.charAt(0)))).map(el => el)
});



// Returns data from filtered which start with a specific letter
const dataByFirstLetter = (letter: string): ExportDataObject[] => {
    return filtered.value.filter(el => el.name.charAt(0).toLowerCase() === letter.toLowerCase());
}

</script>
