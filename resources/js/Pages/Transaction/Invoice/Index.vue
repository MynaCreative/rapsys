<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <b-button-group>
                            <Link :href="route(`${page.module}.${page.name}.create`)" class="btn btn-primary btn-label waves-effect waves-light">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Create
                            </Link>
                        </b-button-group>
                    </div>
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <b-button-group>
                                <Reload :page="page"/>
                                <PerPage v-if="collection.links.length > 3"/>
                            </b-button-group>
                        </div>
                    </div>
                </div>
            </div>
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
                                <th class="text-center" colspan="3">Status</th>
                                <th class="text-center" colspan="2">Date</th>
                                <th width="100" class="text-center align-middle" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <Sort label="Total" attribute='total_amount' class="text-center"/>
                                <Sort label="Valid" attribute='total_amount_valid' class="text-center"/>
                                <Sort label="Invalid" attribute='total_amount_invalid' class="text-center"/>
                                <th class="text-center">Document</th>
                                <th class="text-center">Checking</th>
                                <th class="text-center">Approval</th>
                                <Sort width="110" label="Invoice" attribute='invoice_date' class="text-center"/>
                                <Sort width="140" label="Created" attribute='created_at' class="text-center"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td class="fw-medium">{{ item.invoice_number ? item.invoice_number : '--' }}</td>
                                <td>{{ item.vendor ? `${item.vendor.code} - ${item.vendor.name}` : '--' }}</td>
                                <td class="text-end">
                                    <h6 class="text-primary fs-11 mb-0">
                                        {{ item.total_amount_after_tax.toLocaleString() }}
                                        <i class="ri-wallet-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-end text-success">
                                    <h6 class="text-success fs-11 mb-0">
                                        {{ item.total_amount_after_tax_valid.toLocaleString() }}
                                        <i class="ri-check-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-end">
                                    <h6 class="text-danger fs-11 mb-0">
                                        {{ item.total_amount_after_tax_invalid.toLocaleString() }}
                                        <i class="ri-close-line align-middle"></i>
                                    </h6>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="rounded-pill text-capitalize" v-if="item.document_status == 'draft'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="primary" class="rounded-pill text-capitalize" v-if="item.document_status == 'published'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="danger" class="rounded-pill text-capitalize" v-if="item.document_status == 'cancelled'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="success" class="rounded-pill text-capitalize" v-if="item.document_status == 'closed'">{{ item.document_status }}</b-badge>
                                </td>
                                <td class="text-center">
                                    <b-progress v-if="item.items != item.validated_items" :value="item.validated_items" :max="item.items" height="15px" show-progress animated></b-progress>
                                    <b-badge variant="success" class="rounded-pill text-capitalize" v-else>done</b-badge>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="text-capitalize" v-if="item.approval_status == 'none'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-primary" class="text-primary text-capitalize" v-if="item.approval_status == 'pending'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-success" class="text-success text-capitalize" v-if="item.approval_status == 'approved'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-danger" class="text-danger text-capitalize" v-if="item.approval_status == 'rejected'">{{ item.approval_status }}</b-badge>
                                </td>
                                <td class="text-center date">{{ $dayjs(item.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date"><DataTimestamp :data="item.created_at"/></td>
                                <td>
                                    <ul class="list-inline gap-2 mb-0 text-center">
                                        <li class="list-inline-item edit" title="Edit" @click="() => {
                                            currentId = item.id
                                            modalFormVisible = true
                                        }">
                                            <Link :href="route(`${page.module}.${page.name}.edit`, item.id)" class="text-primary d-inline-block" title="Edit">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </Link>
                                        </li>
                                        <li class="list-inline-item" title="Remove">
                                            <a href="javascript:void(0);" class="text-danger d-inline-block" @click="service.deleteData(item.id)">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer p-0">
                <Pagination :data="collection"/>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import { ref } from 'vue'
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Pagination from '@/Components/Pagination.vue'
import DataUserName from '@/Components/Data/UserName.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import DataActive from '@/Components/Data/Active.vue'
import PerPage from '@/Components/PerPage.vue'
import Reload from '@/Components/Reload.vue'
import Sort from '@/Components/Sort.vue'

import entityData from './entity'
import service from './service'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: page.title, active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})
const currentId = ref(null)
const modalFormVisible = ref(false)
const modalDetailVisible = ref(false)
</script>
