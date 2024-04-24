<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Report Filter - Invoice Header</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <form @submit.prevent="submit">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="type" class="form-label">Payment Method</label>
                    <b-form-checkbox-group
                        v-model="form.filters.payment_method_lookup_code"
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
                        v-model="form.filters.status"
                        :options="[
                            { text: 'Pending', value: 'I' },
                            { text: 'Posted', value: 'S' },
                            { text: 'Error', value: 'E' },
                            { text: 'Failed', value: 'G' },
                        ]"
                        aria-describedby="input-type-feedback"
                    ></b-form-checkbox-group>
                </div>
            </div>
            <div class="modal-footer">
                <b-button variant="light" @click="emit('update:show', false)">
                    <i class="ri-close-line align-bottom me-1"></i>
                    Close
                </b-button>
                <b-button variant="primary" class="btn btn-label waves-effect waves-light" type="submit">
                    <i class="label-icon align-middle fs-16 me-2 bx bx-search"></i>
                    Search
                </b-button>
            </div>
        </form>
    </ModalContainer>
</template>
<script setup>
import ModalContainer from '@/Components/Modal.vue'
import { router  } from '@inertiajs/vue3'
import { reactive } from 'vue';
import entityData from '../entity'

const page = entityData().page
const props = defineProps(['show'])
const emit  = defineEmits(['update:show'])

const queryString = route().params;

const form = reactive({
    ...queryString,
    filters: {
        payment_method_lookup_code: queryString.filters?.payment_method_lookup_code ?? ['Transfer','Check'],
        status: queryString.filters?.status ?? ['I','S','E','G'],
    }
});

const submit = () => {
    form.page = 1;

    router.get(route(`${page.module}.${page.name}.oracle-header`),form);
    closeModal();
};

const closeModal = () => {
    emit('update:show', false);
};
</script>
