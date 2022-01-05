<template>
  <inertia-head>
    <title>
      {{ title }}
    </title>
    <meta
      head-key="twitter:title"
      name="twitter:title"
      :content="title"
    >
    <meta
      head-key="twitter:description"
      name="twitter:description"
      :content="description"
    >
    <meta
      head-key="description"
      name="description"
      :content="description"
    >
    <meta
      head-key="og:title"
      name="og:title"
      :content="title"
    >
    <meta
      head-key="og:url"
      property="og:url"
      :content="url"
    >
    <meta
      head-key="og:title"
      property="og:title"
      :content="title"
    >
    <meta
      head-key="og:description"
      property="og:description"
      :content="description"
    >
  </inertia-head>
</template>

<script
    setup
    lang="ts"
>
import {Head as InertiaHead, usePage} from '@inertiajs/inertia-vue3';
import {useStore} from 'vuex';
import {State} from "@/js/stores/store";
import {InertiaPageProps} from "@/js/types/inertia";

// @ts-ignore
const {props: {value: {meta: {title, description}}}, url} = usePage<InertiaPageProps>();

const store = useStore<State>();
store.commit('appState/setCurrentUrl', url.value);
</script>
