<template>
    <Head title="Forgot Password" />
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <Link href="/" class="d-inline-block auth-logo">
                                <img src="@/Assets/images/logo-light.png" alt="RAPsys" />
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot your password?</h5>
                                    <p class="text-muted">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    <lottie class="avatar-xl" colors="primary:#45CB85,secondary:#4b38b3" :options="defaultOptions"
                                        :height="120"
                                        :width="120"
                                    />
                                </div>
                                <div class="p-2">
                                    <b-alert v-model="status" variant="warning" class="mt-3" dismissible>{{ status }}</b-alert>
                                    <form @submit.prevent="submit">                                     
                                        <div class="mb-4">
                                            <label for="username" class="form-label">Email</label>
                                            <b-form-input id="username" v-model="form.email" :class="{'is-invalid' : form.errors.email }"
                                                aria-describedby="input-username-feedback" placeholder="Enter email" autocomplete="username" required autofocus trim />
                                            <b-form-invalid-feedback id="input-username-feedback" v-html="form.errors.email"/>
                                        </div>
                                        <div class="text-center mt-4">
                                            <b-button class="w-100" variant="success" type="submit" :disabled="form.processing">Send Reset Link</b-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                Wait, I remember my password.
                                <Link :href="route('login')" class="fw-semibold text-primary text-decoration-underline">Click here</Link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer/>
    </div>
</template>
<script setup>
import Footer from '@/Components/Footer.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

import Lottie from '@/Components/widgets/lottie.vue'
import animationData from '@/Components/widgets/rhvddzym.json'

defineProps({
    status: String,
})

const form = useForm({
    email: '',
})

const submit = () => {
    form.post(route('password.email'))
}

const defaultOptions = { animationData: animationData }
</script>
<style scoped>
input::-ms-reveal {
    display: none;
}
</style>
