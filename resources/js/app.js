import './bootstrap'

import '@/Assets/scss/config/material/app.scss'
import '@vueform/multiselect/themes/default.css'

import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import BootstrapVueNext from 'bootstrap-vue-next'
import {BToastPlugin} from 'bootstrap-vue-next'
import VueApexCharts from 'vue3-apexcharts'

import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    progress: {
        color: '#3577f1',
    },
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(BootstrapVueNext)
            .use(BToastPlugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
        dayjs.extend(relativeTime)
        myApp.config.globalProperties.$dayjs = dayjs
        myApp.mount(el);
        return myApp
    },
})
