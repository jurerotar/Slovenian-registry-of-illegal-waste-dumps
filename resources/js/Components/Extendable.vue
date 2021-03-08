<template>
    <details :open="opened" class="mb-4">
        <summary
            class="select-none flex whitespace-nowrap justify-start flex-row items-center
            outline-none cursor-pointer transition-colors duration-300 rounded-md bg-gray-200 py-2 px-4 dark:bg-dark-nav"
            :class="{'md:inline-flex': !fullWidth}">
            <div class="flex md:inline-flex whitespace-nowrap justify-start flex-row items-center">
                <icon :type="'angleRight'" class="details-icon inline-flex mb-0 w-8 h-8"></icon>
                <h3 class="dark:text-white ml-2 font-semibold">{{ summary }}</h3>
            </div>
        </summary>
        <div class="my-2 pl-4 ml-4 border-l border-gray-300 border-solid">
            <slot></slot>
        </div>
    </details>
</template>

<script>
import Icon from "./Icon";

export default {
    name: "Extendable",
    components: {
        Icon,
    },
    props: {
        opened: {
            type: Boolean,
            required: false
        },
        summary: {
            type: String,
            required: true
        },
        fullWidth: {
            type: Boolean,
            required: false,
            default: false
        }
    }
}
</script>
