<template>
    <Layout>
        <Head title="Report - Invoice Header" />
        <template #header>
            <PageHeader title="Report - Invoice Header" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">All Invoice Receipt </p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="statistic.all" :duration="5000"></count-to>
                                </h2>
                                <!-- <p class="mb-0 text-muted">
                                    <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                        <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                    </span>
                                    vs. prev month
                                    <br><small class="text-muted">* available when full release</small>
                                </p> -->
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
                                <p class="fw-medium text-muted mb-0">Pending Invoice</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="statistic.pending" :duration="5000"></count-to>
                                </h2>
                                <!-- <p class="mb-0 text-muted">
                                    <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                        <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                    </span>
                                    vs. prev month
                                    <br><small class="text-muted">* available when full release</small>
                                </p> -->
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
                                <p class="fw-medium text-muted mb-0">Approved Invoice</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="statistic.approved" :duration="5000"></count-to>
                                </h2>
                                <!-- <p class="mb-0 text-muted">
                                    <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                        <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                    </span>
                                    vs. prev month
                                    <br><small class="text-muted">* available when full release</small>
                                </p> -->
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
                                <p class="fw-medium text-muted mb-0">Rejected Invoice</p>
                                <h2 class="mt-4 ff-secondary fw-semibold">
                                    <count-to :startVal="0" :endVal="statistic.rejected" :duration="5000"></count-to>
                                </h2>
                                <!-- <p class="mb-0 text-muted">
                                    <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                        <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                    </span>
                                    vs. prev month
                                    <br><small class="text-muted">* available when full release</small>
                                </p> -->
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded-circle fs-4">
                                        <i class="ri-close-circle-line"></i>
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
                            <!-- <b-button variant="primary" class="btn-label waves-effect waves-light" @click="modalFilterVisible = true">
                                <i class="ri-filter-3-line label-icon align-middle fs-16 me-2"></i>
                                Filter
                            </b-button> -->
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
                <form @submit.prevent="form.get(route(`${page.module}.${page.name}.invoice-header`))" class="search-box">
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
                                <Sort label="Invoice Number" attribute='invoice_number' class="align-middle"/>
                                <Sort label="Vendor" attribute='vendor_id' class="align-middle"/>
                                <Sort label="Total Amount" attribute='total_amount' class="text-end"/>
                                <!-- <Sort label="Validation" attribute='total_amount_valid' class="text-center"/> -->
                                <Sort width="110" label="Invoice Date" attribute='invoice_date' class="text-center"/>
                                <Sort width="110" label="Posting Date" attribute='posting_date' class="text-center"/>
                                <Sort width="140" label="Created" attribute='created_at' class="text-center"/>
                                <th class="text-center">Data Type</th>
                                <th class="text-center">Document Status</th>
                                <th class="text-center">Approval Status</th>
                                <Sort label="Creator" attribute='created_by'/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>
                                    <span>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-1"><Link :href="route('approvals.edit', item.id)" class="text-dark">{{ item.invoice_number ? item.invoice_number : '--' }}</Link></h5>
                                                <p class="text-muted mb-0">
                                                    Department : <span class="fw-medium">{{ item?.department ? item?.department?.name : '--' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-14 mb-1">{{ item.vendor ? `${item.vendor.name}` : '--' }}</h5>
                                        <p class="text-muted mb-0">
                                            Site : <span class="fw-medium">{{ item?.vendor_site ? item?.vendor_site?.name : '--' }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td class="text-end">
                                    {{ item.total_amount.toLocaleString() }}
                                </td>
                                <!-- <td class="text-center text-success">
                                    <div class="flex-grow-1">
                                        <h6 class="text-success fs-11 mb-1" title="Valid Amount After Tax">
                                            {{ item.total_amount_after_tax_valid.toLocaleString() }}
                                            <i class="ri-check-line align-middle"></i>
                                        </h6>
                                        <h6 class="text-danger fs-11 mb-0" title="Invalid Amount After Tax">
                                            {{ item.total_amount_after_tax_invalid.toLocaleString() }}
                                            <i class="ri-close-line align-middle"></i>
                                        </h6>
                                    </div>
                                </td> -->
                                <td class="text-center date">{{ $dayjs(item.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date">{{ $dayjs(item.posting_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date"><DataTimestamp :data="item.created_at"/></td>
                                <td class="text-center">
                                    <span :class="['badge badge-label bg-info']" v-if="item.expense?.type == 1">
                                        SMU
                                    </span>
                                    <span :class="['badge badge-label bg-secondary']" v-if="item.expense?.type == 2">
                                        AWB
                                    </span>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="rounded-pill text-capitalize" v-if="item.document_status == 'draft'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="primary" class="rounded-pill text-capitalize" v-if="item.document_status == 'published'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="danger" class="rounded-pill text-capitalize" v-if="item.document_status == 'cancelled'">{{ item.document_status }}</b-badge>
                                    <b-badge variant="success" class="rounded-pill text-capitalize" v-if="item.document_status == 'closed'">{{ item.document_status }}</b-badge>
                                </td>
                                <td class="text-center">
                                    <b-badge variant="light" class="text-capitalize" v-if="item.approval_status == 'none'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-primary" class="text-primary text-capitalize" v-if="item.approval_status == 'pending'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-success" class="text-success text-capitalize" v-if="item.approval_status == 'approved'">{{ item.approval_status }}</b-badge>
                                    <b-badge variant="soft-danger" class="text-danger text-capitalize" v-if="item.approval_status == 'rejected'">{{ item.approval_status }}</b-badge>
                                </td>
                                <td ><DataUserName :data="item.created_user?.name"/></td>
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
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'
import { CountTo } from 'vue3-count-to'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Pagination from '@/Components/Pagination.vue'
import DataUserName from '@/Components/Data/UserName.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import PerPage from '@/Components/PerPage.vue'
import Reload from '@/Components/Reload.vue'
import Sort from '@/Components/Sort.vue'

import ModalFilter from './Modal/Filter.vue'
import ModalExport from './Modal/Export.vue'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: page.title },
    { text: 'Invoice Header', active: true },
]

const props = defineProps(['collection','filters','statistic'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})

const modalFilterVisible = ref(false)
const modalExportVisible = ref(false)
</script>
