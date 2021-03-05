<template>
    <div class="min-w-table-dumps flex flex-col w-full">
        <div class="flex flex-row border-b border-solid border-gray-300">
            <div class="flex cursor-pointer items-center p-2 text-left font-semibold w-10">
                <icon :class="{'rotate-90': opened}"
                      @click="open(data.id)"
                      :type="'angleRight'"
                      class="transform inline-flex mb-0 w-8 h-8">
                </icon>
            </div>
            <div class="flex flex-1 items-center p-2 text-left dark:text-white">
                {{ data.id }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
                {{ boolToString(data.dangerous) }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
                {{ boolToString(data.cleared) }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
                {{ data.terrain }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white whitespace-nowrap">
                {{ data.access }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
                {{ distance }}
            </div>
            <div class="flex flex-1 items-center p-2 text-left  dark:text-white">
                {{ niceDate(data.date) }}
            </div>
        </div>
    </div>
</template>

<script>
import Icon from "../Icon";

export default {
    name: "DumpTableRow",
    components: {Icon},
    data() {
        return {
            opened: false
        }
    },
    computed: {
        /**
         * If distance property has been set in the parent, show it with 'km' added, otherwise show '/'
         */
        distance() {
            return (this.data.hasOwnProperty('distance')) ? `${this.data.distance} km` : '/';
        }
    },
    methods: {
        /**
         * Push id to store, to open extendable, then update opened property
         * @param {number} id - dump id
         */
        open(id) {
            this.$store.commit((this.opened) ? 'removeOpenDumpTableId' : 'addOpenDumpTableId', id);
            this.opened = !this.opened;
        },
        /**
         * Formats date from unix timestamp to Slovenian locale
         * @param {number} date - unix timestamp in seconds
         * @returns {string} date - formated date
         */
        niceDate: (date) => {
            return (new Date(date * 1000)).toLocaleDateString('sl-SI');
        },

        boolToString(bool) {
            return (bool) ? 'Da' : 'Ne';
        }
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    }
}
</script>
