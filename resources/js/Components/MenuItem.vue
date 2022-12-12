<template>
    <li class="nav-item" v-show="permission || $page.props.auth.roles.includes('Administrator')">
        <Link :class="['nav-link menu-link', {active: route().current(routeName)}]" :href="route(routeName)">
            <i :class="icon" v-show="icon"></i>
            <span>{{ name }}</span>
            <span :class="['badge badge-pill',badgeColor]" v-show="badge">{{ badge }}</span>
        </Link>
    </li>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'
const props = defineProps({
    routeName: {
        required: true,
    },
    name: {
        required: true,
    },
    icon: {
        required: false,
        default: null
    },
    permission: {
        required: false,
        default: true
    },
    badge: {
        required: false,
        default: null
    },
    badgeColor: {
        required: false,
        default: null
    },
})
</script>
