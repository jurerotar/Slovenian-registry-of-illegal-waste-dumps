require('./bootstrap');

import NProgress from 'nprogress'
import {Inertia} from '@inertiajs/inertia'
import {createApp, h} from 'vue'
import {App, plugin} from '@inertiajs/inertia-vue3'

const el = document.getElementById('app')

createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    })
}).use(plugin).mount(el)

let timeout = null

Inertia.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 250)
})

Inertia.on('progress', (event) => {
    if (NProgress.isStarted() && event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

Inertia.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {

    } else if (event.detail.visit.completed) {
        NProgress.done()
    } else if (event.detail.visit.interrupted) {
        NProgress.set(0)
    } else if (event.detail.visit.cancelled) {
        NProgress.done()
        NProgress.remove()
    }
})
