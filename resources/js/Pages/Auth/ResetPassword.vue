<template>
    <Head title="Reset Password" />
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
                                    <h5 class="text-primary">Create new password</h5>
                                    <p class="text-muted">Your new password must be different from previous used password.</p>
                                </div>
                                <div class="p-2">
                                    <form @submit.prevent="submit">                                     
                                        <div class="mb-4">
                                            <label for="username" class="form-label">Email</label>
                                            <b-form-input id="username" v-model="form.email" :class="{'is-invalid' : form.errors.email }"
                                                aria-describedby="input-username-feedback" placeholder="Enter email" autocomplete="username" required autofocus trim disabled />
                                            <b-form-invalid-feedback id="input-username-feedback" v-html="form.errors.email"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <b-form-input id="password" v-model="form.password" :class="['pe-5',{'is-invalid' : form.errors.password }]"
                                                    aria-describedby="input-password-feedback" placeholder="Enter new password" :type="passwordFieldType" autocomplete="new-password" required />
                                                <b-button @click="switchVisibility" variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </b-button>
                                                <b-form-invalid-feedback id="input-password-feedback" v-html="form.errors.password"/>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <b-form-input id="password_confirmation" v-model="form.password_confirmation" :class="['pe-5',{'is-invalid' : form.errors.password_confirmation }]"
                                                    aria-describedby="input-password-confirmation-feedback" placeholder="Enter confirm password" :type="passwordConfirmationFieldType" autocomplete="new-password" required />
                                                <b-button @click="switchVisibility('confirmation')" variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </b-button>
                                                <b-form-invalid-feedback id="input-password-confirmation-feedback" v-html="form.errors.password_confirmation"/>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <b-button class="w-100" variant="success" type="submit" :disabled="form.processing">Reset Password</b-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                Wait, I remember my password...
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
import { ref } from 'vue'
import Footer from '@/Components/Footer.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    email: String,
    token: String,
})

let passwordFieldType = ref('password')
let passwordConfirmationFieldType = ref('password')

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}

const switchVisibility = (type = null) => {
    if(type == 'confirmation'){
        passwordConfirmationFieldType.value = (passwordConfirmationFieldType.value === 'password') ? 'text' : 'password'
    }else{
        passwordFieldType.value = (passwordFieldType.value === 'password') ? 'text' : 'password'
    }
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
