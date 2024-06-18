<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="row dash-nft">
            <div class="col-xxl-12">
                <div class="row ">
                    <div class="col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-body bg-InvoiceValidationDistribution d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="fs-18 lh-base fw-bold mb-0">RPX AP Invoice System <span class="text-primary">RAPsys.</span> </h4>
                                    <p class="mb-0 mt-2 pt-1 text-muted">If you are just starting out, please learn the link below.</p>
                                    <div class="d-flex gap-3 mt-4">
                                        <a href="/storage/user-manuals/user-manual.pdf" target="_blank" class="btn btn-success btn-label rounded-pill waves-effect waves-light">
                                            <i class="ri-book-open-line label-icon align-middle rounded-pill fs-16 me-2"></i> User Manual
                                        </a>
                                    </div>
                                </div>
                                <img src="@/Assets/images/logo-sm.png" alt="" class="img-fluid" style="width: 15%; height: 15%" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Users</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <count-to :startVal='0' :endVal='references.total_user' :duration='5000'></count-to>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            Count all users
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <users-icon></users-icon>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Online</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <count-to :startVal='0' :endVal='references.online.length' :duration='5000'></count-to>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            Count online users
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger rounded-circle fs-2">
                                                <activity-icon name="activity"></activity-icon>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">AVG Duration</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <count-to :startVal='0' :endVal='references.login_duration.minute' :duration='3000'></count-to>m
                                            <count-to :startVal='0' :endVal='references.login_duration.second' :duration='3000'></count-to>sec
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                                <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                            </span>
                                            vs. prev month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning rounded-circle fs-2">
                                                <clock-icon name="clock"></clock-icon>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Login Rate</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <count-to :startVal='0' :endVal='references.total_login' :duration='5000'></count-to>
                                        </h2>
                                        <p class="mb-0 text-muted">
                                            <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                                <i class="ri-arrow-left-right-line align-middle"></i> 0 %
                                            </span>
                                            vs. prev month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success rounded-circle fs-2">
                                                <external-link-icon></external-link-icon>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 mb-4">
                        <Approval />
                    </div>
                    <div class="col-xl-4 mb-4">
                        <DocumentStatus />
                    </div>
                    <div class="col-xl-4 mb-4">
                        <Staging />
                    </div>
                    <div class="col-xl-4 mb-4">
                        <InvoiceVendor />
                    </div>
                    <div class="col-xl-4 mb-4">
                        <InvoiceDepartment />
                    </div>
                    <div class="col-xl-4 mb-4">
                        <InvoiceUser />
                    </div>
                </div>
            </div>
        </div>
       
    </AuthenticatedLayout>
</template>
<script setup>
import { UsersIcon, ActivityIcon, ClockIcon, ExternalLinkIcon } from '@zhuowenli/vue-feather-icons'

import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/vue3'
import { CountTo } from 'vue3-count-to'

import InvoiceUser from './Dashboard/InvoiceUser.vue'
import InvoiceVendor from './Dashboard/InvoiceVendor.vue'
import InvoiceDepartment from './Dashboard/InvoiceDepartment.vue'
import Approval from './Dashboard/Approval.vue'
import DocumentStatus from './Dashboard/DocumentStatus.vue'
import Staging from './Dashboard/Staging.vue'

const props = defineProps(['references'])
</script>
