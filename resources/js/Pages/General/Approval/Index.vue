<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-body p-0 border-2 border-top border-bottom">
                <form @submit.prevent="form.get(route(`${page.module}.${page.name}.index`))" class="search-box">
                    <input type="search" class="form-control search border-0 py-3" :placeholder="`Search for ${page.title} ...`" v-model="form.keyword">
                    <i class="ri-search-line search-icon"></i>
                </form>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive table-card mb-0">
                    <table class="table table-hover table-nowrap table-sm align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th width="60" rowspan="2" class="align-middle">#</th>
                                <Sort label="Invoice Number" attribute='invoice_number' rowspan="2" class="align-middle"/>
                                <Sort label="Vendor" attribute='vendor_id' rowspan="2" class="align-middle"/>
                                <th class="sort text-center" colspan="3">Amount  (after tax)</th>
                                <th class="text-center" colspan="2">Status</th>
                                <th class="text-center" colspan="2">Date</th>
                            </tr>
                            <tr>
                                <Sort label="Total" attribute='total_amount' class="text-center"/>
                                <Sort label="Valid" attribute='total_amount_valid' class="text-center"/>
                                <Sort label="Invalid" attribute='total_amount_invalid' class="text-center"/>
                                <th class="text-center">Approval</th>
                                <th class="text-center">Document</th>
                                <Sort width="110" label="Invoice" attribute='invoice_date' class="text-center"/>
                                <Sort width="140" label="Created" attribute='created_at' class="text-center"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td class="fw-medium">{{ item.invoice.invoice_number ? item.invoice.invoice_number : '--' }}</td>
                                <td>{{ item.invoice.vendor ? `${item.invoice.vendor.code} - ${item.invoice.vendor.name}` : '--' }}</td>
                                <td class="text-end">
                                    <h6 class="text-primary fs-11 mb-0">
                                        {{ item.invoice.total_amount_after_tax.toLocaleString() }}
                                        <i class="ri-wallet-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-end text-success">
                                    <h6 class="text-success fs-11 mb-0">
                                        {{ item.invoice.total_amount_after_tax_valid.toLocaleString() }}
                                        <i class="ri-check-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-end">
                                    <h6 class="text-danger fs-11 mb-0">
                                        {{ item.invoice.total_amount_after_tax_invalid.toLocaleString() }}
                                        <i class="ri-close-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="text-capitalize" v-if="item.invoice.approval_status == 'none'">{{ item.invoice.approval_status }}</b-badge>
                                    <b-badge variant="soft-primary" class="text-primary text-capitalize" v-if="item.invoice.approval_status == 'pending'">{{ item.invoice.approval_status }}</b-badge>
                                    <b-badge variant="soft-success" class="text-success text-capitalize" v-if="item.invoice.approval_status == 'approved'">{{ item.invoice.approval_status }}</b-badge>
                                    <b-badge variant="soft-danger" class="text-danger text-capitalize" v-if="item.invoice.approval_status == 'rejected'">{{ item.invoice.approval_status }}</b-badge>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="rounded-pill text-capitalize" v-if="item.invoice.document_status == 'draft'">{{ item.invoice.document_status }}</b-badge>
                                    <b-badge variant="primary" class="rounded-pill text-capitalize" v-if="item.invoice.document_status == 'published'">{{ item.invoice.document_status }}</b-badge>
                                    <b-badge variant="danger" class="rounded-pill text-capitalize" v-if="item.invoice.document_status == 'cancelled'">{{ item.invoice.document_status }}</b-badge>
                                    <b-badge variant="success" class="rounded-pill text-capitalize" v-if="item.invoice.document_status == 'closed'">{{ item.invoice.document_status }}</b-badge>
                                </td>
                                <td class="text-center date">{{ $dayjs(item.invoice.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date"><DataTimestamp :data="item.invoice.created_at"/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'
import { UserCheckIcon } from '@zhuowenli/vue-feather-icons'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Sort from '@/Components/Sort.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: page.title, active: true },
]

const props = defineProps(['collection'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})

</script>
