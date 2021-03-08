<template>
    <sidebar-layout>
        <div class="">
            <page-main-title :title="'Izvoz podatkov'"></page-main-title>
            <p class="dark:text-white mb-4">Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck
                bacon,
                drumstick salami beef ribs ball tip porchetta. Bacon ipsum dolor amet hamburger doner filet mignon pork
                shankle chuck bacon, drumstick salami beef ribs ball tip porchetta. Bacon ipsum dolor amet hamburger
                doner
                filet mignon pork shankle chuck bacon, drumstick salami beef ribs ball tip porchetta.
            </p>
            <extendable :opened="true" :summary="'Pogoji uporabe'">
                <!-- Terms and conditions -->
                <export-terms-and-conditions class="my-2"></export-terms-and-conditions>
                <p v-if="!agreed" class="text-red-600 font-semibold">Izvoz podatkov je mogoč šele po potrditvi pogojev
                    uporabe.</p>
                <p v-else class="text-green-600 font-semibold">Podatki so pripravljeni za izvoz.</p>
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox"
                           :checked="agreed"
                           class="cursor-pointer form-checkbox h-5 w-5 rounded-md border-default border-solid border-black dark:border-none outline-none"
                           @change="toggleExportAgreement()">
                    <span class="ml-2 dark:text-white">Strinjam se z zgoraj naštetimi pogoji uporabe.</span>
                </label>
            </extendable>
            <!--        <Extendable :opened="false" :summary="'Primer izvoza'">-->
            <!--            <ExportExample></ExportExample>-->
            <!--        </Extendable>-->
            <!-- Filter input field -->
            <label class="flex flex-col max-w-export my-5">
                <span class="mb-2 text-lg dark:text-white">Filtriraj po imenu</span>
                <input type="text"
                       class="outline-none dark:bg-dark-nav dark:text-white text-gray-600 block w-full h-10 p-4 border-gray
                   border-default border-solid transition-colors duration-300 rounded-md"
                       v-model.trim="filter"
                       placeholder="..."
                >
            </label>
            <!-- Table of contents
            <details class="flex flex-col">
                <summary class="">
                    <p class="text-black dark:text-white text-2xl my-4">Kazalo</p>
                </summary>
                <a :href="`#${letter.letter}`" class="inline-flex my-2 text-black dark:text-white text-xl"
                   v-for="letter in firstLetters"
                   :key="letter.id">{{ letter.letter }}</a>
            </details>
            -->

            <div class="flex flex-col gap-y-4 w-full">
                <!-- Filtered data -->
                <div class="flex flex-col w-full" v-for="letter in firstLetters"
                     :key="letter.id" :id="letter.letter">
                    <h3 class="text-black dark:text-white text-2xl my-4">{{ letter.letter }}</h3>
                    <div class="w-full overflow-x-scroll lg:overflow-x-auto">
                        <export-table :data="dataByFirstLetter(letter.letter)"></export-table>
                    </div>
                </div>
                <!-- All data -->
                <h3 class="text-black dark:text-white text-2xl my-4">Izvoz vseh podatkov</h3>
                <div class="w-full overflow-x-scroll lg:overflow-x-auto">
                    <export-table :data="[total]"></export-table>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>


<script>
import PageMainTitle from "../Components/PageMainTitle";
import ExportTable from "../Components/Tables/ExportTable";
import ExportTermsAndConditions from "../Components/ExportTermsAndConditions";
import Extendable from "../Components/Extendable";
import ExportExample from "../Components/CodeExamples/ExportExample";
import SidebarLayout from "../Layouts/SidebarLayout";
import shared from "../Plugins/meta";

export default {
    name: 'Export',
    components: {
        ExportTable,
        ExportTermsAndConditions,
        Extendable,
        ExportExample,
        SidebarLayout,
        PageMainTitle,
    },
    created() {
        shared.meta(this.meta.title, this.meta.desc);
        this.$store.commit('setCurrentPage', this.meta.page);
    },
    data() {
        return {
            filter: '',
            specific: this.metadata.specific,
            total: this.metadata.total
        }
    },
    computed: {
        /**
         * Joins regions and municipalities, filters them by typed letters in filter input field
         * and sorts alphabetically
         * @returns {Array<Object>}
         */
        filtered() {
            return this.specific
                .filter(el => el.name.toLowerCase().includes(this.filter.toLowerCase()))
                .sort((a, b) => a.name.localeCompare(b.name));
        },
        /**
         * Returns array of first letters of currently filtered objects
         * @returns {[{letter: string, id: number}]}
         */
        firstLetters() {
            return Array.from(new Set(this.filtered.map(el => el.name.charAt(0)))).map((el, index) => {
                return {
                    id: index + 1,
                    letter: el
                }
            });
        },
        /**
         * @returns {boolean}
         */
        agreed() {
            return this.$store.state.termsAndConditionsAgreements.exportTermsAndConditions;
        }
    },
    methods: {
        /**
         * Returns objects from filtered which start with a specific letter
         * @param {string} letter
         * @returns {Array<Object>}
         */
        dataByFirstLetter(letter) {
            return this.filtered.filter(el => el.name.charAt(0).toLowerCase() === letter.toLowerCase());
        },
        toggleExportAgreement() {
            this.$store.commit('setTermsAndConditionsAgreements', 'exportTermsAndConditions');
        }
    },
    props: {
        meta: {
            type: Object,
            required: true
        },
        metadata: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            required: false,
            default: {}
        }
    },
}
</script>
