<template>
    <div
        class="tab cursor-pointer flex flex-row relative bg-gray-100 dark:bg-dark-main p-1 rounded-3xl items-center transition-transform duration-300 justify-center w-20 h-8"
        @click="toggle()"
    >
        <div
            :class="mode == 'dark' ? 'back' : 'front'"
            class="flex flex-row justify-center items-center w-full h-full absolute top-0 left-0 transition-transform duration-300"
        >
            <Icon
                :type="'lightmode'"
                :size="4"
                class="mr-1"
                :color="'black'"
            ></Icon>
            <p
                class="text-sm text-black select-none font-medium transition-colors duration-300"
            >
                Light
            </p>
        </div>
        <div
            :class="mode == 'dark' ? 'front' : 'back'"
            class="flex flex-row justify-center items-center w-full h-full dar absolute top-0 left-0 transition-transform duration-300"
        >
            <Icon
                :type="'darkmode'"
                :size="4"
                class="mr-1"
                :color="'white'"
            ></Icon>
            <p
                class="text-sm text-white select-none font-medium transition-colors duration-300"
            >
                Dark
            </p>
        </div>
    </div>
</template>

<script>
import Icon from "./Icon";
import axios from 'axios';

export default {
    name: 'DarkmodeToggle',
    components: {
        Icon
    },
    data() {
        return {
            mode: this.state
        }
    },
    mounted() {
        let mode = document.querySelector('html').classList[0];
        if (!['light', 'dark'].includes(mode)) {
            mode = 'light';
        }
        this.mode = mode;
    },
    methods: {
        toggle() {
            const html = document.querySelector('html');
            html.classList.remove(this.mode);
            this.mode = this.mode === 'dark' ? 'light' : 'dark';
            html.classList.add(this.mode);
            axios.post('api/updateColorScheme', {
                scheme: this.mode
            });
        }
    },
};
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
