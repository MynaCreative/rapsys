<template>
    <div v-if="form.dists?.items?.length > 0">
        <table class="table table-sm table-bordered table-hover">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Dist</th>
                    <th>Description</th>
                    <th class="text-end">Amount</th>
                    <th class="text-center">WHT Code</th>
                    <th class="text-end">WHT Amount (-)</th>
                    <th class="text-center">VAT Code</th>
                    <th class="text-end">VAT Amount (+)</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in form.dists.items" :key="index">
                    <td class="text-center">{{ index+1 }}</td>
                    <td>{{ item.dist_code_concat }}</td>
                    <td>{{ item.description }}</td>
                    <td class="text-end">{{ item.amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td class="text-center">{{ item.awt_group_name }}</td>
                    <td class="text-end">{{ item.amount_withholding.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td class="text-center">{{ item.ppn_code }}</td>
                    <td class="text-end">{{ item.amount_tax.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td class="text-end">{{ item.amount_after_tax.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr v-if="form.dists.items.length > 0">
                    <td class="text-end fw-bold" colspan="3">Total</td>
                    <td class="text-end fw-bold">{{ sumBy(form.dists.items, (item) => item.amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td></td>
                    <td class="text-end fw-bold">{{ sumBy(form.dists.items, (item) => item.amount_withholding).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td></td>
                    <td class="text-end fw-bold">{{ sumBy(form.dists.items, (item) => item.amount_tax).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                    <td class="text-end fw-bold">{{ sumBy(form.dists.items, (item) => item.amount_after_tax).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr>
                <!-- <tr>
                    <td colspan="7"></td>
                </tr>
                <tr v-for="(item, index) in form.dists.taxes" :key="index">
                    <td class="text-end" colspan="6">{{ item.description }}</td>
                    <td class="text-end">{{ item.amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr>
                <tr v-if="form.dists.taxes">
                    <td class="text-end fw-bold" colspan="6">Total Tax (+)</td>
                    <td class="text-end fw-bold">{{ sumBy(form.dists.taxes, (item) => item.amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr>
                <tr>
                    <td colspan="9"></td>
                </tr>
                <tr>
                    <td class="text-end fw-bold" colspan="8">Grand Total</td>
                    <td class="text-end fw-bold">{{ (sumBy(form.dists.items, (item) => item.amount_after_tax)+sumBy(form.dists.taxes, (item) => item.amount)).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</td>
                </tr> -->
            </tbody>
        </table>
    </div>
</template>
<script setup>
import sumBy from 'lodash/sumBy'
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
</script>
