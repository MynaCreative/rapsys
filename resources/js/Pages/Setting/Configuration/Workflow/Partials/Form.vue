<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="user" class="form-label">User</label>
            <Multiselect id="user" v-model="form.user_id" :class="{'is-invalid' : form.errors.user_id }" v-if="!form.id"
                aria-describedby="input-user-feedback" :options="references.users" placeholder="Select data"></Multiselect>
            <input class="form-control" :value="form.user.email" disabled v-else/>
            <b-form-invalid-feedback id="input-user-feedback" v-html="form.errors.user_id"/>
        </div>
        <div class="col-lg-12">
            <label for="sequence" class="form-label">Sequence</label>
            <b-form-input id="sequence" v-model="form.sequence" type="number" class="text-end" :class="{'is-invalid' : form.errors.sequence }"
                aria-describedby="input-sequence-feedback"/>
            <b-form-invalid-feedback id="input-sequence-feedback" v-html="form.errors.sequence"/>
        </div>
        <div class="col-lg-6">
            <label for="range_from" class="form-label">From</label>
            <money3-component v-model.number="form.range_from" v-bind="moneyConfig" class="form-control text-end" :class="{'is-invalid' : form.errors.range_from }" aria-describedby="input-range_from-feedback"></money3-component>
            <b-form-invalid-feedback id="input-range_from-feedback" v-html="form.errors.range_from"/>
        </div>
        <div class="col-lg-6">
            <label for="range_to" class="form-label">To</label>
            <money3-component v-model.number="form.range_to" v-bind="moneyConfig" class="form-control text-end" :class="{'is-invalid' : form.errors.range_to }" aria-describedby="input-range_to-feedback"></money3-component>
            <b-form-invalid-feedback id="input-range_to-feedback" v-html="form.errors.range_to"/>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description" rows="4"></textarea>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'
import { Money3Component } from 'v-money3'
import Multiselect from '@vueform/multiselect'

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

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
