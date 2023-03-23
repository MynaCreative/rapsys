<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto mb-4 ">
                                <img :src="`/img/initials/${$page.props.auth.user.name.charAt(0).toLowerCase()}.png`" class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow " alt="user-profile-image" />
                            </div>
                            <h5 class="fs-16 mb-1">{{ $page.props.auth.user.name }}</h5>
                            <p class="text-muted mb-1">{{ $page.props.auth.user.email }}</p>
                            <p class="text-muted mb-0">{{ $page.props.auth.department.name }}</p>
                        </div>
                    </div>
                </div>
                <div class="card shadow-none">
                    <div class="card-body bg-soft-info rounded">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <UserCheckIcon
                                class="text-info icon-dual-info"
                                ></UserCheckIcon>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fs-15">Your role is {{ implodedRoles($page.props.auth.user.roles) }}</h6>
                                <p class="text-muted mb-0">
                                    <template v-if="$page.props.auth.roles.includes('Administrator')">You have ability to access all</template>
                                    <template v-else>You have ability to access : {{ implodedPermissions($page.props.auth.permissions) }}</template>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#loginHistories" role="tab">
                                    <i class="fas fa-home"></i> Login History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="loginHistories" role="tabpanel">
                                <div class="mb-3 border-bottom pb-2">
                                    <h5 class="card-title">Last 10 authentications</h5>
                                </div>
                                <div class="d-flex align-items-center mb-3" v-for="authentication in authentications" :key="authentication.id">
                                    <div class="flex-shrink-0 avatar-sm">
                                        <div :class="['avatar-title rounded-3 fs-18 shadow bg-light',{'text-primary': authentication.login_successful, 'text-danger': !authentication.login_successful }]"
                                        :title="`${authentication.login_successful ? 'Login Success' : 'Login Failed'} : ${authentication.user_agent.userAgent}`">
                                            <i class="ri-smartphone-line" v-if="authentication.user_agent.isMobile"></i>
                                            <i class="ri-tablet-line" v-if="authentication.user_agent.isTablet"></i>
                                            <i class="ri-macbook-line" v-if="authentication.user_agent.isDesktop"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6>{{ authentication.user_agent.platformFamily }} - {{ authentication.user_agent.browserFamily }}</h6> 
                                        <p class="text-muted mb-0">{{ authentication.location.city }}, {{ authentication.location.country }} - {{ authentication.ip_address }}</p>
                                    </div>
                                    <div class="text-muted">
                                        <DataTimestamp :data="authentication.login_at"/> <template v-if="authentication.logout_at">- <DataTimestamp :data="authentication.logout_at"/></template>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form @submit.prevent="updatePassword">
                                    <div class="row g-2">
                                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                            <b-alert :modelValue="form.recentlySuccessful" variant="success">Password has been changed</b-alert>
                                        </Transition>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="current_password" class="form-label">Current Password*</label>
                                                <b-form-input type="password" id="current_password" ref="currentPasswordInput" v-model="form.current_password" :class="{'is-invalid' : form.errors.current_password }"
                                                    aria-describedby="input-current_password-feedback" placeholder="Enter current password" autocomplete="current-password" autofocus />
                                                <b-form-invalid-feedback id="input-current_password-feedback" v-html="form.errors.current_password"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="password" class="form-label">New Password*</label>
                                                <b-form-input type="password" id="password" ref="passwordInput" v-model="form.password" :class="{'is-invalid' : form.errors.password }"
                                                    aria-describedby="input-password-feedback" placeholder="Enter new password" autocomplete="new-password" />
                                                <b-form-invalid-feedback id="input-password-feedback" v-html="form.errors.password"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                                <b-form-input type="password" id="password_confirmation" v-model="form.password_confirmation" :class="{'is-invalid' : form.errors.password }"
                                                    aria-describedby="input-password_confirmation-feedback" placeholder="Confirm password" autocomplete="new-password" />
                                                <b-form-invalid-feedback id="input-password_confirmation-feedback" v-html="form.errors.password"/>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success" :disabled="form.processing">
                                                Change Password
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </Layout>
</template>
<script setup>
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'
import { UserCheckIcon } from '@zhuowenli/vue-feather-icons'
import { ref } from 'vue'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'

import entityData from './entity'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: page.title, active: true },
]

const props = defineProps(['authentications'])

const implodedRoles = (roles) => {
    let imploded = roles.map((item) => item.name)
    return imploded.join(', ')
}

const implodedPermissions = (permissions) => {
    if(permissions){
        return permissions.join(', ')
    }
}

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation')
                passwordInput.value.focus()
            }
            if (form.errors.current_password) {
                form.reset('current_password')
                currentPasswordInput.value.focus()
            }
        },
    })
}
</script>
