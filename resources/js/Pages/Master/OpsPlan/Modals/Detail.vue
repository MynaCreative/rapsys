<template>
    <ModalContainer :visible="show" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail View - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="text-muted table-light" width="140">Code</td>
                    <td colspan="3">{{ form.code }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Mandatory Scan</td>
                    <td colspan="3">{{ form.mandatory_scan }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Name</td>
                    <td colspan="3">{{ form.name }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Description</td>
                    <td colspan="3" class="text-wrap">{{ form.description }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Created By</td>
                    <td><DataUserName :data="form.created_user?.name"/></td>
                    <td class="text-muted table-light">Time</td>
                    <td width="150"><DataTimestamp :data="form.created_at"/></td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Updated By</td>
                    <td><DataUserName :data="form.updated_user?.name"/></td>
                    <td class="text-muted table-light">Time</td>
                    <td><DataTimestamp :data="form.updated_at"/></td>
                </tr>
            </tbody>
        </table>
        </b-overlay>
        <div class="modal-footer">
            <b-button variant="light" @click="emit('update:show', false)">
                <i class="ri-close-line align-bottom me-1"></i>
                Close
            </b-button>
        </div>
    </ModalContainer>
</template>
<script setup>
import { ref,watch } from 'vue'
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

const loading = ref(false)

watch(props, async (value) => {
    form.reset()
    if(value.id){
        loading.value = true
        await service.showData(form, value.id)
        loading.value = false
    }else{
        emit('update:id',null)
    }
})
</script>
