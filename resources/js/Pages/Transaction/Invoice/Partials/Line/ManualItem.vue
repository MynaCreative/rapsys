<template>
    <tr>
        <td class="text-center cursor-pointer">
            <i class="ri-close-line text-danger" title="Remove" @click="remove"></i>
        </td>
        <td  @click="modalFormVisible = true" class="cursor-pointer text-center">{{ index+1 }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer']">{{ item.dist }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.code`] }]">{{ item.code }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer text-end', {'bg-soft-danger': form.errors[`items.${index}.amount`] }]">
            {{ item.amount ? item.amount.toLocaleString() : 0 }}
        </td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer text-end', {'bg-soft-danger': form.errors[`items.${index}.weight`] }]">
            {{ item.weight ? item.weight.toLocaleString() : '' }}
        </td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.cost_center_id`] }]">{{ item.cost_center ? item.cost_center?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.expense_coa`] }]">{{ item.expense_coa ?? ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.withholding_id`] }]">{{ item.withholding ? item.withholding?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.tax_id`] }]">{{ item.tax ? item.tax?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.area_id`] }]">{{ item.area ? item.area?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.product_id`] }]">{{ item.area ? item.product?.name : ''  }}</td>
    </tr>
    <ManualUpdate
        :show="modalFormVisible"
        @update:show="modalFormVisible = $event"
        :formData="form"
        @update:formData="form = $event"
        :itemData="item"
        @update:itemData="item = $event"
        :references="references"
    />
</template>
<script setup>
import { computed, ref } from 'vue'
import ManualUpdate from './ManualUpdate.vue'

const props = defineProps(['formData','itemData','references','index'])
const emit  = defineEmits(['update:formData','update:itemData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const item = computed({
    get() {
        return props.itemData
    },
    set(val) {
        emit("update:itemData", val)
    },
})

const remove = () => {
    form.value.items.splice(props.index, 1)
}

const modalFormVisible = ref(false)
</script>
