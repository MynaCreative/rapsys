<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="code" class="form-label">Code</label>
            <b-form-input id="code" v-model="form.code" :class="{'is-invalid' : form.errors.code }"
                aria-describedby="input-code-feedback" :disabled="!!form.id"/>
            <b-form-invalid-feedback id="input-code-feedback" v-html="form.errors.code"/>
        </div>
        <div class="col-lg-12">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback" v-focus autofocus/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-12">
            <label for="type" class="form-label">Type</label>
            <b-form-radio-group
                v-model="form.type"
                :options="[
                    {text: 'Vat In', value: 1},
                    {text: 'Vat Out', value: 2},
                    {text: 'Withholding', value: 3},
                    {text: 'Credit', value: 4}
                ]"
                aria-describedby="input-type-feedback"
            ></b-form-radio-group>
            <b-form-invalid-feedback id="input-type-feedback" v-html="form.errors.type"/>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description" rows="4"></textarea>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'

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
</script>
