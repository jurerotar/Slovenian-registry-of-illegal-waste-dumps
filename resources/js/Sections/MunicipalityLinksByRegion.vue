<template>
    <ul>
        <li v-for="region in regions" :key="region.id">
            <details>
                <summary class="select-none flex whitespace-nowrap justify-start flex-row items-center
                                        outline-none cursor-pointer transition-colors duration-300
                                        rounded-md py-2">
                    <div class="flex md:inline-flex whitespace-nowrap justify-start flex-row items-center">
                        <Icon :type="'angleRight'" class="details-icon inline-flex mb-0 w-8 h-8"></Icon>
                        <h3 class="dark:text-white md:ml-2 font-semibold">{{ region.name }}</h3>
                    </div>
                </summary>
                <div
                    class="flex flex-col items-start justify-center ml-4 pl-4 border-l-2 border-solid border-gray-300">
                    <!--                             <span class="text-xs bg-green-500 rounded-md px-3 py-1 text-white font-semibold mb-2">-->
                    <!--                                 Regija-->
                    <!--                             </span>-->
                    <!--                    <inertia-link :href="`/regija/${region.slug}`" class="dark:text-white font-semibold-->
                    <!--                            inline-flex pl-4 border-l-2 border-solid border-green-500 mb-2">-->
                    <!--                        Podatki o regiji-->
                    <!--                    </inertia-link>-->
                    <span class="text-xs bg-blue-500 rounded-md px-3 py-1 text-white font-semibold mb-2">
                                Občine
                            </span>
                    <ul class="pl-4 border-l-2 border-blue-500 border-solid">
                        <li class="flex flex-col justify-center items-start mb-2"
                            v-for="municipality in region.municipalities" :key="municipality.id">
                            <inertia-link :href="`/obcina/${municipality.slug}`"
                                          class="dark:text-white font-semibold">
                                {{ municipality.name }}
                            </inertia-link>
                        </li>
                    </ul>
                </div>
            </details>
        </li>
    </ul>
</template>

<script>
import Icon from "../Components/Icon";

export default {
    name: "MunicipalityLinksByRegion",
    components: {
        Icon,
    },
    data() {
        return {
            regions: window.globalData.regions,
        }
    }
}
</script>

<style scoped>

</style>
