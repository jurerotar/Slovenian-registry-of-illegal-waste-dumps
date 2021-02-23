<template>
    <main :class="{'pointer-events-none': extended && width < breakpoints.md}"
          class="flex justify-center p-4 lg:ml-72 lg:mt-16 dark:bg-dark-main duration-300 transition-colors">
        <div class="max-w-main w-full">
            <slot></slot>
        </div>
    </main>
</template>

<script>
export default {
    name: "Main",
    computed: {
        width() {
            return this.$store.state.width;
        },
        breakpoints() {
            return this.$store.state.breakpoints;
        },
        extended() {
            return this.$store.state.sidebarExtended;
        }
    },
}
</script>
