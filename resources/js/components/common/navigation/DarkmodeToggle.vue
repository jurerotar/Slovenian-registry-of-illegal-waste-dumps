<template>
    <div
        class="tab cursor-pointer flex flex-row relative bg-gray-100 dark:bg-zinc-900 p-1 rounded-3xl items-center
        transition-transform duration-300 justify-center w-[5.5rem] h-8"
        tabindex="0"
        role="button"
        @click="toggle()"
        @keyup.enter="toggle()"
    >
        <div
            :class="mode === 'dark' ? 'back' : 'front'"
            class="flex flex-row justify-center items-center w-full h-full absolute top-0 left-0
            transition-transform duration-300"
        >
            <font-awesome-icon
                :icon="['fa', 'sun']"
                class="mr-1 w-4 h-4 colors-transition text-gray-600"
            />
            <p class="text-sm text-black select-none font-medium colors-transition">
                Svetlo
            </p>
        </div>
        <div
            :class="mode === 'dark' ? 'front' : 'back'"
            class="flex flex-row justify-center items-center w-full h-full absolute top-0 left-0
            transition-transform duration-300"
        >
            <font-awesome-icon
                :icon="['fa', 'moon']"
                class="colors-transition dark:text-white mr-1 w-4 h-4"
            />
            <p class="text-sm text-white select-none font-medium colors-transition">
                Temno
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {ref} from 'vue';
import axios from "axios";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faMoon, faSun} from "@fortawesome/free-solid-svg-icons";

library.add(faMoon, faSun);

const classValue: string = document.querySelector('html')!.classList[0];

const mode = ref<string>(!['light', 'dark'].includes(classValue) ? 'light' : classValue);

// Updates <html> class and creates a post request to api to update cookies
const toggle = async () => {
    try {
        const html: HTMLHtmlElement = document.querySelector('html')!;
        html.classList.remove(mode.value);
        mode.value = mode.value === 'dark' ? 'light' : 'dark';
        html.classList.add(mode.value);
        await axios.post('api/preferences/update-color-scheme', {
            scheme: mode.value
        });
    } catch (e) {
        console.log('Error updating color scheme');
    }
}
</script>

<style>
.tab {
    -webkit-tap-highlight-color: transparent;
}

.front {
    transition: opacity .3s;
    opacity: 1;
}

.back {
    transition-delay: .3s;
    transition: opacity .3s;
    opacity: 0;
}
</style>
