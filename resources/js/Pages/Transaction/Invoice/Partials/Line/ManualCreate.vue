<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Line - Manual Form</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="closeModal"></button>
        </div>
        <form @submit.prevent="submit">
            <div class="modal-body">
                <PartialForm 
                    :formData="form"
                    @update:formData="form = $event"
                    :itemData="item"
                    @update:itemData="item = $event"
                    :references="references"
                    :type="type"/>
            </div>
            <div class="modal-footer justify-content-between">
                <b-button variant="light" @click="closeModal">
                    <i class="ri-close-line align-bottom me-1"></i>
                    Close
                </b-button>
                <b-button type="submit" variant="primary" class="btn-label waves-effect waves-light" @click="addItem">
                    <i :class="['label-icon align-middle fs-16 me-2 ri-add-line']"></i>
                    Add
                </b-button>
            </div>
        </form>
    </ModalContainer>
</template>
<script setup>
import { computed, reactive } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import PartialForm from './ManualForm.vue'

const props = defineProps(['show','formData','references','type'])
const emit  = defineEmits(['update:show','update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const initialItem = () => ({
    smu: null,
    awb: null,
    amount_smu: 0,
    amount_awb: 0,
    amount_awb_smu: 0,
    invoice_weight_smu: 0,
    invoice_weight_awb: 0,
    delta_weight_smu: 0,
    route: null,
    cost_center: null,
    withholding_id: null,
    withholding: null,
    tax_id: null,
    tax: null,
    area_id: null,
    area: null,
    product_id: null,
    product: null,
    sales_channel_id: null,
    sales_channel: null,
    date_smu: null,
    date_awb: null,
    is_manual: true,
    expense_id: 1,
    type: null,
    expense_code: 'MNL',
    expense_coa: null,
})

let item = {...initialItem()}

const addItem = () => {
    form.value.items.push({ ...item, type: props.type})
    item = initialItem()
    emit('update:show', false)
}

const closeModal = () => {
    item = initialItem()
    emit('update:show', false)
}
</script>
