<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-primary">
            <h5 class="modal-title">Approval View - {{ invoice.invoice_number }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 70px;" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col">Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item,index in invoice.approvals" :key="index">
                            <td class="text-center">{{ index+1 }}</td>
                            <td><DataUserName :data="item.user.name"/></td>
                            <td>{{ item.user?.position ?? '-' }}</td>
                            <td class="text-center">
                                <b-badge variant="soft-primary" class="text-primary text-capitalize" v-if="!item.approved_at && !item.rejected_at">{{ item.status }}</b-badge>
                                <b-badge variant="soft-success" class="text-success text-capitalize" v-if="item.approved_at && !item.rejected_at">{{ item.status }}</b-badge>
                                <b-badge variant="soft-danger" class="text-danger text-capitalize" v-if="!item.approved_at && item.rejected_at">{{ item.status }}</b-badge>
                            </td>
                            <td>
                                <DataTimestamp :data="item.rejected_at" v-if="!item.approved_at && item.rejected_at"/>
                                <DataTimestamp :data="item.approved_at" v-if="item.approved_at && !item.rejected_at"/>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
import { reactive, ref,watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ModalContainer from '@/Components/Modal.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import DataUserName from '@/Components/Data/UserName.vue'

import entityData from '../entity'
import service from '../service'

const page = entityData().page
const props = defineProps(['show','id'])
const emit  = defineEmits(['update:show','update:id'])

const form = useForm(entityData().form)

const loading = ref(false)
let invoice = reactive([])

watch(props, async (value) => {
    form.reset()
    if(value.id){
        loading.value = true
        invoice = await service.showApproval(value.id)
        loading.value = false
    }else{
        emit('update:id',null)
    }
})
</script>
