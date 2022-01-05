import {createApp, DefineComponent, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import {store} from '@/js/Stores/store';
import '@/css/app.scss';
import axios from 'axios';
import {capitalize} from "@/js/helpers/functions";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

createInertiaApp({
  resolve: async (name: string): Promise<DefineComponent> => {
    // @ts-ignore
    const pages = import.meta.glob('./views/**/*.vue');
    const page: DefineComponent = (await pages[`./views/${name}.vue`]()).default;
    // Automatically add layout to the page by getting its folder (example: public/home)
    page.layout = (await import(`./layouts/${capitalize(name.split('/')[0])}Layout.vue`)).default;
    return page;
  },
  setup({el, app, props, plugin}) {
    createApp({render: () => h(app, props)})
      .component('InertiaLink', Link)
      .use(plugin)
      .use(store)
      .mount(el);
  },
});

InertiaProgress.init({
  color: '#4B5563'
});

