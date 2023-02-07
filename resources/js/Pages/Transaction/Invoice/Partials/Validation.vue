<template>
    <div class="row">
        <div class="col-lg-12 p-4">
            <table class="table table-sm">
                <thead class="table-light text-muted">
                    <tr>
                        <th>Item</th>
                        <th>Validation</th>
                        <th>Reason</th>
                        <th class="text-end">Count of AWB/SMU</th>
                        <th class="text-end">Count of Weight (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SMU</td>
                        <td>Validation SMU/AWB</td>
                        <td>Data not found</td>
                        <td class="text-end">{{ validationReference.count.toLocaleString() }}</td>
                        <td class="text-end">{{ validationReference.weight.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>Pickup</td>
                        <td>Validation Weight SMU/AWB</td>
                        <td>Weight Not Match</td>
                        <td class="text-end">{{ validationWeight.count.toLocaleString() }}</td>
                        <td class="text-end">{{ validationWeight.weight.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>Pickup</td>
                        <td>Validation Scan Compliance</td>
                        <td>Scan Not Found</td>
                        <td class="text-end">{{ validationScanCompliance.count.toLocaleString() }}</td>
                        <td class="text-end">{{ validationScanCompliance.weight.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>Pickup</td>
                        <td>Validation Ops Plan</td>
                        <td>Warning RPX Area</td>
                        <td class="text-end">{{ validationOpsPlan.count.toLocaleString() }}</td>
                        <td class="text-end">{{ validationOpsPlan.weight.toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>Pickup</td>
                        <td>Validation Bill</td>
                        <td>Already Billed</td>
                        <td class="text-end">{{ validationBill.count.toLocaleString() }}</td>
                        <td class="text-end">{{ validationBill.weight.toLocaleString() }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="text-center align-middle" width="40px" rowspan="2">#</th>
                            <th class="align-middle" rowspan="2">Code</th>
                            <th class="align-middle" rowspan="2">AWB</th>
                            <th class="align-middle" rowspan="2">SMU</th>
                            <th class="align-middle text-end" rowspan="2">Amount</th>
                            <th class="align-middle text-end" rowspan="2">Weight</th>
                            <th class="text-center" colspan="25">Validation</th>
                        </tr>
                        <tr>
                            <th class="text-center">SMU/AWB</th>
                            <th class="text-center">Weight</th>
                            <th class="text-center">Scan Compliance</th>
                            <th class="text-center">Ops Plan</th>
                            <th class="text-center">Bill</th>
                        </tr>
                    </thead>
                    <template v-if="form.items && form.items.length > 0">
                        <tbody>
                            <tr v-for="(item, index) in form.items" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{ item.code }}</td>
                                <td>{{ item.awb ?? '--' }}</td>
                                <td>{{ item.smu ?? '--'}}</td>
                                <td :class="['text-end', {'bg-soft-danger': form.errors[`items.${index}.amount_smu`] || form.errors[`items.${index}.amount_awb`] }]">
                                    <template v-if="item.amount_smu">
                                        {{ item.amount_smu ? item.amount_smu.toLocaleString() : '' }}
                                    </template>
                                    <template v-if="item.amount_awb">
                                        {{ item.amount_awb ? item.amount_awb.toLocaleString() : '' }}
                                    </template>
                                </td>
                                <td :class="['text-end', {'bg-soft-danger': form.errors[`items.${index}.invoice_weight_smu`] || form.errors[`items.${index}.invoice_weight_awb`] }]">
                                    <template v-if="item.invoice_weight_smu">
                                        {{ item.invoice_weight_smu ? item.invoice_weight_smu.toLocaleString() : '' }}
                                    </template>
                                    <template v-if="item.invoice_weight_awb">
                                        {{ item.invoice_weight_awb ? item.invoice_weight_awb.toLocaleString() : '' }}
                                    </template>
                                </td>
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_reference"></i>
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
                                <td class="text-center">
                                    <i class="ri-check-line text-success" v-if="item.validation_bill"></i>
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
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'

const props = defineProps(['formData','references'])
const emit  = defineEmits(['update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const validationReferences = form.value.items.filter((item) => item.validation_reference)
const validationReference = {
    count : validationReferences.length ?? 0,
    weight : validationReferences.length ?? 0,
}

const validationWeights = form.value.items.filter((item) => item.validation_weight)
const validationWeight = {
    count : validationWeights.length ?? 0,
    weight : validationWeights.length ?? 0,
}

const validationScanCompliances = form.value.items.filter((item) => item.validation_scan_compliance)
const validationScanCompliance = {
    count : validationScanCompliances.length ?? 0,
    weight : validationScanCompliances.length ?? 0,
}

const validationOpsPlans = form.value.items.filter((item) => item.validation_ops_plan)
const validationOpsPlan = {
    count : validationOpsPlans.length ?? 0,
    weight : validationOpsPlans.length ?? 0,
}

const validationBills = form.value.items.filter((item) => item.validation_bill)
const validationBill = {
    count : validationBills.length ?? 0,
    weight : validationBills.length ?? 0,
}
</script>
