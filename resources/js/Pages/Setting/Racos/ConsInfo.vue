s<template>
    <Layout>
        <Head title="CONS Detail" />
        <template #header>
            <PageHeader title="CONS Detail" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="alert alert-danger alert-dismissible alert-additional shadow fade show" role="alert" v-if="Object.keys($page.props.errors).length">
            <div class="alert-body">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-error-warning-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Something is wrong!</h5>
                        <p class="mb-0">{{ $page.props.errors.exception }}</p>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">{{ $page.props.errors.error }}</p>
            </div>
        </div>
        <div class="card">
            <form @submit.prevent="form.get(route(`${page.module}.info`))" class="search-box">
                <input type="search" class="form-control search border-0 py-3" v-model="form.code" placeholder="Search CONS code here ..." autofocus>
                <i class="ri-search-line search-icon"></i>
            </form>
        </div>
        <div class="card" >
            <div class="card-body">
                <JsonTreeView :data="JSON.stringify(props.result)" rootKey="API Result" :maxDepth="10" v-if="props.result"/>
                <div class="text-muted fw-medium" v-else>example : <code>817690638322</code></div>
            </div>
        </div>
        <div class="card" v-if="props.information">
            <div class="card-header">
                <h5 class="mb-0">API Detail - REST</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium" width="120"><i class="ri-link"></i> URL</td>
                                <td>{{ props.information.url }}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium"><i class="ri-user-follow-line"></i> Username</td>
                                <td>{{ props.information.username }}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium"><i class="ri-admin-line"></i> Password</td>
                                <td>{{ props.information.password }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import { Head, useForm, usePage  } from '@inertiajs/vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import { JsonTreeView } from 'json-tree-view-vue3'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Setting' },
    { text: 'Racos' },
    { text: 'CONS Detail', active: true },
]

const props = defineProps(['result','information'])

const form = useForm({
    code: usePage().props.ziggy.query.code ?? null,
})
</script>
