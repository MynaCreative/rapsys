<template>
    <Layout>
        <Head title="Report - Oracle Header" />
        <template #header>
            <PageHeader title="Report - Oracle Header" :breadcrumbs="breadcrumbs" />
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
                <form @submit.prevent="form.get(route(`${page.module}.${page.name}.oracle-header`))" class="search-box">
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
                                <Sort label="Invoice Number" attribute='trx_number' class="align-middle"/>
                                <Sort label="Description" attribute='description'/>
                                <Sort label="Currency" attribute='currency_code' class="text-center"/>
                                <Sort label="Payment Method" attribute='payment_method_lookup_code' class="text-center"/>
                                <Sort label="Amount" attribute='amount' class="text-end"/>
                                <Sort label="Invoice Date" attribute='ap_invoice_date' class="text-center"/>
                                <Sort label="Receive Date" attribute='ap_invoice_received_date' class="text-center"/>
                                <Sort label="Posting Date" attribute='ap_gl_date' class="text-center"/>
                                <Sort label="Status" attribute='status' class="text-center"/>
                                <Sort label="Message" attribute='error_message' />
                                <Sort label="Created At" attribute='creation_date' class="text-center"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td class="text-center">{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>{{ item.trx_number }}</td>
                                <td>{{ item.description }}</td>
                                <td class="text-center">{{ item.currency_code }}</td>
                                <td class="text-center">{{ item.payment_method_lookup_code }}</td>
                                <td class="text-end">{{ item.amount.toLocaleString() }}</td>
                                <td class="text-center date">{{ $dayjs(item.ap_invoice_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date">{{ $dayjs(item.ap_invoice_received_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date">{{ $dayjs(item.ap_gl_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center">{{ item.status }}</td>
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
    { text: 'Oracle Header', active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})

const modalFilterVisible = ref(false)
const modalExportVisible = ref(false)
</script>
