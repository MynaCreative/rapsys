<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-success">
            <h5 class="modal-title">Report Export - Oracle Header</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="type" class="form-label">Creation Date</label>
                <input type="month" v-model="form.created_at" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Invoice Date</label>
                <input type="month" v-model="form.invoice_date" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Posting Date</label>
                <input type="month" v-model="form.posting_date" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Payment Method</label>
                <b-form-checkbox-group
                    v-model="form.payment_method_lookup_code"
                    :options="[
                        { text: 'Transfer', value: 'Transfer' },
                        { text: 'Check', value: 'Check' },
                    ]"
                    aria-describedby="input-type-feedback"
                ></b-form-checkbox-group>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Status</label>
                <b-form-checkbox-group
                    v-model="form.status"
                    :options="[
                        { text: 'I', value: 'I' },
                        { text: 'S', value: 'S' },
                        { text: 'E', value: 'E' },
                        { text: 'G', value: 'G' },
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
            <b-link :href="route(`${page.module}.${page.name}.oracle-header-export`, form)" target="_blank" variant="success" class="btn btn-label btn-success waves-effect waves-light" :disabled="form.processing">
                <i class="label-icon align-middle fs-16 me-2 bx bx-export"></i>
                Export
            </b-link>
        </div>
    </ModalContainer>
</template>
<script setup>
import { reactive, getCurrentInstance } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import entityData from '../entity'

const app = getCurrentInstance()
const dayjs = app.appContext.config.globalProperties.$dayjs

const page = entityData().page
const props = defineProps(['show'])
const emit  = defineEmits(['update:show'])

const form = reactive({
    type: 'xlsx',
    payment_method_lookup_code: ['Transfer','Check'],
    status: ['I','S','E','G'],
    created_at: dayjs().format('YYYY-MM'),
    invoice_date: null,
    posting_date: null,
})
</script>
