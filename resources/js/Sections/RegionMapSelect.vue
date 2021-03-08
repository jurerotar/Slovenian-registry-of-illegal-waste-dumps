<template>
    <select
        class="font-semibold h-10 duration-300 mb-4 lg:mb-0 transition-colors w-full md:w-96 outline-none select-none p-2 rounded-md bg-gray-300 dark:bg-dark-nav dark:text-white"
        v-model="selected"
        @change="select(selected)">
        <option v-for="option in data" :key="option.id" :value="option.sortBy"
                :selected="option.sortBy">
            {{ option.text }}
        </option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            selected: 'total',
            data: [
                {
                    id: 0,
                    text: 'Skupnem številu odlagališč',
                    sortBy: 'total'
                },
                {
                    id: 1,
                    text: 'Odstotku že očiščenih odlagališč',
                    sortBy: 'clearedPercentage'
                },
                {
                    id: 2,
                    text: 'Številu še neočiščenih odlagališč',
                    sortBy: 'uncleared'
                },
                {
                    id: 3,
                    text: 'Številu nevarnih odlagališč',
                    sortBy: 'dangerous'
                },
                {
                    id: 4,
                    text: 'Skupnem številu odlagališč na km2',
                    sortBy: 'totalByArea',
                },
                {
                    id: 5,
                    text: 'Številu še neočiščenih odlagališč na km2',
                    sortBy: 'unclearedByArea',
                },
                {
                    id: 6,
                    text: 'Skupnem številu odlagališč na prebivalca',
                    sortBy: 'totalByPopulation'
                },
                {
                    id: 7,
                    text: 'Številu še neočiščenih odlagališč na prebivalca',
                    sortBy: 'unclearedByPopulation'
                },
            ]
        };
    },
    methods: {
        /**
         * Commits currently selected option to store
         * @param {string} key - selected option
         */
        select(key) {
            this.$store.commit('setInteractiveMapSelected', key);
        }
    }
};
</script>

<style scoped>
.max-height-48 {
    max-height: 200px;
}
</style>
