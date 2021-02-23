<template>
    <sidebar-layout :currentPage="currentPage"></sidebar-layout>

</template>

<script>
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: "Report",
    components: {
        SidebarLayout
    },
    props: {
        currentPage: {
            type: String,
            required: true
        },
    }
}
</script>
