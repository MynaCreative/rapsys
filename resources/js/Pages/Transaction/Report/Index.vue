<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Total Tasks</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="234" :duration="5000"></count-to>k
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> 17.32 %
                                    </span>
                                    vs. previous month
                                </p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded-circle fs-4">
                                        <i class="ri-ticket-2-line"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Pending Tasks</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="64" :duration="5000"></count-to>k
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-danger mb-0">
                                        <i class="ri-arrow-down-line align-middle"></i> 0.87 %
                                    </span>
                                    vs. previous month
                                </p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded-circle fs-4">
                                        <i class="mdi mdi-timer-sand"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Completed Tasks</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="116" :duration="5000"></count-to>K
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-danger mb-0">
                                        <i class="ri-arrow-down-line align-middle"></i> 2.52 %
                                    </span>
                                    vs. previous month
                                </p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded-circle fs-4">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Deleted Tasks</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="14" :duration="5000"></count-to>%
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="badge bg-light text-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> 0.63 %
                                    </span>
                                    vs. previous month
                                </p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-secondary rounded-circle fs-4">
                                        <i class="ri-delete-bin-line"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <b-button-group>
                            <Link :href="route(`${page.module}.${page.name}.create`)" class="btn btn-success btn-label waves-effect waves-light">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Export
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
                                <th>#</th>
                                <Sort label="Invoice Number" attribute='invoice_number'/>
                                <Sort label="Invoice Date" attribute='invoice_date'/>
                                <Sort label="Vendor" attribute='vendor_id'/>
                                <Sort label="Total Amount" attribute='total_amount' class="text-end"/>
                                <Sort label="Total Amount Valid" attribute='total_amount_valid' class="text-end"/>
                                <Sort label="Total Amount Invalid" attribute='total_amount_invalid' class="text-end"/>
                                <th class="text-center">Document Status</th>
                                <th class="text-center">Approval Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td class="fw-medium">{{ item.invoice_number }}</td>
                                <td>{{ $dayjs(item.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td>{{ item.vendor?.code }} - {{ item.vendor?.name }}</td>
                                <td class="text-end">
                                    <h6 class="text-primary fs-11 mb-0">
                                        <i class="ri-wallet-line align-middle me-1"></i>
                                        9.500.000,00
                                    </h6>
                                </td>
                                <td class="text-end text-success">
                                    <h6 class="text-success fs-11 mb-0">
                                        <i class="ri-check-line align-middle me-1"></i>
                                        9.500.000,00
                                    </h6>
                                </td>
                                <td class="text-end">
                                    <h6 class="text-danger fs-11 mb-0">
                                        <i class="ri-close-line align-middle me-1"></i>
                                        9.500.000,00
                                    </h6>
                                </td>
                                <td class="text-center"><b-badge variant="light" class="text-capitalize">{{ item.document_status }}</b-badge></td>
                                <td class="text-center"><b-badge variant="light" class="text-capitalize">{{ item.approval_status }}</b-badge></td>
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
import { Head, Link, useForm, usePage  } from '@inertiajs/inertia-vue3'
import { CountTo } from 'vue3-count-to'

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

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: page.title, active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.value.ziggy.query.keyword ?? null,
})
</script>
