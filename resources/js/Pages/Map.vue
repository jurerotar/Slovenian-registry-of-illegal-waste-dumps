<template>
    <sidebar-layout></sidebar-layout>
</template>

<script>
import shared from '../Plugins/meta';
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: "Map",
    components: {
        SidebarLayout
    },
    created() {
        shared.meta(this.meta.title, this.meta.desc);
        this.$store.commit('setCurrentPage', this.meta.page_name);
    },
    props: {
        meta: {
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

<style scoped>

</style>
