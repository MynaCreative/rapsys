<template>
    <tr>
        <td class="text-center cursor-pointer">
            <i class="ri-close-line text-danger" title="Remove" @click="remove"></i>
        </td>
        <td  @click="modalFormVisible = true" class="cursor-pointer text-center">{{ index+1 }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.awb`] }]">{{ item.awb }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.smu`] }]">{{ item.smu }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer text-end', {'bg-soft-danger': form.errors[`items.${index}.amount_smu`] || form.errors[`items.${index}.amount_awb`] }]">
            <template v-if="item.amount_smu">
                {{ item.amount_smu ? item.amount_smu.toLocaleString() : '' }}
            </template>
            <template v-if="item.amount_awb">
                {{ item.amount_awb ? item.amount_awb.toLocaleString() : '' }}
            </template>
        </td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer text-end', {'bg-soft-danger': form.errors[`items.${index}.invoice_weight_smu`] || form.errors[`items.${index}.invoice_weight_awb`] }]">
            <template v-if="item.invoice_weight_smu">
                {{ item.invoice_weight_smu ? item.invoice_weight_smu.toLocaleString() : '' }}
            </template>
            <template v-if="item.invoice_weight_awb">
                {{ item.invoice_weight_awb ? item.invoice_weight_awb.toLocaleString() : '' }}
            </template>
        </td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.withholding_id`] }]">{{ item.withholding ? item.withholding?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.tax_id`] }]">{{ item.tax ? item.tax?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.cost_center`] }]">{{ item.cost_center ?? ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.area_id`] }]">{{ item.area ? item.area?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.product_id`] }]">{{ item.area ? item.product?.name : ''  }}</td>
        <td  @click="modalFormVisible = true" :class="['cursor-pointer', {'bg-soft-danger': form.errors[`items.${index}.route`] }]">{{ item.route }}</td>
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

const total = computed(() =>{
    item.value.total = item.value.quantity * item.value.price
    return item.value.total ?? 0
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
