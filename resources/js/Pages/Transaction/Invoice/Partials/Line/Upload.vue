<template>
    <div class="row g-2" v-if="!form.id || (form.id && form.items.filter((item) =>  item.type !== 'MNL' && item.expense_id == expense.id).length == 0)">
        <div class="col-lg-12 p-4">
            <label for="excel_file" class="form-label">File</label>
            <div class="input-group">
                <input id="excel_file" ref="excel_file" type="file" class="form-control" :class="{'is-invalid' : form.errors.excel_file }" @change="getFile($event)" accept=".xlsx"
                    aria-describedby="input-excel_file-feedback">
                <a href="#" class="btn btn-light" @click="removeFile">
                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                </a>
            </div>
            <b-form-invalid-feedback id="input-excel_file-feedback" v-html="form.errors.excel_file"/>
            <div class="form-text mt-4">
                <a :href="route(`transaction.invoices.import-sample`, expense.code ?? '')" target="_blank">
                    <i class="ri-attachment-2 align-bottom"></i>
                    Download Excel template [{{ expense.code }}]
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive" v-else>
        <table class="table table-sm">
            <thead class="table-light text-muted">
                <tr>
                    <th class="text-center" width=40px>#</th>
                    <th>{{ expense.type_text }}</th>
                    <th class="text-end">Amount</th>
                    <th class="text-end">Weight</th>
                    <th>Withholding</th>
                    <th>Tax</th>
                    <th>Area</th>
                    <th>Product / Project</th>
                </tr>
            </thead>
            <template v-if="form.items && form.items.length > 0 && form.items.filter((item) => item.type !== 'MNL' && item.expense_id == expense.id).length > 0">
                <tbody>
                    <UploadItem v-for="(item, index) in form.items.filter((item) => item.type !== 'MNL' && item.expense_id == expense.id)" :key="index"
                        :formData="form"
                        @update:formData="form = $event"
                        :itemData="item"
                        @update:itemData="item = $event"
                        :references="references"
                        :index="index"
                        :type="expense.code"
                    />
                </tbody>
                <!-- <tfoot class="bg-soft-light text-muted">
                    <tr>
                        <td class="fw-medium text-end" colspan="9">Total</td>
                        <td class="fw-medium text-end">0.00</td>
                        <td class="fw-medium text-end">0.00</td>
                    </tr>
                </tfoot> -->
            </template>
            <tbody v-else>
                <td colspan="99" class="text-center text-muted">
                    <em>There are no item in this table</em>
                </td>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
import { remove } from 'lodash'

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
        form.value.uploads.push({
            excel_file : e.target.files[0],
            expense_id : props.expense.id,
            expense_code : props.expense.code,
            type : props.expense.type == 1 ? 'SMU' : 'AWB'
        })
    }else{
        remove(form.value.uploads, {expense_id:props.expense.id})
        excel_file.value.value = null
    }
}

const removeFile = () => {
    remove(form.value.uploads, {expense_id:props.expense.id})
    excel_file.value.value = null
}
</script>
