<template>
  <main
    :class="{'pointer-events-none': sidebarExtended && !isLgUp}"
    class="flex p-4 lg:ml-72 lg:mt-16"
  >
    <slot />
  </main>
</template>

<script setup lang = "ts">
import {computed} from "vue";
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";

const store = useStore<State>();
const sidebarExtended = computed<boolean>(() => store.state.appState.sidebarExtended);
const isLgUp = computed<boolean>(() => store.getters.isLgUp);
</script>
