<template>
    <sidebar-layout></sidebar-layout>

</template>

<script>
import SidebarLayout from "../Layouts/SidebarLayout";
import shared from "../Plugins/meta";

export default {
    name: "Report",
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
    }
}
</script>
