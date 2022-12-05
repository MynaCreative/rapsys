<template>
    <Head title="Register" />
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
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your RAPsys account now.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form @submit.prevent="submit">                                     
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                                                aria-describedby="input-name-feedback" placeholder="Enter name" autocomplete="name" required autofocus />
                                            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <b-form-input id="username" v-model="form.username" :class="{'is-invalid' : form.errors.username }"
                                                aria-describedby="input-username-feedback" placeholder="Enter username" autocomplete="username" required trim />
                                            <b-form-invalid-feedback id="input-username-feedback" v-html="form.errors.username"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <b-form-input id="email" v-model="form.email" :class="{'is-invalid' : form.errors.email }" type="email"
                                                aria-describedby="input-email-feedback" placeholder="Enter email" autocomplete="email" required />
                                            <b-form-invalid-feedback id="input-email-feedback" v-html="form.errors.email"/>
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
                                            <b-button class="w-100" variant="success" type="submit" :disabled="form.processing">Sign Up</b-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                Already have an account ?
                                <Link :href="route('login')" class="fw-semibold text-primary text-decoration-underline">Sign in</Link>
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

const form = useForm({
    name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

let passwordFieldType = ref('password')
let passwordConfirmationFieldType = ref('password')

const submit = () => {
    form.post(route('register'), {
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
