<template>
    <Head title="Password Confirmation" />
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
                                            <i class="ri-rotate-lock-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 mt-4">
                                    <div class="text-muted text-center mb-4 mx-lg-3">
                                        <h4>Password Confirmation</h4>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="mb-3">
                                            <p class="text-muted">This is a secure area of the application. Please confirm your password before continuing.</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <b-form-input id="password" v-model="form.password" :class="['pe-5',{'is-invalid' : form.errors.password }]"
                                                    aria-describedby="input-password-feedback" placeholder="Enter new password" :type="passwordFieldType" autocomplete="current-password" required />
                                                <b-button @click="switchVisibility" variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </b-button>
                                                <b-form-invalid-feedback id="input-password-feedback" v-html="form.errors.password"/>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <b-button class="w-100" variant="success" type="submit" :disabled="form.processing">Confirm</b-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                Wait, I want to go
                                <Link :href="$page.props.url.previous" class="fw-semibold text-primary text-decoration-underline">back</Link>
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
import { ref } from 'vue'
import Footer from '@/Components/Footer.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

let passwordFieldType = ref('password')

const form = useForm({
    password: '',
})

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
}

const switchVisibility = () => {
    passwordFieldType.value = (passwordFieldType.value === 'password') ? 'text' : 'password'
}
</script>
<style scoped>
input::-ms-reveal {
    display: none;
}

.form-control.is-invalid{
    background-image: none;
}
</style>
