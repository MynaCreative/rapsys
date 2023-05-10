<template>
    <ModalContainer :visible="show" @update:visible="show = $event" size="modal-lg">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail SMU - {{ item?.code }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
        <div class="p-2 mb-2 mt-2">
            <table class="table table-sm">
                <tr>
                    <td width="180px">SMU Number</td>
                    <td width="10px">:</td>
                    <th>{{ item ? item.code : '' }}</th>
                </tr>
                <tr>
                    <td>Weight SMU</td>
                    <td>:</td>
                    <th>{{ item ? item.weight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : 0 }}</th>
                </tr>
                <tr>
                    <td>Total Weight SMU</td>
                    <td>:</td>
                    <th>{{ detail.data?.total_weight_smu ? detail.data?.total_weight_smu.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-' }}</th>
                </tr>
                <tr>
                    <td>Total Weight All AWB</td>
                    <td>:</td>
                    <th>{{ detail.data?.tot_weight_all_awb ? detail.data?.tot_weight_all_awb.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '-' }}</th>
                </tr>
            </table>
        </div>
        <table class="table table-sm table-bordered table-hover" v-if="detail && !detail.err">
            <thead class="table-light text-muted">
                <tr>
                    <th class="text-center" width="40">#</th>
                    <th width="200">AWB</th>
                    <th class="text-end" width="130">AWB Weight (kg)</th>
                    <th class="text-end">Percentage</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="detail.data?.airwaybill" v-for="(airwaybill, index) in detail.data?.airwaybill" :key="index">
                    <td class="text-center">{{ index+1 }}</td>
                    <td>{{ airwaybill.awb }}</td>
                    <td class="text-end">{{ airwaybill.total_weight_awb }}</td>
                    <td class="text-end">{{ ((airwaybill.total_weight_awb / detail.data.tot_weight_all_awb) * 100).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td class="text-end">{{ (item.amount * (airwaybill.total_weight_awb / detail.data.tot_weight_all_awb)).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-end" colspan="2">Total</th>
                    <th class="text-end">{{ detail.data?.airwaybill ? sumBy(detail.data.airwaybill, (item) => item.total_weight_awb).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : 0 }}</th>
                    <th class="text-end">100</th>
                    <th class="text-end">{{ item ? item.amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : 0 }}</th>
                </tr>
            </tfoot>
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
import sumBy from 'lodash/sumBy'
import { ref, reactive, watch } from 'vue'
import ModalContainer from '@/Components/Modal.vue'

import service from '../service'

const props = defineProps(['show','item'])
const emit  = defineEmits(['update:show','update:item'])

const loading = ref(false)
let detail = reactive({})

watch(props, async (value) => {
    if(value.item){
        loading.value = true
        detail = await service.smuPreview(value.item?.code)
        loading.value = false
    }else{
        emit('update:item',null)
        detail = null
    }
})
</script>
