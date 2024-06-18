import './bootstrap'

import '@/Assets/scss/config/material/app.scss'

import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
// import BootstrapVueNext from 'bootstrap-vue-next'
import {BToastPlugin} from 'bootstrap-vue-next'

import Highcharts from 'highcharts';
import HighchartsVue from 'highcharts-vue';
import accessibilityInit from 'highcharts/modules/accessibility';
import moreInit from 'highcharts/highcharts-more';
import solidGaugeInit from 'highcharts/modules/solid-gauge';

moreInit(Highcharts);
solidGaugeInit(Highcharts);
accessibilityInit(Highcharts);

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
            // .use(BootstrapVueNext)
            .use(BToastPlugin)
            .use(ZiggyVue)
            .use(HighchartsVue)
        dayjs.extend(relativeTime)
        myApp.config.globalProperties.$dayjs = dayjs
        myApp.mount(el);
        return myApp
    },
})
