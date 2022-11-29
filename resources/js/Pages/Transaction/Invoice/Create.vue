<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            Testing
        </div>
    </Layout>
</template>
<script setup>
import { Head  } from '@inertiajs/inertia-vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Master' },
    { text: page.title, active: true },
]
</script>
