<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-success">
            <h5 class="modal-title">Form Import - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <form @submit.prevent="submit">
            <div class="modal-body">
                <b-alert :show="!!form.errors.error" variant="danger">{{ form.errors.error }}</b-alert>
                <div class="border border-danger border-dotted rounded p-2 mb-4 text-muted" v-show="!!form.errors.exception">{{ form.errors.exception }}</div>
                <div class="row g-2">
                    <div class="col-lg-12">
                        <label for="excel_file" class="form-label">File</label>
                        <div class="input-group">
                            <input id="excel_file" ref="excel_file" type="file" class="form-control" :class="{'is-invalid' : form.errors.excel_file }" @change="getFile($event)" accept=".xlsx"
                                aria-describedby="input-excel_file-feedback">
                            <button class="btn btn-light" @click="removeFile" v-if="form.excel_file">
                                <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                            </button>
                        </div>
                        
                        <b-form-invalid-feedback id="input-excel_file-feedback" v-html="form.errors.excel_file"/>
                        <div class="form-text mt-4">
                            <a :href="route(`${page.module}.${page.name}.import-sample`)" target="_blank" class="text-black">
                                <i class="ri-attachment-2 align-bottom"></i>
                                Download Excel template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <b-button variant="light" @click="emit('update:show', false)">
                    <i class="ri-close-line align-bottom me-1"></i>
                    Close
                </b-button>
                <b-button type="submit" variant="success" class="btn-label waves-effect waves-light" :disabled="form.processing">
                    <i :class="['label-icon align-middle fs-16 me-2', form.processing ? 'ri-refresh-line' : 'ri-upload-2-line']"></i>
                    {{ form.processing ? 'Processing' : 'Import' }}
                </b-button>
            </div>
        </form>
    </ModalContainer>
</template>
<script setup>
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ModalContainer from '@/Components/Modal.vue'

import entityData from '../entity'
import service from '../service'

const page = entityData().page
const props = defineProps(['show'])
const emit  = defineEmits(['update:show'])

const form = useForm(entityData().form)
const excel_file = ref(null)

const getFile = (e) => {
    if(e.target.files){
        form.excel_file = e.target.files[0]
    }else{
        form.excel_file = null
    }
}

const removeFile = () => {
    form.reset()
    form.clearErrors()
    excel_file.value.value = null
}

const submit = () => {
    service.importData(form, emit)
}

watch(props, async (value) => {
    if(!value.show){
        removeFile()
    }
})
</script>
