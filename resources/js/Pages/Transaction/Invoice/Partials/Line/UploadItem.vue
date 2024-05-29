<template>
    <div class="row">
        <div class="col-lg-12 p-4">
            <table class="table table-sm">
                <thead class="table-light text-muted">
                    <tr>
                        <th>Item</th>
                        <th>Validation</th>
                        <th>Reason</th>
                        <th class="text-end">Count of Item</th>
                        <th class="text-end">Count of Weight (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr :class="[{'table-danger':expense.total_validation_reference > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Code</td>
                        <td>Data not found</td>
                        <td class="text-end">{{ expense.total_validation_reference.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_reference.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                    <tr :class="[{'table-danger':expense.total_validation_bill > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Bill</td>
                        <td>Already Billed</td>
                        <td class="text-end">{{ expense.total_validation_bill.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_bill.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                    <tr :class="[{'table-danger':expense.total_validation_weight > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Weight</td>
                        <td>Weight Not Match</td>
                        <td class="text-end">{{ expense.total_validation_weight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_weight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                    <tr :class="[{'table-danger':expense.total_validation_scan_compliance > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Scan Compliance</td>
                        <td>Scan Not Found</td>
                        <td class="text-end">{{ expense.total_validation_scan_compliance.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_scan_compliance.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                    <tr :class="[{'table-danger':expense.total_validation_ops_plan > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Ops Plan</td>
                        <td>Warning RPX Area</td>
                        <td class="text-end">{{ expense.total_validation_ops_plan.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_ops_plan.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                    <tr :class="[{'table-danger':expense.total_validation_data_revenue > 0}]">
                        <td>{{ expense.expense.name }}</td>
                        <td>Validation Data Revenue</td>
                        <td>Cost higher than revenue</td>
                        <td class="text-end">{{ expense.total_validation_data_revenue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                        <td class="text-end">{{ expense.total_weight_validation_data_revenue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- <div class="table-responsive" v-if="form.items.filter((item) => item.type == 'SMU').length > 0">
                <table class="table table-sm">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="text-center align-middle" width="40px" rowspan="2">#</th>
                            <th class="align-middle" rowspan="2">Code</th>
                            <th class="align-middle" rowspan="2">Type</th>
                            <th class="align-middle text-end" rowspan="2">Amount</th>
                            <th class="align-middle text-end" rowspan="2">Weight</th>
                            <th class="text-center" colspan="25">Validation</th>
                        </tr>
                        <tr>
                            <th class="text-center">SMU/AWB</th>
                            <th class="text-center">Bill</th>
                            <th class="text-center">Weight</th>
                            <th class="text-center">Scan Compliance</th>
                            <th class="text-center">Ops Plan</th>
                        </tr>
                    </thead>
                    <template v-if="form.items && form.items.length > 0">
                        <tbody>
                            <tr v-for="(item, index) in form.items" :key="index" :class="{'bg-soft-success': item.validation_score == 5}">
                                <td>{{ index+1 }}</td>
                                <td>
                                    <a v-if="item.type == 'SMU'" href="#" @click="() => {
                                        currentItem = item
                                        modalDetailVisible = true
                                    }">{{ item.code }}</a>
                                    <span v-else>{{ item.code }}</span>
                                </td>
                                <td >
                                    {{ item.type }}
                                </td>
                                <td :class="['text-end']">
                                    {{ item.amount ? item.amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '' }}
                                </td>
                                <td :class="['text-end']">
                                    {{ item.weight ? item.weight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '' }}
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_reference"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_bill"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_weight"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_scan_compliance"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_ops_plan"></i>
                                    <i class="ri-close-line text-danger" v-else></i>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                    <tbody v-else>
                        <td colspan="99" class="text-center text-muted">
                            <em>There are no item in this table</em>
                        </td>
                    </tbody>
                </table>
            </div> -->
        </div>
    </div>
    <ModalDetail
        :show="modalDetailVisible"
        @update:show="modalDetailVisible = $event"
        :item="currentItem"
        @update:item="currentItem = $event"
    />
</template>
<script setup>
import { ref, computed } from 'vue'

import ModalDetail from '../../Modals/SmuPreview.vue'

const props = defineProps(['formData','expense','references'])
const emit  = defineEmits(['update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const currentItem = ref(null)
const modalDetailVisible = ref(false)
</script>
