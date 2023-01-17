<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail View - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="text-muted table-light" width="100">User</td>
                    <td>{{ form.user?.name }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Email</td>
                    <td>{{ form.user?.email }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Position</td>
                    <td>{{ form.user?.position_text }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Sequence</td>
                    <td>{{ form.sequence }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Created At</td>
                    <td><DataTimestamp :data="form.created_at"/></td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Updated At</td>
                    <td><DataTimestamp :data="form.created_at"/></td>
                </tr>
            </tbody>
        </table>
        <div class="modal-footer">
            <b-button variant="light" @click="emit('update:show', false)">
                <i class="ri-close-line align-bottom me-1"></i>
                Close
            </b-button>
        </div>
    </ModalContainer>
</template>
<script setup>
import { watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ModalContainer from '@/Components/Modal.vue'

import DataUserName from '@/Components/Data/UserName.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'

import entityData from '../entity'
import service from '../service'

const page = entityData().page
const props = defineProps(['show','id'])
const emit  = defineEmits(['update:show','update:id'])

const form = useForm(entityData().form)

watch(props, async (value) => {
    if(value.id){
        service.showData(form, value.id)
    }else{
        emit('update:id',null)
    }
})
</script>
