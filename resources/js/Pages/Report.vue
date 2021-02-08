<template>
    <SidebarLayout :currentPage="currentPage">

    </SidebarLayout>
</template>

<script>
import SidebarLayout from "../Layouts/SidebarLayout";

export default {
    name: "Report",
    components: {
        SidebarLayout,
    },
    props: {
        currentPage: {
            type: String,
            required: true
        },
    }
}
</script>
