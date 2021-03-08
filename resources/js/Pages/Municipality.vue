<template>
    <sidebar-layout>
        <page-main-title :title="title"></page-main-title>
        <dump-table :additional="additional" :data="dumps"></dump-table>
    </sidebar-layout>

</template>

<script>
import SidebarLayout from "../Layouts/SidebarLayout";
import shared from "../Plugins/meta";
import PageMainTitle from "../Components/PageMainTitle";
import DumpTable from "../Components/Tables/DumpTable";

export default {
    name: "Municipality",
    components: {
        DumpTable,
        SidebarLayout,
        PageMainTitle
    },
    created() {
        shared.meta(this.meta.title, this.meta.desc);
        this.$store.commit('clearOpenDumpTableIds');
        this.$store.commit('setCurrentPage', this.meta.page);
    },
    computed: {
        /**
         * Page title
         * @returns {string}
         */
        title() {
            return this.meta.title.replace(' - divja odlagališča', '');
        },
    },
    methods: {},
    props: {
        meta: {
            type: Object,
            required: true
        },
        dumps: {
            type: Object,
            required: true
        },
        additional: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            required: false,
            default: {}
        }
    }
}
</script>
