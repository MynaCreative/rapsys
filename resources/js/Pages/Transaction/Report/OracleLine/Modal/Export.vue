<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-success">
            <h5 class="modal-title">Report Export - Oracle Line</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="type" class="form-label">Creation Date</label>
                <input type="month" v-model="form.created_at" class="form-control"/>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Status</label>
                <b-form-checkbox-group
                    v-model="form.status"
                    :options="[
                        { text: 'Success', value: 'V' },
                        { text: 'Error', value: 'E' },
                        // { text: 'Not Processed', value: null },
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
            <b-link :href="route(`${page.module}.${page.name}.oracle-line-export`, form)" target="_blank" variant="success" class="btn btn-label btn-success waves-effect waves-light" :disabled="form.processing">
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
    status: ['V','E',null],
    created_at: dayjs().format('YYYY-MM'),
})
</script>
