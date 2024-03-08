<template>
    <Layout>
        <Head title="Report - Oracle Line" />
        <template #header>
            <PageHeader title="Report - Oracle Line (Staging)" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <b-button-group>
                            <b-button variant="primary" class="btn-label waves-effect waves-light" @click="modalFilterVisible = true">
                                <i class="ri-filter-3-line label-icon align-middle fs-16 me-2"></i>
                                Filter
                            </b-button>
                            <b-button variant="success" class="btn-label waves-effect waves-light right" @click="modalExportVisible = true">
                                <i class="ri-upload-2-line label-icon align-middle fs-16"></i>
                                Export
                            </b-button>
                        </b-button-group>
                    </div>
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <b-button-group>
                                <PerPage v-if="collection.links.length > 3"/>
                            </b-button-group>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 border-2 border-top border-bottom">
                <form @submit.prevent="form.get(route(`${page.module}.${page.name}.oracle-line`))" class="search-box">
                    <input type="search" class="form-control search border-0 py-3" :placeholder="`Search for ${page.title} ...`" v-model="form.keyword">
                    <i class="ri-search-line search-icon"></i>
                </form>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive table-card mb-0">
                    <table class="table table-hover table-nowrap table-sm align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th width="60" class="text-center align-middle">#</th>
                                <th class="align-middle">Invoice Number</th>
                                <Sort label="Dist" attribute='dist_code_concat'/>
                                <Sort label="Description" attribute='description'/>
                                <Sort label="PPN" attribute='ppn_code' class="text-center"/>
                                <Sort label="Tax Rate" attribute='tax_rate' class="text-center"/>
                                <Sort label="Amount" attribute='amount' class="text-end"/>
                                <th class="text-center">Invoice Status</th>
                                <Sort label="Status" attribute='status' class="text-center"/>
                                <Sort label="Message" attribute='error_message' />
                                <Sort label="Created At" attribute='creation_date' class="text-center"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td class="text-center">{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>{{ item.invoice?.trx_number }}</td>
                                <td>{{ item.dist_code_concat }}</td>
                                <td>{{ item.description }}</td>
                                <td class="text-center">{{ item.ppn_code }}</td>
                                <td class="text-center">{{ item.tax_rate_id }}</td>
                                <td class="text-end">{{ item.amount.toLocaleString() }}</td>
                                <td class="text-center">
                                    <span v-if="item.invoice?.status == 'S'" class="badge bg-success rounded-pill text-capitalize">posted</span>
                                    <span v-else-if="item.invoice?.status == 'E' || item.invoice?.status == 'G'" class="badge bg-danger rounded-pill text-capitalize">error</span>
                                    <span v-else-if="item.invoice?.status == 'I'" class="badge bg-info rounded-pill text-capitalize">pending</span>
                                    <template v-else>{{ item.invoice?.status }}</template>
                                </td>
                                <td class="text-center">
                                    <span v-if="item.invoice?.status == 'I'" class="badge bg-info rounded-pill text-capitalize">pending</span>
                                    <span v-if="item.status == 'V'" class="badge bg-success rounded-pill text-capitalize">posted</span>
                                    <span v-else-if="item.status == 'E'" class="badge bg-danger rounded-pill text-capitalize">error</span>
                                    <template v-else>{{ item.status }}</template>
                                </td>
                                <td >{{ item.error_message }}</td>
                                <td class="text-center date"><DataTimestamp :data="item.creation_date"/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer p-0">
                <Pagination :data="collection"/>
            </div>
        </div>
        <ModalFilter
            :show="modalFilterVisible"
            @update:show="modalFilterVisible = $event"
        />
        <ModalExport
            :show="modalExportVisible"
            @update:show="modalExportVisible = $event"
        />
    </Layout>
</template>
<script setup>
import { ref } from 'vue'
import { Head, useForm, usePage  } from '@inertiajs/vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Pagination from '@/Components/Pagination.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import PerPage from '@/Components/PerPage.vue'
import Sort from '@/Components/Sort.vue'

import ModalFilter from './Modal/Filter.vue'
import ModalExport from './Modal/Export.vue'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: page.title },
    { text: 'Oracle Line', active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})

const modalFilterVisible = ref(false)
const modalExportVisible = ref(false)
</script>
