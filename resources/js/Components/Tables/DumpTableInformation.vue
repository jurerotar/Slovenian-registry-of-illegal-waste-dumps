<template>
    <div v-if="opened" class="flex flex-col my-2 pl-4 ml-4 border-l border-gray-300 border-solid h-10">

    </div>
</template>

<script>

export default {
    name: "DumpTableInformation",
    data() {
        return {
            properties: [
                'desc',
                'volume',
                'trash_types',
                'comments'
            ]
        }
    },
    computed: {
        existingProperties() {
            return this.data;
        },
        opened() {
            return this.$store.state.dumpTables.opened.includes(this.data.id);
        }
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        volumes: {
            type: Array,
            required: true
        }
    }
}
</script>
