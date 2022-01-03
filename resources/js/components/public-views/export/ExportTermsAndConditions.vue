<template>
    <ul class="flex flex-col gap-2">
        <li
            v-for="(condition, index) in conditions"
            :key="index"
        >
            <app-paragraph class="text-sm md:text-base">
                {{ condition }}
            </app-paragraph>
        </li>
    </ul>
</template>

<script setup lang="ts">

import AppParagraph from "@/js/components/common/AppParagraph.vue";

const conditions: string[] = [
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
    'Bacon ipsum dolor amet hamburger doner filet mignon pork shankle chuck bacon,drumstick salami beef ribs ball tip porchetta.',
];
</script>

