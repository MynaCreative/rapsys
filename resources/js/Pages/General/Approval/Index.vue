<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-body p-0 border-2 border-top border-bottom">
                <form @submit.prevent="form.get(route(`${page.name}.index`))" class="search-box">
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
                                <Sort label="Creator" attribute='created_by'/>
                                <Sort label="Vendor" attribute='vendor_id' class="align-middle"/>
                                <Sort label="Total Amount" attribute='total_amount' class="text-center"/>
                                <Sort label="Validation" attribute='total_amount_valid' class="text-center"/>
                                <Sort width="110" label="Invoice" attribute='invoice_date' class="text-center"/>
                                <Sort width="140" label="Created" attribute='created_at' class="text-center"/>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection" :key="item.id">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td>
                                    <span>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0  me-3">
                                                <div class="avatar-sm p-1">
                                                    <div class="avatar-title fs-18 rounded bg-soft-success text-success" v-if="item.invoice.total_amount_invalid == 0" title="Valid">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <div class="avatar-title fs-18 rounded bg-soft-danger text-danger" title="Invalid" v-else>
                                                        <i class="ri-close-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-1"><Link :href="route('approvals.edit', item.invoice.id)" class="text-dark">{{ item.invoice.invoice_number ? item.invoice.invoice_number : '--' }}</Link></h5>
                                                <p class="text-muted mb-0">
                                                    Department : <span class="fw-medium">{{ item.invoice?.department ? item.invoice?.department?.name : '--' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td ><DataUserName :data="item.invoice.created_user?.name"/></td>
                                <td>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-14 mb-1">{{ item.invoice.vendor ? `${item.invoice.vendor.name}` : '--' }}</h5>
                                        <p class="text-muted mb-0">
                                            Site : <span class="fw-medium">{{ item.invoice?.vendor_site ? item.invoice?.vendor_site?.name : '--' }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="flex-grow-1">
                                        <h6 class="text-primary fs-11 mb-1" title="Before Tax">
                                            {{ item.invoice.total_amount.toLocaleString() }}
                                            <i class="ri-wallet-line align-middle"></i>
                                        </h6>
                                        <h6 class="text-info fs-11 mb-0" title="After Tax">
                                            {{ item.invoice.total_amount_after_tax.toLocaleString() }}
                                            <i class="ri-wallet-3-line"></i>
                                        </h6>
                                    </div>
                                </td>
                                <td class="text-center text-success">
                                    <div class="flex-grow-1">
                                        <h6 class="text-success fs-11 mb-1" title="Valid Amount After Tax">
                                            {{ item.invoice.total_amount_valid.toLocaleString() }}
                                            <i class="ri-check-line align-middle"></i>
                                        </h6>
                                        <h6 class="text-danger fs-11 mb-0" title="Invalid Amount After Tax">
                                            {{ item.invoice.total_amount_invalid.toLocaleString() }}
                                            <i class="ri-close-line align-middle"></i>
                                        </h6>
                                    </div>
                                </td>
                                <td class="text-center date">{{ $dayjs(item.invoice.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td class="text-center date"><DataTimestamp :data="item.invoice.created_at"/></td>
                                <td class="text-center">
                                    <ul class="list-inline gap-2 mb-0 text-center">
                                        <li class="list-inline-item" title="View">
                                            <Link :href="route('approvals.edit', item.invoice.id)" class="text-warning d-inline-block" >
                                                <i class="ri-eye-fill fs-16"></i>
                                            </Link>
                                        </li>
                                    </ul>
                                </td>
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

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Sort from '@/Components/Sort.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import DataUserName from '@/Components/Data/UserName.vue'

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
