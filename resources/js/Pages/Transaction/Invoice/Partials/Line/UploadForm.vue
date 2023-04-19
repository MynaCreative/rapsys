<template>
    <div class="row g-2">
        <div class="col-lg-6">
            <label for="code" class="form-label">Code</label>
            <b-form-input id="code" v-model="item.code" aria-describedby="input-code-feedback"/>
        </div>
        <div class="col-lg-6">
            <label for="date_item" class="form-label">Date Item</label>
            <b-form-input id="date_item" v-model="item.date_item" type="date"
                    aria-describedby="input-date_item-feedback"/>
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
            <label for="amount_awb_smu" class="form-label">Amount AWB (SMU)</label>
            <money3-component v-model.number="item.amount_awb_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-amount_awb_smu-feedback"></money3-component>
        </div>
        <div class="col-lg-6">
            <label for="delta_weight_smu" class="form-label">Delta Weight SMU (kg)</label>
            <money3-component v-model.number="item.delta_weight_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-delta_weight_smu-feedback"></money3-component>
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
    </div>
</template>
<script setup>
import { computed } from 'vue'
import { Money3Component } from 'v-money3'
import Multiselect from '@vueform/multiselect'

const props = defineProps(['formData','itemData','references','type'])
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

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
