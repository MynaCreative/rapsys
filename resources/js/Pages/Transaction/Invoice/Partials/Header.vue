<template>
    <div class="card-body">
        <div class="row mb-3">
            <label for="code" class="col-sm-2 col-form-label">Voucher Number</label>
            <div class="col-sm-6">
                <input :value="form.id ? form.code : 'System Generated Number'" class="form-control text-muted" disabled/>
            </div>
            <label for="posting_date" class="col-sm-2 col-form-label required">Posting Date</label>
            <div class="col-sm-2">
                <b-form-input id="posting_date" v-model="form.posting_date" :class="{'is-invalid' : form.errors.posting_date }" type="date"
                    aria-describedby="input-posting_date-feedback" v-focus autofocus/>
                <b-form-invalid-feedback id="input-posting_date-feedback" v-html="form.errors.posting_date"/>
            </div>
        </div>
        <div class="row mb-3">
            <label for="invoice_number" class="col-sm-2 col-form-label required">Invoice Number</label>
            <div class="col-sm-2">
                <b-form-input id="invoice_number" v-model="form.invoice_number" :class="{'is-invalid' : form.errors.invoice_number }"
                    aria-describedby="input-invoice_number-feedback"/>
                <b-form-invalid-feedback id="input-invoice_number-feedback" v-html="form.errors.invoice_number"/>
            </div>
            <label for="invoice_date" class="col-sm-2 col-form-label required">Invoice Date</label>
            <div class="col-sm-2">
                <b-form-input id="invoice_date" v-model="form.invoice_date" :class="{'is-invalid' : form.errors.invoice_date }" type="date"
                    aria-describedby="input-invoice_date-feedback"/>
                <b-form-invalid-feedback id="input-invoice_date-feedback" v-html="form.errors.invoice_date"/>
            </div>
            <label for="invoice_receipt_date" class="col-sm-2 col-form-label required">Receipt Date</label>
            <div class="col-sm-2">
                <b-form-input id="invoice_receipt_date" v-model="form.invoice_receipt_date" :class="{'is-invalid' : form.errors.invoice_receipt_date }" type="date"
                    aria-describedby="input-invoice_receipt_date-feedback"/>
                <b-form-invalid-feedback id="input-invoice_receipt_date-feedback" v-html="form.errors.invoice_receipt_date"/>
            </div>
        </div>
        <div class="row mb-3">
            <label for="term" class="col-sm-2 col-form-label required">Term</label>
            <div class="col-sm-2">
                <b-form-input id="term" v-model="form.term_id" :class="{'is-invalid' : form.errors.term_id }"
                    aria-describedby="input-term-feedback"/>
                <b-form-invalid-feedback id="input-term-feedback" v-html="form.errors.term_id"/>
            </div>
            <label for="term_date" class="col-sm-2 col-form-label">Term Date</label>
            <div class="col-sm-2">
                <b-form-input id="term_date" v-model="form.term_date" :class="{'is-invalid' : form.errors.term_date }" type="date"
                    aria-describedby="input-term_date-feedback"/>
                <b-form-invalid-feedback id="input-term_date-feedback" v-html="form.errors.term_date"/>
            </div>
            <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
            <div class="col-sm-2">
                <b-form-input id="due_date" v-model="form.due_date" :class="{'is-invalid' : form.errors.due_date }" type="date"
                    aria-describedby="input-due_date-feedback"/>
                <b-form-invalid-feedback id="input-due_date-feedback" v-html="form.errors.due_date"/>
            </div>
        </div>
        <div class="row mb-3">
            <label for="vendor" class="col-sm-2 col-form-label required">Vendor</label>
            <div class="col-sm-2">
                <b-form-input id="vendor" v-model="form.vendor_id" :class="{'is-invalid' : form.errors.vendor_id }"
                    aria-describedby="input-vendor-feedback"/>
                <b-form-invalid-feedback id="input-vendor-feedback" v-html="form.errors.vendor_id"/>
            </div>
            <label for="vendor_name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-2">
                <b-form-input id="vendor_name" :value="form.vendor?.name"/>
            </div>
            <label for="vendor_site" class="col-sm-2 col-form-label">Site</label>
            <div class="col-sm-2">
                <b-form-input id="vendor_site" :value="form.vendor?.site"/>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label required">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" v-model="form.description" rows="4"></textarea>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'

const props = defineProps(['formData','references'])
const emit  = defineEmits(['update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})
</script>
