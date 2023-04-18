<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Form Export - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <div class="modal-body">
            <div class="row g-2">
                <div class="col-lg-12">
                    <b-form-group label="Type" v-slot="{ ariaDescribedby }">
                        <b-form-radio-group v-model="form.type" stacked
                            aria-describedby="ariaDescribedby"
                            :options="[
                                { text: 'Excel', value: 'xlsx' },
                                { text: 'PDF', value: 'dompdf' },
                            ]"
                        ></b-form-radio-group>
                    </b-form-group>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <b-button variant="light" @click="emit('update:show', false)">
                <i class="ri-close-line align-bottom me-1"></i>
                Close
            </b-button>
            <b-link :href="route(`${page.module}.${page.name}.export`, form)" target="_blank" variant="warning" class="btn btn-label btn-warning waves-effect waves-light" :disabled="form.processing">
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

const form = reactive(entityData().formExport)
</script>
