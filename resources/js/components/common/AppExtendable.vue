<template>
  <details :open="props.opened">
    <summary
      class="select-none flex whitespace-nowrap justify-start flex-row items-center dark:text-white
            cursor-pointer colors-transition rounded-md bg-transparent py-2 px-4 w-full font-semibold"
      :class="{'md:inline-flex': !props.fullWidth}"
    >
      <font-awesome-icon
        :icon="['fa', 'chevron-right']"
        class="details-icon inline-flex w-8 h-8 mr-4"
        aria-hidden="true"
      />
      {{ props.summary }}
    </summary>
    <div class="my-2 pl-4 ml-4 border-l border-gray-300 border-solid">
      <slot />
    </div>
  </details>
</template>

<script setup lang = "ts">
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {library} from '@fortawesome/fontawesome-svg-core'
import {faChevronRight} from "@fortawesome/free-solid-svg-icons";

library.add(faChevronRight);

interface ExtendableProps {
    opened: boolean;
    summary: string;
    fullWidth?: boolean;
}

const props = withDefaults(defineProps<ExtendableProps>(), {
    opened: false,
    fullWidth: false
});
</script>
