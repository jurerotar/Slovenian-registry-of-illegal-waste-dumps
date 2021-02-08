<template>
    <SidebarLayout :currentPage="currentPage">
        <h1 class="text-3xl dark:text-white">Izvoz podatkov</h1>
        <label class="flex flex-col max-w-export my-5">
            <span class="text-gray-700 mb-2 text-lg dark:text-white">Filtriraj po imenu</span>
            <input type="text"
                   class="outline-none dark:bg-dark-nav dark:text-white text-gray-600 block w-full h-10 p-4 border-gray
                   border-default border-solid transition-colors duration-300 rounded-md"
                   v-model.trim="filter" placeholder="...">
        </label>
        <div class="flex flex-col gap-y-4 w-full">
            <div class="flex flex-col w-full" v-for="letter in firstLetters"
                 :key="letter.id">
                <p class="text-black dark:text-white text-2xl my-4">{{ letter.letter }}</p>
                <div class="w-full overflow-x-scroll lg:overflow-x-auto">
                    <Table :data="dataByFirstLetter(letter.letter)"></Table>
                </div>
            </div>
            <p class="text-black dark:text-white text-2xl my-4">Izvoz vseh podatkov</p>
            <div class="w-full overflow-x-scroll lg:overflow-x-auto">
                <Table :data="[total]"></Table>
            </div>
        </div>
    </SidebarLayout>
</template>


<script>
import SidebarLayout from "../Layouts/SidebarLayout";
import Table from "../Components/Table";

export default {
    name: 'Export',
    components: {
        SidebarLayout,
        Table
    },
    data() {
        return {
            filter: '',
            regions: this.metadata.regions,
            municipalities: this.metadata.municipalities,
            total: this.metadata.total
        }
    },
    computed: {
        filtered() {
            return [...this.regions, ...this.municipalities]
                .filter(el => el.name.toLowerCase().includes(this.filter.toLowerCase()))
                .sort((a, b) => a.name.localeCompare(b.name));
        },
        firstLetters() {
            return Array.from(new Set(this.filtered.map(el => el.name.charAt(0)))).map((el, index) => {
                return {
                    id: index + 1,
                    letter: el
                }
            });
        }
    },
    methods: {
        dataByFirstLetter(letter) {
            return this.filtered.filter(el => el.name.charAt(0).toLowerCase() === letter.toLowerCase());
        }
    },
    props: {
        currentPage: {
            type: String,
            required: true
        },
        metadata: {
            type: Object,
            required: true
        }
    },
}
</script>

<style>
.bvb * {
    display: flex
}
</style>
