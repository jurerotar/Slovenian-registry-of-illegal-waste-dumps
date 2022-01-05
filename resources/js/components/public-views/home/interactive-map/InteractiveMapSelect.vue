<template>
  <select
    v-model="selectInput"
    class="font-semibold h-10 duration-300 mb-4 lg:mb-0 transition-colors w-full md:w-96 outline-none
        select-none p-2 rounded-md bg-gray-300 dark:bg-zinc-800 dark:text-white"
    @change="updateStore"
  >
    <option
      v-for="option in options"
      :key="option.id"
      :value="option.sortBy"
      :selected="option.sortBy === selected"
    >
      {{ option.text }}
    </option>
  </select>
</template>

<script setup lang="ts">
import {useStore} from 'vuex';
import {computed, ref} from 'vue';
import {State} from "@/js/stores/store";

interface InteractiveMapSelectOptions {
    id: number;
    text: string;
    sortBy: string;
}

const store = useStore<State>();

const selected = computed<string>(() => store.state.appState.interactiveMapSelectedRegion);

const selectInput = ref<string>(selected.value);

const updateStore = (): void => {
    store.commit('appState/setInteractiveMapSelectedRegion', selectInput.value);
}

const options: InteractiveMapSelectOptions[] = [
    {
        id: 0,
        text: 'Skupnem številu odlagališč',
        sortBy: 'total'
    },
    {
        id: 1,
        text: 'Odstotku že očiščenih odlagališč',
        sortBy: 'clearedPercentage'
    },
    {
        id: 2,
        text: 'Številu še neočiščenih odlagališč',
        sortBy: 'uncleared'
    },
    {
        id: 3,
        text: 'Skupnem številu odlagališč na km2',
        sortBy: 'totalByArea',
    },
    {
        id: 4,
        text: 'Številu še neočiščenih odlagališč na km2',
        sortBy: 'unclearedByArea',
    },
    {
        id: 5,
        text: 'Skupnem številu odlagališč na prebivalca',
        sortBy: 'totalByPopulation'
    },
    {
        id: 6,
        text: 'Številu še neočiščenih odlagališč na prebivalca',
        sortBy: 'unclearedByPopulation'
    },
];

</script>
