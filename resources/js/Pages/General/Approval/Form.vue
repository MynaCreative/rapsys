<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Created Date</p>
                                                            <h5 class="fs-15 mb-0"><DataTimestamp :data="form.created_at"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Updated Date</p>
                                                            <h5 class="fs-15 mb-0"><DataTimestamp :data="form.updated_at"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Invoice Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.invoice_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Posting Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.posting_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Term Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.term_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Due Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.due_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Supplier Inv Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.supplier_tax_invoice_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Receipt Date</p>
                                                            <h5 class="fs-15 mb-0"><DataDate :data="form.invoice_receipt_date"/></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Term</p>
                                                            <div class="badge text-bg-warning fs-12">{{ form.term?.name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Invoice Type</p>
                                                            <div class="badge text-bg-info fs-12">{{ form.invoice_type?.name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 mb-4">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Currency</p>
                                                            <div class="badge text-bg-secondary fs-12">{{ form.currency?.name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <PartialValidation v-model:formData="form" :references="references"/> -->

                                            <h6 class="mb-3 fw-semibold text-uppercase">Note</h6>
                                            <p>{{ form.note }}</p>

                                            <div>
                                                <Link :href="route('transaction.invoices.edit', form.id)" class="btn btn-link link-success p-0 shadow-none">Detail Invoice</Link>
                                            </div>

                                            <div class="pt-3 border-top border-top-dashed mt-4">
                                                <h6 class="mb-3 fw-semibold text-uppercase">Attachments</h6>
                                                <div class="row g-3">
                                                    <div class="col-xxl-4 col-lg-6" v-for="(attachment,index) in form.attachments" :key="index">
                                                        <div class="border rounded border-dashed p-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-title bg-light rounded fs-24 shadow shadow" style="color:#bf2718"
                                                                        v-if="attachment.type == 'application/pdf'">
                                                                        <i class="ri-file-text-line"></i>
                                                                    </div>
                                                                    <div class="avatar-title bg-light text-primary rounded fs-24 shadow shadow"
                                                                        v-if="attachment.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'">
                                                                        <i class="ri-file-word-line"></i>
                                                                    </div>
                                                                    <div class="avatar-title bg-light text-success rounded fs-24 shadow shadow"
                                                                        v-if="attachment.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'">
                                                                        <i class="ri-file-excel-line"></i>
                                                                    </div>
                                                                    <div class="avatar-title bg-light text-warning rounded fs-24 shadow shadow"
                                                                        v-if="['image/jpg','image/jpeg','image/png'].includes(attachment.type)">
                                                                        <i class="ri-image-line"></i>
                                                                    </div>
                                                                    <div class="avatar-title bg-light rounded fs-24 shadow shadow" style="color:#3a3ca1"
                                                                        v-if="['application/zip','application/x-zip-compressed','multipart/x-zip','application/vnd.rar','application/x-rar-compressed',''].includes(attachment.type)">
                                                                        <i class="ri-file-zip-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="fs-13 mb-1"><a :href="storageLink(attachment)" target="_blank" class="text-body text-truncate d-block">{{ attachment.name }}</a></h5>
                                                                    <div>{{ fileSizeSI(attachment.size) }}</div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-2">
                                                                    <div class="d-flex gap-1">
                                                                        <a class="btn btn-icon text-muted btn-sm fs-18 shadow-none" :href="storageLink(attachment)" target="_blank" v-if="form.id"><i class="ri-download-2-line"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Approver Action</h4>
                                    </div>
                                    <div class="card-body">
                                        <form @submit.prevent="submit" class="mt-4">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="exampleFormControlTextarea1" class="form-label text-body">Note</label>
                                                    <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" v-model="form.approval_note"></textarea>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="submit" @click="form.approval_status = 'rejected'" class="btn btn-danger mx-2">Reject</button>
                                                    <button type="submit" @click="form.approval_status = 'approved'" class="btn btn-success">Approve</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="mt-4 text-center">
                                            <h5 class="mb-1">{{ form.code }}</h5>
                                            <p class="text-muted">{{ form.department?.name }}</p>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th><span class="fw-medium">SBU</span></th>
                                                        <td>{{ form.sbu?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Interco</span></th>
                                                        <td>{{ form.interco?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Vendor</span></th>
                                                        <td>{{ form.vendor?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Vendor Site</span></th>
                                                        <td>{{ form.vendor_site?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Invoice Type</span></th>
                                                        <td>{{ form.invoice_type?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Currency</span></th>
                                                        <td>{{ form.currency?.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Supplier Tax Inv</span></th>
                                                        <td>{{ form.supplier_tax_invoice }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="card-body p-4 border-top border-top-dashed">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-4">Amount Before Tax</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th><span class="fw-medium">Total</span></th>
                                                        <td class="text-end">{{ form.total_amount.toLocaleString() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Total Valid</span></th>
                                                        <td class="text-end">{{ form.total_amount_valid.toLocaleString() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Total Invalid</span></th>
                                                        <td class="text-end">{{ form.total_amount_invalid.toLocaleString() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> -->
                                    <div class="card-body p-4 border-top border-top-dashed">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-4">Amount After Tax</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th><span class="fw-medium">Total</span></th>
                                                        <td class="text-end">{{ form.total_amount_after_tax.toLocaleString() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Total Valid</span></th>
                                                        <td class="text-end">{{ form.total_amount_valid.toLocaleString() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Total Invalid</span></th>
                                                        <td class="text-end">{{ form.total_amount_invalid.toLocaleString() }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Expenses</h5>
                                        <div class="d-flex flex-wrap gap-2 fs-16">
                                            <div class="badge fw-medium badge-soft-secondary">SMU</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header align-items-center d-flex border-bottom-dashed">
                                        <h4 class="card-title mb-0 flex-grow-1">Approvers</h4>
                                    </div>
                                    <div class="card-body">
                                        <div data-simplebar style="height: 150px;" class="mx-n3 px-3">
                                            <div class="vstack gap-3">
                                                <div class="d-flex align-items-center" v-for="item in form.approvals" :key="item.id">
                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                        <img :src="`/img/initials/${item.user?.name.charAt(0).toLowerCase()}.png`" class="img-fluid rounded-circle shadow">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">{{ item.user?.name }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import { Head, Link, useForm  } from '@inertiajs/vue3'
import { ref, getCurrentInstance, onMounted } from 'vue'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import DataDate from '@/Components/Data/Date.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
// import PartialValidation from '@/Pages/Transaction/Invoice/Partials/Validation.vue'

import entityData from './entity'
import service from './service'

const page = entityData().page
const app = getCurrentInstance()

const dayjs = app.appContext.config.globalProperties.$dayjs

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: page.title, active: true },
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

const storageLink = (file) => {
    if(file.url){
        return '/'+file.url+'/'+file.storage
    }
    return 'javascript:void(0)'
}

const fileSizeSI = (a,b,c,d,e) => {
    return (b=Math,c=b.log,d=1000,e=c(a)/c(d)|0,a/b.pow(d,e)).toFixed(2)
    +' '+(e?'kMGTPEZY'[--e]+'B':'Bytes')
}
</script>
