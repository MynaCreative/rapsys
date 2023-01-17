<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="row dash-nft">
            <div class="col-xxl-12">
                <div class="row ">
                    <div class="col-xl-6">
                        <div class="card overflow-hidden">
                            <div class="card-body bg-InvoiceValidationDistribution d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="fs-18 lh-base fw-bold mb-0">RPX AP Invoice System <span class="text-primary">RAPsys.</span> </h4>
                                    <p class="mb-0 mt-2 pt-1 text-muted">If you are just starting out, please learn the link below.</p>
                                    <div class="d-flex gap-3 mt-4">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-label rounded-pill waves-effect waves-light">
                                            <i class="ri-book-3-line label-icon align-middle rounded-pill fs-16 me-2"></i> Dictionary
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-success btn-label rounded-pill waves-effect waves-light">
                                            <i class="ri-book-open-line label-icon align-middle rounded-pill fs-16 me-2"></i> User Manual
                                        </a>
                                    </div>
                                    <br>
                                    <small class="text-muted">* dictionary and user manual will available when all revision release</small>
                                </div>
                                <img src="@/Assets/images/logo-sm.png" alt="" class="img-fluid" style="width: 15%; height: 15%" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded fs-3">
                                            <i class="bx bx-dollar-circle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ps-3">
                                        <h5 class="text-muted text-uppercase fs-13 mb-0">Total Amount</h5>
                                    </div>
                                </div>
                                <div class="mt-4 pt-1">
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        Rp. <count-to :startVal='0' :endVal='0' :duration='2000'></count-to>
                                    </h4>
                                    <p class="mt-4 mb-0 text-muted">
                                        <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                            <i class="ri-arrow-left-right-line align-middle"></i> 0 % 
                                        </span>
                                        vs. prev month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ps-3">
                                        <h5 class="text-muted text-uppercase fs-13 mb-0">Valid Amount</h5>
                                    </div>
                                </div>
                                <div class="mt-4 pt-1">
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        Rp. <count-to :startVal='0' :endVal='0' :duration='2000'></count-to>
                                    </h4>
                                    <p class="mt-4 mb-0 text-muted">
                                        <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                            <i class="ri-arrow-left-right-line align-middle"></i> 0 % 
                                        </span>
                                        vs. prev month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger rounded fs-3">
                                            <i class="ri-close-circle-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ps-3">
                                        <h5 class="text-muted text-uppercase fs-13 mb-0">Invalid Amount</h5>
                                    </div>
                                </div>
                                <div class="mt-4 pt-1">
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">
                                        Rp. <count-to :startVal='0' :endVal='0' :duration='2000'></count-to>
                                    </h4>
                                    <p class="mt-4 mb-0 text-muted">
                                        <span class="badge bg-soft-primary text-primary mb-0 me-1">
                                            <i class="ri-arrow-left-right-line align-middle"></i> 0 % 
                                        </span>
                                        vs. prev month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <InvoiceValidationDistribution />
            </div>
            <div class="col-xxl-4">
                <Widget :references="references"/>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="row h-100">
                    <div class="col-xl-4">
                        <ValidationPopularity />
                    </div>
                    <div class="col-xl-4">
                        <Users />
                    </div>
                    <div class="col-xl-4">
                        <TopVendor />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/vue3'
import { CountTo } from 'vue3-count-to'

import Widget from './Dashboard/Widget.vue'
import Users from './Dashboard/Users.vue'
import TopVendor from './Dashboard/TopVendor.vue'
import InvoiceValidationDistribution from './Dashboard/InvoiceValidationDistribution.vue'
import ValidationPopularity from './Dashboard/ValidationPopularity.vue'

const props = defineProps(['references'])
</script>
