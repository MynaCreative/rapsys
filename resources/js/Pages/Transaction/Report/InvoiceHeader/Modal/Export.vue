<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-success">
            <h5 class="modal-title">Report Export - Invoice Header</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <div class="modal-body">
            <!-- <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <b-form-radio-group
                    v-model="form.type"
                    :options="[
                        { text: 'Excel', value: 'xlsx' },
                        { text: 'PDF', value: 'dompdf' },
                    ]"
                    aria-describedby="input-type-feedback"
                ></b-form-radio-group>
            </div> -->
            <div class="mb-3">
                <label for="type" class="form-label">Document Status</label>
                <b-form-checkbox-group
                    v-model="form.document_status"
                    :options="[
                        { text: 'Draft', value: 'draft' },
                        { text: 'Published', value: 'published' },
                        { text: 'Void', value: 'void' },
                        { text: 'Closed', value: 'closed' },
                    ]"
                    aria-describedby="input-type-feedback"
                ></b-form-checkbox-group>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Approval Status</label>
                <b-form-checkbox-group
                    v-model="form.approval_status"
                    :options="[
                        { text: 'None', value: 'none' },
                        { text: 'Pending', value: 'pending' },
                        { text: 'Approved', value: 'approved' },
                        { text: 'Rejected', value: 'rejected' },
                    ]"
                    aria-describedby="input-type-feedback"
                ></b-form-checkbox-group>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Data Type</label>
                <b-form-checkbox-group
                    v-model="form.data_type"
                    :options="[
                        { text: 'SMU', value: 1 },
                        { text: 'AWB', value: 2 },
                    ]"
                    aria-describedby="input-type-feedback"
                ></b-form-checkbox-group>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <b-button variant="light" @click="emit('update:show', false)">
                <i class="ri-close-line align-bottom me-1"></i>
                Close
            </b-button>
            <b-link :href="route(`${page.module}.${page.name}.invoice-header-export`, form)" target="_blank" variant="success" class="btn btn-label btn-success waves-effect waves-light" :disabled="form.processing">
                <i class="label-icon align-middle fs-16 me-2 bx bx-export"></i>
                Export
            </b-link>
        </div>
    </ModalContainer>
</template>
<script setup>
import { reactive } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import entityData from '../entity'

const page = entityData().page
const props = defineProps(['show'])
const emit  = defineEmits(['update:show'])

const form = reactive({
    type: 'xlsx',
    document_status: ['draft','published','void','closed'],
    approval_status: ['none','pending','approved','rejected'],
    data_type: [1,2],
})
</script>
