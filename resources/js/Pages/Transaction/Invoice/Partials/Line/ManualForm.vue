<template>
    <div class="row g-2">
        <template v-if="type == 'SMU'">
            <div class="col-lg-6">
                <label for="smu" class="form-label">SMU Number</label>
                <b-form-input id="smu" v-model="item.smu" aria-describedby="input-smu-feedback"/>
            </div>
            <div class="col-lg-6">
                <label for="date_smu" class="form-label">SMU Date</label>
                <b-form-input id="date_smu" v-model="item.date_smu" type="date"
                        aria-describedby="input-date_smu-feedback"/>
            </div>
            <div class="col-lg-6">
                <label for="amount_smu" class="form-label">SMU Amount</label>
                <money3-component v-model.number="item.amount_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-amount_smu-feedback"></money3-component>
            </div>
            <div class="col-lg-6">
                <label for="invoice_weight_smu" class="form-label">Invoice Weight (kg)</label>
                <money3-component v-model.number="item.invoice_weight_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-invoice_weight_smu-feedback"></money3-component>
            </div>
            <!-- <div class="col-lg-6">
                <label for="amount_awb_smu" class="form-label">Amount AWB (SMU)</label>
                <money3-component v-model.number="item.amount_awb_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-amount_awb_smu-feedback"></money3-component>
            </div>
            <div class="col-lg-6">
                <label for="delta_weight_smu" class="form-label">Delta Weight SMU (kg)</label>
                <money3-component v-model.number="item.delta_weight_smu" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-delta_weight_smu-feedback"></money3-component>
            </div> -->
        </template>
        <template v-if="type == 'AWB'">
            <div class="col-lg-6">
                <label for="awb" class="form-label">AWB RPX</label>
                <b-form-input id="awb" v-model="item.awb" aria-describedby="input-awb-feedback"/>
            </div>
            <div class="col-lg-6">
                <label for="date_awb" class="form-label">AWB Date</label>
                <b-form-input id="date_awb" v-model="item.date_awb" type="date"
                        aria-describedby="input-date_awb-feedback"/>
            </div>
            <div class="col-lg-6">
                <label for="amount_awb" class="form-label">AWB Amount</label>
                <money3-component v-model.number="item.amount_awb" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-amount_awb-feedback"></money3-component>
            </div>
            <div class="col-lg-6">
                <label for="invoice_weight_awb" class="form-label">Invoice Weight (kg)</label>
                <money3-component v-model.number="item.invoice_weight_awb" v-bind="moneyConfig" class="form-control text-end" aria-describedby="input-invoice_weight_awb-feedback"></money3-component>
            </div>
        </template>
        <div class="col-lg-6">
            <label for="cost_center" class="form-label">Cost Center</label>
            <b-form-input id="cost_center" v-model="item.cost_center" aria-describedby="input-cost_center-feedback"/>
        </div>
        <div class="col-lg-6">
            <label for="route" class="form-label">Route</label>
            <b-form-input id="route" v-model="item.route" aria-describedby="input-route-feedback"/>
        </div>
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
