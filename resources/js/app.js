import './bootstrap'

import '@/Assets/scss/config/material/app.scss'

import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import BootstrapVue3 from 'bootstrap-vue-3'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(BootstrapVue3)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
})

InertiaProgress.init({ color: '#4B5563' })
