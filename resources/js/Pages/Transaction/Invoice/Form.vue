<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <div class="flex-grow-1 oveflow-hidden">
                    <h5 class="modal-title">
                        Form {{ form.id ? 'Update' : 'Create' }} - {{ page.title }} {{ form.invoice_number ? ` [${form.invoice_number}]` : '' }}
                        <template v-if="form.id">
                            <b-badge variant="light" class="text-capitalize" v-if="form.document_status == 'draft'">{{ form.document_status }}</b-badge>
                            <b-badge variant="soft-primary" class="text-primary text-capitalize" v-if="form.document_status == 'published'">{{ form.document_status }}</b-badge>
                            <b-badge variant="soft-danger" class="text-danger text-capitalize" v-if="form.document_status == 'cancelled'">{{ form.document_status }}</b-badge>
                            <b-badge variant="soft-success" class="text-success text-capitalize" v-if="form.document_status == 'closed'">{{ form.document_status }}</b-badge>
                        </template>
                    </h5>
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
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#dist" role="tab">
                                Dist
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form ref="formElement">
                <div class="ps-3 pt-3" v-if="Object.keys(form.errors).length">
                    <b-alert :modelValue="!!form.errors.error" variant="danger">{{ form.errors.error }}</b-alert>
                    <b-alert :modelValue="!!form.errors.exception" variant="danger">{{ form.errors.exception }}</b-alert>
                    <b-alert :modelValue="!!form.errors" variant="danger" class="alert-top-border">
                        <div v-for="(error, index) in form.errors" :key="index" class="mb-1">
                            <i class="ri-error-warning-line me-3 align-middle fs-16 text-danger"></i> {{ error }}
                        </div>
                    </b-alert>
                </div>
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
                <div class="tab-content text-muted">
                    <div class="tab-pane" id="dist" role="tabpanel">
                        <PartialDist v-model:formData="form" :references="references"/>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <b-button @click="submit" v-if="form.id && !(['published','closed','cancelled'].includes(form.document_status))"
                        variant="primary" class="btn-label waves-effect waves-light me-1" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 me-2', form.processing ? 'ri-refresh-line' : 'ri-save-line']"></i>
                            {{ form.processing ? 'Processing' : 'Submit' }}
                        </b-button>
                        <b-button @click="deltaValidate" v-if="form.id && !['published','closed','cancelled'].includes(form.document_status)"
                        type="submit" variant="warning" class="btn-label waves-effect waves-light right me-1" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 ms-2', form.processing ? 'ri-refresh-line' : 'ri-check-line']"></i>
                            {{ form.processing ? 'Validating' : 'Validate' }}
                        </b-button>
                        <b-button @click="save('draft')" v-if="!form.id || !['published','closed','cancelled'].includes(form.document_status)"
                        type="submit" variant="light" class="btn-label waves-effect waves-light right" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 ms-2', form.processing ? 'ri-refresh-line' : 'ri-save-2-line']"></i>
                            {{ form.processing ? 'Processing' : 'Save as Draft' }}
                        </b-button>
                        <b-button @click="save('cancelled')" v-if="form.document_status == 'closed'"
                        type="submit" variant="danger" class="btn-label waves-effect waves-light right" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 ms-2', form.processing ? 'ri-refresh-line' : 'ri-close-line']"></i>
                            {{ form.processing ? 'Processing' : 'Void' }}
                        </b-button>
                        <!-- <b-button @click="submit" v-if="!(['published','closed','cancelled'].includes(form.document_status))"
                        type="submit" variant="primary" class="btn-label waves-effect waves-light me-1" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 me-2', form.processing ? 'ri-refresh-line' : 'ri-save-line']"></i>
                            {{ form.processing ? 'Processing' : 'Save' }}
                        </b-button>
                        <b-button @click="save('draft')" v-if="!['published','closed','cancelled'].includes(form.document_status)"
                        type="submit" variant="light" class="btn-label waves-effect waves-light right" :disabled="form.processing">
                            <i :class="['label-icon align-middle fs-16 ms-2', form.processing ? 'ri-refresh-line' : 'ri-save-2-line']"></i>
                            {{ form.processing ? 'Processing' : 'Draft' }}
                        </b-button> -->
                    </div>
                    <Link :href="route(`${page.module}.${page.name}.index`)" class="btn btn-info me-1">
                        <i class="ri-arrow-go-forward-line align-bottom me-1"></i>
                        Back
                    </Link>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script setup>
import { Head, Link, useForm  } from '@inertiajs/vue3'
import { ref, getCurrentInstance, onMounted } from 'vue'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'

import PartialHeader from './Partials/Header.vue'
import PartialLine from './Partials/Line.vue'
import PartialDist from './Partials/Dist.vue'
import entityData from './entity'
import service from './service'

const formElement = ref(null)
const page = entityData().page
const app = getCurrentInstance()

const dayjs = app.appContext.config.globalProperties.$dayjs

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Transaction' },
    { text: 'Invoice', to: route('transaction.invoices.index') },
    { text: 'Form', active: true },
]

const props = defineProps(['references','model'])

const form = useForm(props.model ? { ...props.model } : entityData().form)

onMounted(() => {
    if(!form.id){
        let now = dayjs().format('YYYY-MM-DD')
        form.invoice_date               = now
        form.posting_date               = now
        form.term_date                  = now
        form.due_date                   = now
        form.invoice_receipt_date       = now
        form.supplier_tax_invoice_date  = now
    }
})

const submit = () => {
    service.submitData(form, form.id)
}

const save = (status) => {
    service.saveData(form, status)
}

const deltaValidate = () => {
    service.validateData(form)
}
</script>
