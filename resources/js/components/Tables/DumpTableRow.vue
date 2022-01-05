<template>
  <div class="min-w-[800px] flex flex-col w-full">
    <div class="flex flex-row border-b border-solid border-gray-300">
      <div class="flex cursor-pointer items-center p-2 text-left font-semibold w-10">
        <font-awesome-icon
          :icon="['fas', 'chevron-right']"
          :class="{'rotate-90': opened}"
          class="transform inline-flex mb-0 w-8 h-8 transition-all dark:text-white"
          @click="open(data.id)"
        />
      </div>
      <div class="flex flex-1 items-center p-2 text-left dark:text-white">
        {{ data.id }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
        {{ boolToString(data.dangerous) }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
        {{ boolToString(data.cleared) }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
        {{ data.terrain }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white whitespace-nowrap">
        {{ data.access }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
        {{ distance }}
      </div>
      <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
        {{ niceDate(data.date) }}
      </div>
    </div>
  </div>
</template>

<script setup>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {boolToString, niceDate} from "@/jsPlugins/shared";
import {computed, ref} from 'vue';
import {useStore} from 'vuex';
import {library} from '@fortawesome/fontawesome-svg-core'
import {faChevronRight} from "@fortawesome/free-solid-svg-icons";

library.add(faChevronRight);

const store = useStore();
const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
const opened = ref(false);
const distance = computed(() => Object.prototype.hasOwnProperty.call(props.data, 'distance') ?
  `${props.data.distance} km` : '/'
);

/**
 * Push id to store, to open extendable, then update opened property
 * @param {number} id - dump id
 */
const open = (id) => {
    store.commit((opened.value) ? 'removeOpenDumpTableId' : 'addOpenDumpTableId', id);
    opened.value = !opened.value;
}
</script>
