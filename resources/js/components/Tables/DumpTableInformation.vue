<template>
    <div
        v-if="opened"
        class="flex flex-col my-2 pl-4 ml-4 border-l border-gray-300 border-solid h-10"
    />
</template>

<script setup lang = "ts">
import {computed} from 'vue';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store.types.js";

const store = useStore<State>();

const properties = ['desc', 'volume', 'trash_types', 'comments'];
const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    volumes: {
        type: Array,
        required: true
    }
});
const opened = computed(() => store.state.dumpTables.opened.includes(props.data.id));
</script>
