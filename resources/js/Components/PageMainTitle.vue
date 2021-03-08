<template>
    <h1 class="text-3xl dark:text-white mb-4">{{ title }}</h1>
</template>

<script>
export default {
    name: "PageMainTitle",
    props: {
        title: {
            type: String,
            required: true,
        }
    }
}
</script>
