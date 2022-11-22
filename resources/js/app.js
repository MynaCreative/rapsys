import './bootstrap'

import '@/Assets/scss/config/material/app.scss'

import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { BootstrapVue3, BToastPlugin} from 'bootstrap-vue-3'
import dayjs from 'dayjs'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const myApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(BootstrapVue3)
            .use(BToastPlugin)
            .use(ZiggyVue, Ziggy)
        myApp.config.globalProperties.$dayjs = dayjs
        myApp.mount(el);
        return myApp
    },
})

InertiaProgress.init({ color: '#3577f1' })
