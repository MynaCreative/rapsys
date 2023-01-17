<template>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-animate">
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
        <div class="col-md-6">
            <div class="card card-animate">
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
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="card card-animate">
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
        <div class="col-md-6">
            <div class="card card-animate">
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
    </div>
</template>
<script setup>
import { CountTo } from 'vue3-count-to'
import { UsersIcon, ActivityIcon, ClockIcon, ExternalLinkIcon } from '@zhuowenli/vue-feather-icons'

const props = defineProps(['references'])
</script>
