<template>
    <a
        href="https://github.com/jurerotar/Slovenian-register-of-illegal-waste-dumps"
        rel="noopener"
        tabindex="0"
    >
        <app-button class="gap-2">
            <span class="">
                Sodeluj pri projektu na
            </span>
            <font-awesome-icon
                :icon="['fab', 'github']"
                aria-hidden="true"
                class="h-8 w-8"
            />
        </app-button>
    </a>
</template>

<script
    setup
    lang="ts"
>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import AppButton from "@/js/components/common/buttons/AppButton.vue";</script>

