<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Form {{ id ? 'Update' : 'Create' }} - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <form @submit.prevent="submit">
            <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
            <div class="modal-body">
                <b-alert :show="!!form.errors.error" variant="danger">{{ form.errors.error }}</b-alert>
                <PartialForm v-model:formData="form"/>
            </div>
            </b-overlay>
            <div class="modal-footer justify-content-between">
                <b-button variant="light" @click="emit('update:show', false)">
                    <i class="ri-close-line align-bottom me-1"></i>
                    Close
                </b-button>
                <b-button type="submit" variant="primary" class="btn-label waves-effect waves-light" :disabled="form.processing">
                    <i :class="['label-icon align-middle fs-16 me-2', form.processing ? 'ri-refresh-line' : 'ri-save-line']"></i>
                    {{ form.processing ? 'Processing' : 'Save' }}
                </b-button>
            </div>
        </form>
    </ModalContainer>
</template>
<script setup>
import { ref,watch } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import ModalContainer from '@/Components/Modal.vue'

import PartialForm from '../Partials/Form.vue'
import entityData from '../entity'
import service from '../service'

const page = entityData().page
const props = defineProps(['show','id'])
const emit  = defineEmits(['update:show','update:id'])

const form = useForm(entityData().form)

const submit = () => {
    service.submitData(form, props.id, emit)
}

const loading = ref(false)

watch(props, async (value) => {
    form.reset()
    if(value.id){
        loading.value = true
        await service.showData(form, value.id)
        loading.value = false
    }else{
        emit('update:id',null)
        form.reset()
        form.clearErrors()
    }
})
</script>
