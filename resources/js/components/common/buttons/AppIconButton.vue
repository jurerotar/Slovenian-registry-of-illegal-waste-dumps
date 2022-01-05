<template>
  <div
    class="flex items-center p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 colors-300
        accessible:rounded-none accessible:ring-2 accessible:ring-gray-100 accessible:hover:ring-blue-500
        reduced-motion:bg-transparent cursor-pointer"
  >
    <div class="mr-2 rounded-full p-2 colors-300 bg-blue-400 dark:bg-gray-600 flex items-center justify-center">
      <font-awesome-icon
        fixed-width
        class="!w-[0.875em] !h-[0.875em] colors-300 text-xl text-white dark:text-gray-800"
        :icon="props.icon"
      />
    </div>
    <span class="text-gray-900 dark:text-white high-contrast:font-semibold colors-300">
      {{ props.label }}
    </span>
  </div>
</template>

<script setup lang="ts">
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';


export interface IconButton {
    label: string,
    icon: string[]
}

const props = defineProps<IconButton>();
</script>

