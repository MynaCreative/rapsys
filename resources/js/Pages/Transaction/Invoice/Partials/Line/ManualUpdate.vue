<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Line - Manual Detail</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <form @submit.prevent="submit">
            <div class="modal-body">
                <PartialForm 
                    :form="form"
                    :item="item"
                    :references="references"/>
            </div>
            <div class="modal-footer justify-content-between">
                <b-button variant="light" @click="emit('update:show', false)">
                    <i class="ri-close-line align-bottom me-1"></i>
                    Close
                </b-button>
            </div>
        </form>
    </ModalContainer>
</template>
<script setup>
import { computed } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import PartialForm from './ManualForm.vue'

const props = defineProps(['show','formData','itemData','references'])
const emit  = defineEmits(['update:show','update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const item = computed({
    get() {
        return props.itemData
    },
    set(val) {
        emit("update:itemData", val)
    },
})
</script>
