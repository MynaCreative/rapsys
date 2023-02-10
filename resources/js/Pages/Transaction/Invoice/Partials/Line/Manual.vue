<template>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead class="table-light text-muted">
                <tr>
                    <th class="text-center cursor-pointer" width="40px">
                        <i class="ri-add-line text-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Create"></i>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" @click="modalFormVisible = true, expenseType = 'SMU'">SMU</a>
                            <a class="dropdown-item" href="javascript:void(0);" @click="modalFormVisible = true, expenseType = 'AWB'">AWB</a>
                        </div>
                    </th>
                    <th class="text-center" width=40px>#</th>
                    <th>AWB</th>
                    <th>SMU</th>
                    <th class="text-end">Amount</th>
                    <th class="text-end">Weight</th>
                    <th>Expense COA</th>
                    <th>Withholding</th>
                    <th>Tax</th>
                    <th>Area</th>
                    <th>Product / Project</th>
                </tr>
            </thead>
            <template v-if="form.items && form.items.length > 0 && form.items.filter((item) => item.is_manual).length > 0">
                <tbody>
                    <ManualItem v-for="(item, index) in form.items.filter((item) => item.is_manual)" :key="index"
                        :formData="form"
                        @update:formData="form = $event"
                        :itemData="item"
                        @update:itemData="item = $event"
                        :references="references"
                        :index="index"
                    />
                </tbody>
                <!-- <tfoot class="bg-soft-light text-muted">
                    <tr>
                        <td class="fw-medium text-end" colspan="9">Total</td>
                        <td class="fw-medium text-end">0.00</td>
                        <td class="fw-medium text-end">0.00</td>
                    </tr>
                </tfoot> -->
            </template>
            <tbody v-else>
                <td colspan="99" class="text-center text-muted">
                    <em>There are no item in this table</em>
                </td>
            </tbody>
        </table>
        <ManualCreate
            :show="modalFormVisible"
            @update:show="modalFormVisible = $event"
            :formData="form"
            @update:formData="form = $event"
            :references="references"
            :type="expenseType"
        />
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
import ManualCreate from './ManualCreate.vue'
import ManualItem from './ManualItem.vue'

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

const modalFormVisible = ref(false)
const expenseType = ref()
</script>
