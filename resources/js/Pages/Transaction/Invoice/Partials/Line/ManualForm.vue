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
            <v-select
                id="withholding"
                v-model="item.withholding"
                :options="references.withholdings"
                :clearable="false"
                label="name"
                aria-describedby="input-withholding-feedback"
                @update:model-value="(option) => (option ? (item.withholding_id = option.id) : (item.withholding_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="tax" class="form-label">Tax</label>
            <v-select
                id="tax"
                v-model="item.tax"
                :options="references.taxes"
                :clearable="false"
                label="name"
                aria-describedby="input-tax-feedback"
                @update:model-value="(option) => (option ? (item.tax_id = option.id) : (item.tax_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="area" class="form-label">Area</label>
            <v-select
                id="area"
                v-model="item.area"
                :options="references.areas"
                :clearable="false"
                label="name"
                aria-describedby="input-area-feedback"
                @update:model-value="(option) => (option ? (item.area_id = option.id) : (item.area_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="product" class="form-label">Product / Project</label>
            <v-select
                id="product"
                v-model="item.product"
                :options="references.products"
                :clearable="false"
                label="name"
                aria-describedby="input-product-feedback"
                @update:model-value="(option) => (option ? (item.product_id = option.id) : (item.product_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="sales_channel" class="form-label">Sales Channel</label>
            <v-select
                id="sales_channel"
                v-model="item.sales_channel"
                :options="references.sales_channels"
                :clearable="false"
                label="name"
                aria-describedby="input-sales_channel-feedback"
                @update:model-value="(option) => (option ? (item.sales_channel_id = option.id) : (item.sales_channel_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="cost_center" class="form-label">Cost Center</label>
            <v-select
                id="cost_center"
                v-model="item.cost_center"
                :options="references.cost_centers"
                :clearable="false"
                label="name"
                aria-describedby="input-cost_center-feedback"
                @update:model-value="(option) => (option ? (item.cost_center_id = option.id) : (item.cost_center_id = null))"
            />
        </div>
        <div class="col-lg-6">
            <label for="expense_coa" class="form-label">Expense COA</label>
            <b-form-input id="expense_coa" v-model="item.expense_coa" aria-describedby="input-expense_coa-feedback"/>
        </div>
        <div class="col-lg-6">
            <label for="description" class="form-label">Description</label>
            <b-form-input id="expense_coa" v-model="item.description" aria-describedby="input-description-feedback"/>
        </div>
    </div>
</template>
<script setup>
import { Money3Component } from 'v-money3'
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const props = defineProps(['formData','itemData','references'])

const form = defineModel('form', {
    type: Object,
    required: true
});

const item = defineModel('item', {
    type: Object,
    required: true
});

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
