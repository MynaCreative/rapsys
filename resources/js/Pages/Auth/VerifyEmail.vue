<template>
    <Head title="Email Verification" />
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
                                <div class="mb-4">
                                    <div class="avatar-lg mx-auto">
                                        <div class="avatar-title bg-light text-primary display-5 rounded-circle shadow">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 mt-4">
                                    <div class="text-muted text-center mb-4 mx-lg-3">
                                        <h4>Thanks for signing up!</h4>
                                    </div>
                                    <b-alert v-model="verificationLinkSent" variant="warning" class="mt-3" dismissible>
                                        A new verification link has been sent to the email address you provided during registration.
                                    </b-alert>
                                    <form @submit.prevent="submit">
                                        <div class="mb-3">
                                            <p class="text-muted">Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
                                            <p class="text-muted">If you didn't receive the email, we will gladly send you another.</p>
                                        </div>
                                        <div class="text-center mt-4">
                                            <b-button class="w-100" variant="success" type="submit" :disabled="form.processing">Resend Verification Email</b-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                I don't want to login now,
                                <Link :href="route('logout')" method="post" class="fw-semibold text-primary text-decoration-underline">Sign out</Link>
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
import { computed } from 'vue'
import Footer from '@/Components/Footer.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    status: String,
})

const form = useForm()

const submit = () => {
    form.post(route('verification.send'))
}

const verificationLinkSent = computed(() => props.status === 'verification-link-sent')
</script>
