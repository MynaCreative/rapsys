<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail SMU - {{ item?.smu }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
        <table class="table table-sm table-bordered" v-if="detail && !detail.err">
            <thead class="table-light text-muted">
                <tr>
                    <th class="text-center" width="40">#</th>
                    <th width="120">AWB</th>
                    <th class="text-end" width="160">Total SMU Weight (kg)</th>
                    <th class="text-end" width="180">Total All AWB Weight (kg)</th>
                    <th class="text-end" width="130">AWB Weight (kg)</th>
                    <th class="text-end">Amount Distribution</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(airwaybill, index) in detail.data.airwaybill" :key="index">
                    <td class="text-center">{{ index+1 }}</td>
                    <td>{{ airwaybill.awb }}</td>
                    <td class="text-end">{{ item.invoice_weight_smu }}</td>
                    <td class="text-end">{{ detail.data.tot_weight_all_awb }}</td>
                    <td class="text-end">{{ airwaybill.total_weight_awb }}</td>
                    <td class="text-end">{{ (item.amount_smu * (airwaybill.total_weight_awb / detail.data.tot_weight_all_awb)).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 4 }) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="p-4" v-else>
            {{ detail?.msg }}
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
import { ref, reactive, watch } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import service from '../service'

const props = defineProps(['show','item'])
const emit  = defineEmits(['update:show','update:item'])

const loading = ref(false)
let detail = reactive()

watch(props, async (value) => {
    if(value.item){
        loading.value = true
        detail = await service.smuPreview(value.item?.smu)
        loading.value = false
    }else{
        emit('update:item',null)
        detail = null
    }
})
</script>
