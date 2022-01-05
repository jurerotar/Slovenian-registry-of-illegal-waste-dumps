<template>
  <inertia-link
    href="/"
    class="flex flex-row lg:flex-col items-center justify-center"
    tabindex="0"
  >
    <img
      src="/images/logo.svg"
      alt="Logotip registra divjih odlagališč Slovenije"
      class="h-10 w-10 lg:w-20 lg:h-20 lg:mb-5"
      :height="isLgUp ? 80 : 40"
      :width="isLgUp ? 80 : 40"
    >
    <div class="flex flex-col ml-4 lg:ml-0">
      <p class="colors-transition font-semibold text-center text-xs md:text-base dark:text-white whitespace-nowrap">
        Register divjih odlagališč
      </p>
      <p class="colors-transition font-semibold text-sm md:text-2xl text-left lg:text-center dark:text-white">
        Slovenije
      </p>
    </div>
  </inertia-link>
</template>
<script
  setup
  lang="ts"
>
import {useStore} from "vuex";
import {State} from "@/js/stores/store";
import {computed} from "vue";

const store = useStore<State>();
const isLgUp = computed<boolean>(() => store.getters.isLgUp);
</script>
