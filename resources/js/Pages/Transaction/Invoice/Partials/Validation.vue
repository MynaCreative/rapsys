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
