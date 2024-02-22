<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Report Filter - Invoice Header</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <div class="modal-body">
            <div class="row g-2">
                <div class="col-lg-12">
                    <label for="type" class="form-label">Type</label>
                    <!-- <b-form-radio-group
                        v-model="form.type"
                        :options="[
                            { text: 'Excel', value: 'xlsx' },
                                { text: 'PDF', value: 'dompdf' },
                        ]"
                        aria-describedby="input-type-feedback"
                    ></b-form-radio-group> -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <b-button variant="light" @click="emit('update:show', false)">
                <i class="ri-close-line align-bottom me-1"></i>
                Close
            </b-button>
        </div>
    </ModalContainer>
</template>
<script setup>
import ModalContainer from '@/Components/Modal.vue'

import entityData from '../entity'

const props = defineProps(['show'])
const emit  = defineEmits(['update:show'])
</script>
