s<template>
    <Layout>
        <Head title="AWB" />
        <template #header>
            <PageHeader title="AWB" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <form @submit.prevent="form.get(route(`${page.module}.awb`))" class="search-box">
                <input type="search" class="form-control search border-0 py-3" v-model="form.code" placeholder="Search AWB code here ..." autofocus>
                <i class="ri-search-line search-icon"></i>
            </form>
        </div>
        <div class="card" >
            <div class="card-body">
                <JsonTreeView :data="JSON.stringify(props.result)" rootKey="API Result" :maxDepth="10" v-if="props.result"/>
                <div class="text-muted fw-medium" v-else>example : <code>100088790372</code></div>
            </div>
        </div>
        <div class="card" v-if="props.information">
            <div class="card-header">
                <h5 class="mb-0">API Detail - SOAP WSDL</h5>
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
import { ref } from 'vue'
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import { JsonTreeView } from 'json-tree-view-vue3'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Setting' },
    { text: 'Delta' },
    { text: 'AWB', active: true },
]

const props = defineProps(['result','information'])

const form = useForm({
    code: usePage().props.ziggy.query.code ?? null,
})
</script>
