<template>
    <div class="row g-2">
        <div class="col-lg-6">
            <label for="code" class="form-label">Item Number</label>
            <b-form-input id="code" v-model="item.code" aria-describedby="input-code-feedback"/>
        </div>
        <div class="col-lg-6">
            <label for="date_item" class="form-label">Item Date</label>
            <b-form-input id="date_item" v-model="item.date_item" type="date" aria-describedby="input-date_item-feedback"/>
        </div>
        <div class="col-lg-6">
            <label for="amount" class="form-label">Amount</label>
            <money3-component v-model.number="item.amount" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-amount-feedback"></money3-component>
        </div>
        <div class="col-lg-6">
            <label for="weight" class="form-label">Weight (kg)</label>
            <money3-component v-model.number="item.weight" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-weight-feedback"></money3-component>
        </div>
        <!-- <div class="col-lg-6">
            <label for="cost_center" class="form-label">Department</label>
            <b-form-input id="cost_center" v-model="item.cost_center" aria-describedby="input-cost_center-feedback"/>
            <Multiselect id="cost_center" v-model="item.department" 
                @select="(option) => item.department_id = option.id" @clear="() => item.department_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-cost_center-feedback" :options="references.departments" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="route" class="form-label">Route</label>
            <b-form-input id="route" v-model="item.route" aria-describedby="input-route-feedback"/>
        </div> -->
        <div class="col-lg-6">
            <label for="withholding" class="form-label">Withholding</label>
            <Multiselect id="withholding" v-model="item.withholding" 
                @select="(option) => item.withholding_id = option.id" @clear="() => item.withholding_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-withholding-feedback" :options="references.withholdings" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="tax" class="form-label">Tax</label>
            <Multiselect id="tax" v-model="item.tax"
                @select="(option) => item.tax_id = option.id" @clear="() => item.tax_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-tax-feedback" :options="references.taxes" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="area" class="form-label">Area</label>
            <Multiselect id="area" v-model="item.area" 
                @select="(option) => item.area_id = option.id" @clear="() => item.area_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-area-feedback" :options="references.areas" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="product" class="form-label">Product / Project</label>
            <Multiselect id="product" v-model="item.product"
                @select="(option) => item.product_id = option.id" @clear="() => item.product_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-product-feedback" :options="references.products" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="sales_channel" class="form-label">Sales Channel</label>
            <Multiselect id="sales_channel" v-model="item.sales_channel" 
                @select="(option) => item.sales_channel_id = option.id" @clear="() => item.sales_channel_id = null" :object="true" label="name" valueProp="id"
                aria-describedby="input-sales_channel-feedback" :options="references.sales_channels" placeholder="Select data"></Multiselect>
        </div>
        <div class="col-lg-6">
            <label for="expense_coa" class="form-label">Expense COA</label>
            <b-form-input id="expense_coa" v-model="item.expense_coa" aria-describedby="input-expense_coa-feedback"/>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'
import { Money3Component } from 'v-money3'
import Multiselect from '@vueform/multiselect'

const props = defineProps(['formData','itemData','references'])
const emit  = defineEmits(['update:formData','update:itemData'])

const item = computed({
    get() {
        return props.itemData
    },
    set(val) {
        emit("update:itemData", val)
    },
})

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
