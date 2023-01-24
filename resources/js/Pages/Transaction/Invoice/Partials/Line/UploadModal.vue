<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-info">
            <h5 class="modal-title">Line - Upload Form</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false), expensePicker = null"></button>
        </div>
        <form @submit.prevent="submit">
            <div class="modal-body">
                <div class="row g-2">
                    <template v-for="(expense, index) in references.expenses.filter((item) => item.code != 'MNL')" :key="index">
                        <div class="col-lg-6" v-if="!form.expenses.includes(expense.code)">
                            <div class="form-check card-radio">
                                <input :id="`expense-picker-${expense.code}`" v-model="expensePicker" :value="expense.code" type="radio" class="form-check-input">
                                <label class="form-check-label" :for="`expense-picker-${expense.code}`">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div :class="['avatar-title fs-18 rounded', 
                                                    {'bg-soft-info': expense.type == 1},
                                                    {'text-info': expense.type == 1},
                                                    {'bg-soft-primary': expense.type == 2},
                                                    {'text-primary': expense.type == 2}]">
                                                    <i :class="expense.icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">
                                                {{ expense.name }}
                                                <span :class="['badge rounded-pill', 
                                                    {'bg-soft-info': expense.type == 1},
                                                    {'text-info': expense.type == 1},
                                                    {'bg-soft-primary': expense.type == 2},
                                                    {'text-primary': expense.type == 2}
                                                ]">{{ expense.type_text }}</span>
                                            </h6>
                                            <b class="pay-amount">{{ expense.code }}</b>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </template>
                </div>
                <hr>
                <div class="row g-2" v-if="expensePicker">
                    <div class="form-text mt-4">
                        <a :href="route(`transaction.invoices.import-sample`, expensePicker ?? '')" target="_blank">
                            <i class="ri-attachment-2 align-bottom"></i>
                            Download Excel template [{{ expensePicker }}]
                        </a>
                        <br>
                        <span class="text-muted">Please using latest excel template above to import line item</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <b-button variant="light" @click="emit('update:show', false), expensePicker = null">
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
import { computed, ref } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

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

const expensePicker = ref(null)

const addItem = () => {
    form.value.expenses.push(expensePicker.value)
    expensePicker.value = null
    emit('update:show', false)
}
</script>
