<template>
    <div class="card-body">
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-2">
                <label for="department" class="form-label required">Department</label>
                <v-select
                    id="department"
                    v-model="form.department_id"
                    :options="references.departments"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.department_id }"
                    aria-describedby="input-department-feedback"
                />
                <b-form-invalid-feedback id="input-department-feedback" v-html="form.errors.department_id"/>
            </div>
            <div class="col-md-6 col-lg-2">
                <label for="sbu" class="form-label required">SBU</label>
                <v-select
                    id="sbu"
                    v-model="form.sbu_id"
                    :options="references.sbus"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.sbu_id }"
                    aria-describedby="input-sbu-feedback"
                />
                <b-form-invalid-feedback id="input-sbu-feedback" v-html="form.errors.sbu_id"/>
            </div>
            <div class="col-md-6 col-lg-2">
                <label for="invoice_type" class="form-label required">Invoice Type</label>
                <v-select
                    id="invoice_type"
                    v-model="form.invoice_type_id"
                    :options="references.invoice_types"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.invoice_type_id }"
                    aria-describedby="input-invoice_type-feedback"
                />
                <b-form-invalid-feedback id="input-invoice_type-feedback" v-html="form.errors.invoice_type_id"/>
            </div>
            <div class="col-md-6 col-lg-2">
                <label for="currency" class="form-label required">Currency</label>
                <v-select
                    id="currency"
                    v-model="form.currency_id"
                    :options="references.currencies"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.currency_id }"
                    aria-describedby="input-currency-feedback"
                />
                <b-form-invalid-feedback id="input-currency-feedback" v-html="form.errors.currency_id"/>
            </div>
            <div class="col-md-6 col-lg-4">
                <label for="interco" class="form-label required">Interco</label>
                <v-select
                    id="interco"
                    v-model="form.interco_id"
                    :options="references.intercos"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.interco_id }"
                    aria-describedby="input-interco-feedback"
                />
                <b-form-invalid-feedback id="input-interco-feedback" v-html="form.errors.interco_id"/>
            </div>
        </div>
        <hr>
        <div class="row g-4 mb-2">
            <div class="col-lg-4">
                <label for="invoice_number" class="form-label required">Invoice Number</label>
                <b-form-input id="invoice_number" v-model="form.invoice_number" :class="{'is-invalid' : form.errors.invoice_number }"
                    aria-describedby="input-invoice_number-feedback" autofocus/>
                <b-form-invalid-feedback id="input-invoice_number-feedback" v-html="form.errors.invoice_number"/>
            </div>
            <div class="col-lg-4">
                <label for="total_amount" class="form-label">Invoice Amount</label>
                <money3-component v-model.number="form.total_amount" v-bind="moneyConfig" disabled
                    class="form-control text-end" aria-describedby="input-total_amount-feedback"></money3-component>
                <b-form-invalid-feedback id="input-total_amount-feedback" v-html="form.errors.total_amount"/>
            </div>
            <div class="col-lg-4">
                <label for="code" class="form-label">Code</label>
                <input :value="form.id ? form.code : 'System Generated Number'" class="form-control text-muted" disabled/>
            </div>
        </div>
        <div class="row g-4 mb-2">
            <div class="col-lg-4">
                <label for="vendor" class="form-label required">Vendor</label>
                <v-select
                    id="vendor"
                    v-model="form.vendor_id"
                    :options="references.vendors"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.vendor_id }"
                    @update:model-value="() => (form.vendor_site_id = null)"
                    aria-describedby="input-vendor-feedback"
                />
                <b-form-invalid-feedback id="input-vendor-feedback" v-html="form.errors.vendor_id"/>
            </div>
            <div class="col-lg-4">
                <label for="invoice_date" class="form-label required">Invoice Date</label>
                <b-form-input id="invoice_date" v-model="form.invoice_date" :class="{'is-invalid' : form.errors.invoice_date }" type="date"
                    aria-describedby="input-invoice_date-feedback" @input="setInvoiceDate"/>
                <b-form-invalid-feedback id="input-invoice_date-feedback" v-html="form.errors.invoice_date"/>
            </div>
            <div class="col-lg-4">
                <label for="posting_date" class="form-label required">Posting Date</label>
                <b-form-input id="posting_date" v-model="form.posting_date" :class="{'is-invalid' : form.errors.posting_date }" type="date"
                    aria-describedby="input-posting_date-feedback"/>
                <b-form-invalid-feedback id="input-posting_date-feedback" v-html="form.errors.posting_date"/>
            </div>
        </div>
        <div class="row g-4 mb-2">
            <div class="col-lg-4">
                <label for="vendor_site" class="form-label required">Vendor Site</label>
                <v-select
                    id="vendor_site"
                    v-model="form.vendor_site_id"
                    :options="vendor_sites"
                    :reduce="(option) => option.id"
                    :clearable="false"
                    label="name"
                    :class="{'is-invalid' : form.errors.vendor_site_id }"
                    aria-describedby="input-vendor_site-feedback"
                />
                <b-form-invalid-feedback id="input-vendor_site-feedback" v-html="form.errors.vendor_site_id"/>
            </div>
            <div class="col-lg-4">
                <label for="invoice_receipt_date" class="form-label required">Receipt Date</label>
                <b-form-input id="invoice_receipt_date" v-model="form.invoice_receipt_date" :class="{'is-invalid' : form.errors.invoice_receipt_date }" type="date"
                    aria-describedby="input-invoice_receipt_date-feedback"/>
                <b-form-invalid-feedback id="input-invoice_receipt_date-feedback" v-html="form.errors.invoice_receipt_date"/>
            </div>
            <div class="col-lg-4">
                <label for="term_date" class="form-label">Term Date</label>
                <b-form-input id="term_date" v-model="form.term_date" :class="{'is-invalid' : form.errors.term_date }" type="date"
                    aria-describedby="input-term_date-feedback"/>
                <b-form-invalid-feedback id="input-term_date-feedback" v-html="form.errors.term_date"/>
            </div>
        </div>
        <div class="row g-4 mb-2">
            <div class="col-lg-2">
                <label for="supplier_tax_invoice" class="form-label">Supplier Tax Invoice</label>
                <b-form-input id="supplier_tax_invoice" v-model="form.supplier_tax_invoice" :class="{'is-invalid' : form.errors.supplier_tax_invoice }"
                    aria-describedby="input-supplier_tax_invoice-feedback"/>
                <b-form-invalid-feedback id="input-supplier_tax_invoice-feedback" v-html="form.errors.supplier_tax_invoice"/>
            </div>
            <div class="col-lg-2">
                <label for="term" class="form-label required">Payment Term</label>
                <v-select
                    id="term"
                    v-model="form.term"
                    :options="references.terms"
                    :clearable="false"
                    label="name"
                    @update:model-value="(option) => ((form.term_id = option.id), (setTerm(option)))"
                    :class="{'is-invalid' : form.errors.term_id }"
                    aria-describedby="input-term-feedback"
                />
                <b-form-invalid-feedback id="input-term-feedback" v-html="form.errors.term_id"/>
            </div>
            <div class="col-lg-4">
                <label for="supplier_tax_invoice_date" class="form-label">Supplier Tax Invoice Date</label>
                <b-form-input id="supplier_tax_invoice_date" v-model="form.supplier_tax_invoice_date" :class="{'is-invalid' : form.errors.supplier_tax_invoice_date }" type="date"
                    aria-describedby="input-supplier_tax_invoice_date-feedback"/>
                <b-form-invalid-feedback id="input-supplier_tax_invoice_date-feedback" v-html="form.errors.supplier_tax_invoice_date"/>
            </div>
            <div class="col-lg-4">
                <label for="due_date" class="form-label">Due Date</label>
                <b-form-input id="due_date" v-model="form.due_date" :class="{'is-invalid' : form.errors.due_date }" type="date"
                    aria-describedby="input-due_date-feedback" />
                <b-form-invalid-feedback id="input-due_date-feedback" v-html="form.errors.due_date"/>
            </div>
        </div>
        <div class="row g-2 mb-2">
            <div class="col-lg-12">
                <label for="note" class="form-label required">Note / Description</label>
                <b-form-textarea id="note" v-model="form.note" :class="{'is-invalid' : form.errors.note }" rows="4"
                    aria-describedby="input-note-feedback"/>
                <b-form-invalid-feedback id="input-note-feedback" v-html="form.errors.note"/>
            </div>
        </div>
        <hr>
        <div class="row g-2">
            <div class="col-lg-12">
                <div class="align-items-center d-flex mb-3">
                    <h4 class="card-title mb-0 flex-grow-1">Attachments ({{ form.attachments.length }})</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-soft-info btn-sm shadow-none" @click="getFile"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                        <input type="file" class="d-none" ref="attachment_file" accept=".doc,.docx,.xls,.xlsx,.pdf,.jpeg,.jpg,.png,.zip,.rar" @change="getFilePicked" multiple/>
                    </div>
                </div>
                <div class="g-2">
                    <div class="vstack gap-2" v-if="form.attachments !== null && form.attachments.length">
                        <div class="border rounded border-dashed p-2" v-for="(attachment,index) in form.attachments" :key="index">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded fs-24 shadow" style="color:#bf2718"
                                            v-if="attachment.type == 'application/pdf'">
                                            <i class="ri-file-text-line"></i>
                                        </div>
                                        <div class="avatar-title bg-light text-primary rounded fs-24 shadow"
                                            v-if="attachment.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'">
                                            <i class="ri-file-word-line"></i>
                                        </div>
                                        <div class="avatar-title bg-light text-success rounded fs-24 shadow"
                                            v-if="attachment.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'">
                                            <i class="ri-file-excel-line"></i>
                                        </div>
                                        <div class="avatar-title bg-light text-warning rounded fs-24 shadow"
                                            v-if="['image/jpg','image/jpeg','image/png'].includes(attachment.type)">
                                            <i class="ri-image-line"></i>
                                        </div>
                                        <div class="avatar-title bg-light rounded fs-24 shadow" style="color:#3a3ca1"
                                            v-if="['application/zip','application/x-zip-compressed','multipart/x-zip','application/vnd.rar','application/x-rar-compressed',''].includes(attachment.type)">
                                            <i class="ri-file-zip-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="fs-13 mb-1"><a href="javascript:void(0);" class="text-body text-truncate d-block">{{ attachment.name }}</a></h5>
                                    <div>{{ fileSizeSI(attachment.size) }}</div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <div class="d-flex gap-1">
                                        <a class="btn btn-icon text-muted btn-sm fs-18 shadow-none" :href="storageLink(attachment)" target="_blank" v-if="form.id"><i class="ri-download-2-line"></i></a>
                                        <button type="button" class="btn btn-icon text-muted btn-sm fs-18 shadow-none" @click.stop.prevent="removeFile(index)"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vstack gap-2" v-else>
                        <div class="border rounded border-dashed p-2 cursor-pointer" @click="getFile">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light text-muted rounded fs-24 shadow">
                                            <i class="ri-cloud-off-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="fs-13 mb-1"><a href="javascript:void(0);" class="text-body text-truncate d-block">No attachment on this invoice</a></h5>
                                    <div>Please upload the file relating to this invoice.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <b-form-invalid-feedback id="input-note-feedback" v-html="form.errors.attachments"/>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, getCurrentInstance } from 'vue'
import { Money3Component } from 'v-money3'
import filter from 'lodash/filter'
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps(['formData','references'])
const emit  = defineEmits(['update:formData'])

const attachment_file = ref('attachment_file')

const app = getCurrentInstance()
const dayjs = app.appContext.config.globalProperties.$dayjs

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const setTerm = (option) => {
    if(option){
        form.value.due_date =  dayjs(form.value.term_date).add(form.value.term.day, 'day').format('YYYY-MM-DD')
        form.value.term_date =  dayjs(form.value.term_date).add(form.value.term.day, 'day').format('YYYY-MM-DD')
    }
}

const setInvoiceDate = (option) => {
    form.value.due_date =  dayjs(option).add(form.value.term.day, 'day').format('YYYY-MM-DD')
    form.value.term_date =  dayjs(option).add(form.value.term.day, 'day').format('YYYY-MM-DD')
}

const vendor_sites = computed(() => filter(props.references.vendor_sites, (item) => {
    return item.vendor_id == form.value.vendor_id
}))

const getFile = (e) => {
    attachment_file.value.click()
}

const getFilePicked = (e) => {
    if(e.target.files){
        form.value.attachments.push(...e.target.files)
    }
}

const removeFile = (index) => {
    if (form.value.attachments.length >= 1) {
        form.value.attachments.splice(index, 1)
    }
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

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
