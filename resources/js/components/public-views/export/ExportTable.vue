<template>
  <table class="min-w-table tbl w-full colors-transition dark:text-white">
    <tr>
      <th class="text-left w-32 md:w-44 ">
        Ime
      </th>
      <th class="text-left w-20">
        Vrsta
      </th>
      <th class="text-left w-20">
        Število vnosov
      </th>
      <th class="text-left w-20">
        Posodobljeno
      </th>
      <th class="text-left w-20">
        Končnica
      </th>
      <th class="text-left w-20">
        Prenos
      </th>
    </tr>
    <tr
      v-for="row in props.data"
      :key="row.id"
    >
      <td class="text-left w-32 md:w-44">
        {{ row.name }}
      </td>
      <td class="text-left w-20">
        {{ type(row.type) }}
      </td>
      <td class="text-left w-20">
        {{ row.dump_count }}
      </td>
      <td class="text-left w-20">
        {{ niceDate(row.updated_at) }}
      </td>
      <td class="text-left w-20">
        json
      </td>
      <td class="text-left">
        <app-button
          class="font-semibold rounded-lg px-4 py-2 text-white text-center colors-transition inline-flex"
          :disabled="!hasAgreed"
        >
          <font-awesome-icon
            :icon="['fas', 'download']"
            class="mr-2 h-5 w-5"
          />
          Prenesi
        </app-button>
      </td>
    </tr>
  </table>
</template>

<script setup lang = "ts">
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {niceDate} from "@/js/helpers/functions";
import {computed} from 'vue';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faDownload} from "@fortawesome/free-solid-svg-icons";
import AppButton from "@/js/components/common/buttons/AppButton.vue";
import {ExportDataObject} from "@/js/views/public/Export.vue";

library.add(faDownload);

export interface ExportTableProps {
    data: ExportDataObject[];
}

const props = defineProps<ExportTableProps>();

const store = useStore<State>();
const hasAgreed = computed<boolean>(() => store.state.appState.agreements.dataExport);

// Returns a translated type or '/' if none was set
const type = (type: string): string => {
    const types = {
        'all': 'Skupno',
        'region': 'Regija',
        'municipality': 'Občina'
    }
    return types[type] ?? '/';
}

const download = async (slug, type) => {

}
</script>
