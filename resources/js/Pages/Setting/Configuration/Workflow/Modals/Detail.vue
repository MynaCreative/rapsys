<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail View - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="text-muted table-light" width="100">Code</td>
                    <td colspan="3">{{ form.code }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Department</td>
                    <td colspan="3">{{ form.department?.name }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Name</td>
                    <td colspan="3">{{ form.name }}</td>
                </tr>
                <tr>
                    <td class="text-muted table-light">Items</td>
                    <td colspan="3" class="p-0">
                        <table class="table table-sm table-bordered table-nowrap m-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle">User</th>
                                    <th class="align-middle text-center">Range From</th>
                                    <th class="align-middle text-center">Range To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item, index in form.items" :key="index">
                                    <td class="text-center">{{ item.sequence }}</td>
                                    <td>{{ item.user?.name }}</td>
                                    <td class="text-end">{{ item.range_from.toLocaleString() }}</td>
                                    <td class="text-end">{{ item.range_to.toLocaleString() }}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </td>
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
