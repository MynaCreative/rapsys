<template>
    <ModalContainer :visible="show" size="modal-lg" @update:visible="show = $event">
        <div class="modal-header p-3 bg-soft-warning">
            <h5 class="modal-title">Detail View - {{ page.title }}</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="emit('update:show', false)"></button>
        </div>
        <b-overlay :show="loading" :opacity="0.25" spinner-small rounded="sm">
            <nav>
                <ul class="nav nav-tabs nav-tabs-custom nav-warning nav-justified" id="nav-tab" role="tablist" >
                    <li class="nav-item">
                        <a :class="['nav-link', 'active']" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" :aria-selected="true">
                            Expense Detail
                        </a>
                    </li>
                    <li class="nav-item">
                        <a :class="['nav-link']" data-bs-toggle="tab" href="#nav-invoice" role="tab" aria-controls="nav-deinvoicetail" :aria-selected="true">
                            Invoice Line Column
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="tab-content">
                <div :class="['tab-pane fade', 'show', 'active']" id="nav-detail" role="tabpanel" :aria-labelledby="`nav-detail-tab`">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-muted table-light" width="140">Code</td>
                                <td colspan="3">{{ form.code }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">Name</td>
                                <td colspan="3">{{ form.name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">COA</td>
                                <td colspan="3">{{ form.coa }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">COA Description</td>
                                <td colspan="3">{{ form.coa_description }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">Type</td>
                                <td colspan="3">
                                    <span :class="['badge badge-label',{'bg-info': form.type == 1}, {'bg-secondary': form.type == 2}]" v-if="form.type != null">
                                        <i class="mdi mdi-circle-medium"></i> {{ form.type_text }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">Mandatory Scan</td>
                                <td colspan="3">
                                    <!-- <span class="badge badge-outline-info me-1" v-for="(mandatory_scan, index) in form.mandatory_scan" :key="index">
                                        {{ mandatory_scan }}
                                    </span> -->
                                    {{ form.mandatory_scan }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted table-light">Icon</td>
                                <td colspan="3">{{ form.icon }}</td>
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
                </div>
                <div :class="['tab-pane fade']" id="nav-invoice" role="tabpanel" :aria-labelledby="`nav-invoice-tab`">
                    <table class="table table-bordered table-hover table-sm" v-if="form.type_text == 'SMU'">
                        <tbody>
                            <tr v-for="(value, key) in typeSMU" :key="key">
                                <th class="text-muted table-light text-capitalize text-end" width="200">{{ key.split('_').join(' ') }}</th>
                                <td class="fw-bold">
                                    <i class="ri-check-line text-success" v-if="value"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover table-sm" v-if="form.type_text == 'AWB'">
                        <tbody>
                            <tr v-for="(value, key) in typeAWB" :key="key">
                                <th class="text-muted table-light text-capitalize text-end" width="200">{{ key.split('_').join(' ') }}</th>
                                <td class="fw-bold">
                                    <i class="ri-check-line text-success" v-if="value"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

const typeSMU = {
    no_smu              : true,
    amount_smu          : true,
    awb_rpx             : false,
    invoice_weight_smu  : true,
    invoice_weight_awb  : false,
    amount_awb          : false,
    amount_smu          : true,
    route_smu           : true,
    delta_weight_smu    : true,
    delta_weight_awb    : true,
    amount_awb_smu      : true,
}

const typeAWB = {
    no_smu              : false,
    amount_smu          : false,
    awb_rpx             : true,
    invoice_weight_smu  : false,
    invoice_weight_awb  : true,
    amount_awb          : true,
    amount_smu          : false,
    route_smu           : false,
    delta_weight_smu    : false,
    delta_weight_awb    : true,
    amount_awb_smu      : false,
}
</script>
