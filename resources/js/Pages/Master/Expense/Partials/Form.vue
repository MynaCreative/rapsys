<template>
    <div class="row g-2">
        <div class="col-lg-6">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback"/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-6">
            <label for="code" class="form-label">Code</label>
            <b-form-input id="code" v-model="form.code" :class="{'is-invalid' : form.errors.code }"
                aria-describedby="input-code-feedback" autofocus/>
            <b-form-invalid-feedback id="input-code-feedback" v-html="form.errors.code"/>
        </div>
        <div class="col-lg-6">
            <label for="coa" class="form-label">COA</label>
            <b-form-input id="coa" v-model="form.coa" :class="{'is-invalid' : form.errors.coa }"
                aria-describedby="input-coa-feedback"/>
            <b-form-invalid-feedback id="input-coa-feedback" v-html="form.errors.coa"/>
        </div>
        <div class="col-lg-6">
            <label for="coa_description" class="form-label">COA Description</label>
            <b-form-input id="coa_description" v-model="form.coa_description" :class="{'is-invalid' : form.errors.coa_description }"
                aria-describedby="input-coa_description-feedback"/>
            <b-form-invalid-feedback id="input-coa_description-feedback" v-html="form.errors.coa_description"/>
        </div>
        <div class="col-lg-6">
            <label for="icon" class="form-label">Icon</label>
            <b-form-input id="icon" v-model="form.icon" :class="{'is-invalid' : form.errors.icon }"
                aria-describedby="input-icon-feedback"/>
            <b-form-invalid-feedback id="input-icon-feedback" v-html="form.errors.icon"/>
        </div>
        <div class="col-lg-6">
            <label for="type" class="form-label">Type</label>
            <b-form-radio-group :class="{'is-invalid' : form.errors.type }"
                v-model="form.type"
                :options="[
                    { text: 'None', value: null },
                    { text: 'SMU', value: 1 },
                    { text: 'AWB', value: 2 },
                    { text: 'CONS', value: 3 },
                ]"
                aria-describedby="input-type-feedback"
            ></b-form-radio-group>
            <b-form-invalid-feedback id="input-type-feedback" v-html="form.errors.type"/>
        </div>
        <!-- <div class="col-lg-12">
            <label for="mandatory_scan" class="form-label">Mandatory Scan</label>
            <Multiselect id="mandatory_scan" v-model="form.mandatory_scan" :class="{'is-invalid' : form.errors.mandatory_scan }" :create-option="true" :close-on-select="false" :searchable="true" mode="tags"
                aria-describedby="input-mandatory_scan-feedback" :options="mandatory_scans" placeholder="Select data"></Multiselect>
            <b-form-input id="mandatory_scan" v-model="form.mandatory_scan" :class="{'is-invalid' : form.errors.mandatory_scan }"
                aria-describedby="input-mandatory_scan-feedback"/>
            <b-form-invalid-feedback id="input-mandatory_scan-feedback" v-html="form.errors.mandatory_scan"/>
        </div> -->
        <div class="col-lg-6">
            <label for="with_scan" class="form-label">With Scan</label>
            <b-form-input id="with_scan" v-model="form.with_scan" :class="{'is-invalid' : form.errors.with_scan }"
                aria-describedby="input-with_scan-feedback"/>
            <b-form-invalid-feedback id="input-with_scan-feedback" v-html="form.errors.with_scan"/>
        </div>
        <div class="col-lg-6">
            <label for="or_scan" class="form-label">Or Scan</label>
            <b-form-input id="or_scan" v-model="form.or_scan" :class="{'is-invalid' : form.errors.or_scan }"
                aria-describedby="input-or_scan-feedback"/>
            <b-form-invalid-feedback id="input-or_scan-feedback" v-html="form.errors.or_scan"/>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description" rows="4"></textarea>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'
import Multiselect from '@vueform/multiselect'

const props = defineProps(['formData'])
const emit  = defineEmits(['update:formData'])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const mandatory_scans = [
    'SMU',
    'GLO',
    'HOV',
    'POD',
    'PUP',
    'PUX',
    'DEX07',
    'DRO',
    'MDE',
    'MSP',
    'STAT37',
    'DEX37',
    'LTO',
]
</script>
