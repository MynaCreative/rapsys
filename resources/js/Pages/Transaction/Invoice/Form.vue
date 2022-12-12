<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <div class="flex-grow-1 oveflow-hidden">
                    <h5 class="modal-title">Form {{ form.id ? 'Update' : 'Create' }} - {{ page.title }}</h5>
                </div>
                <div class="flex-shrink-0 ms-2">
                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#header" role="tab">
                                Header
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#line" role="tab">
                                Line
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form @submit.prevent="submit">
                <b-alert :show="!!form.errors.error" variant="danger">{{ form.errors.error }}</b-alert>
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="header" role="tabpanel">
                        <PartialHeader v-model:formData="form" :references="references"/>
                    </div>
                </div>
                <div class="tab-content text-muted">
                    <div class="tab-pane" id="line" role="tabpanel">
                        <PartialLine v-model:formData="form" :references="references"/>
                    </div>
                </div>
                <div class="card-footer justify-content-between">
                    <Link :href="route(`${page.module}.${page.name}.index`)" class="btn btn-light me-1">
                        <i class="ri-close-line align-bottom me-1"></i>
                        Back
                    </Link>
                    <b-button type="submit" variant="primary" class="btn-label waves-effect waves-light" :disabled="form.processing">
                        <i :class="['label-icon align-middle fs-16 me-2', form.processing ? 'ri-refresh-line' : 'ri-save-line']"></i>
                        {{ form.processing ? 'Processing' : 'Save' }}
                    </b-button>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup>
import { Head, Link, useForm  } from '@inertiajs/inertia-vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'

import PartialHeader from './Partials/Header.vue'
import PartialLine from './Partials/Line.vue'
import entityData from './entity'
import service from './service'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: page.title, active: true },
]

const props = defineProps(['references','model'])

const form = useForm(props.model ? { ...props.model } : entityData().form)

const submit = () => {
    service.submitData(form, form.id)
}
</script>
