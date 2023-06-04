<template>
    <div class="row g-2" v-if="!form.id">
        <div class="col-lg-6 p-4">
            <label for="excel_file" class="form-label">File</label>
            <div class="input-group">
                <input id="excel_file" ref="excel_file" type="file" class="form-control" :class="{'is-invalid' : form.errors.excel_file }" @change="getFile($event)" accept=".xlsx"
                    aria-describedby="input-excel_file-feedback">
                <a href="#" class="btn btn-light" @click="removeFile">
                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                </a>
            </div>
            <b-form-invalid-feedback id="input-excel_file-feedback" v-html="expense.excel_file"/>
            <div class="form-text mt-4">
                <a :href="route(`transaction.invoices.import-sample`, expense.expense.code ?? '')" target="_blank">
                    <i class="ri-attachment-2 align-bottom"></i>
                    Download Excel template [{{ expense.expense.code }}]
                </a>
            </div>
        </div>
        <div class="col-lg-6 p-4">
            <label for="cost_center_upload" class="form-label">Cost Center</label>
            <Multiselect id="cost_center_upload" v-model="expense.cost_center"
                @select="(option) => expense.cost_center_id = option.id" :object="true" label="name" valueProp="id"
                aria-describedby="input-cost_center-feedback" :options="references.cost_centers" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6 px-4">
            <label for="withholding" class="form-label">Withholding</label>
            <Multiselect id="withholding" v-model="expense.withholding"
                @select="(option) => expense.withholding_id = option.id" :object="true" label="name" valueProp="id"
                aria-describedby="input-withholding-feedback" :options="references.withholdings" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6 px-4">
            <label for="tax" class="form-label">Tax</label>
            <Multiselect id="tax" v-model="expense.tax"
                @select="(option) => expense.tax_id = option.id" :object="true" label="name" valueProp="id"
                aria-describedby="input-tax-feedback" :options="references.taxes" placeholder="Select data"></Multiselect>
        </div>
    </div>
    <template v-else>
        <UploadItem :formData="form" :expense="expense" :references="references"/>
    </template>
</template>
<script setup>
import { computed, ref } from 'vue'
import Multiselect from '@vueform/multiselect'

import UploadItem from './UploadItem.vue'

const props = defineProps(['formData','references','expense'])
const emit  = defineEmits(['update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const excel_file = ref(null)

const getFile = (e) => {
    if(e.target.files){
        props.expense.excel_file = e.target.files[0]
    }else{
        props.expense.excel_file = null
        excel_file.value.value = null
    }
}

const removeFile = () => {
    props.expense.excel_file = null
    excel_file.value.value = null
}
</script>
