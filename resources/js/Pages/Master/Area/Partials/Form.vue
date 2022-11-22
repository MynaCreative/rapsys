<template>
    <div class="mb-3">
        <label for="code" class="form-label">Code:</label>
        <b-form-input id="code" v-model="form.code" :class="{'is-invalid' : form.errors.code }"
            aria-describedby="input-code-feedback" :disabled="!!form.id"/>
        <b-form-invalid-feedback id="input-code-feedback" v-html="form.errors.code"/>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
            aria-describedby="input-name-feedback" v-focus autofocus/>
        <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
    </div>
    <div class="mb-3">
        <label for="coa" class="form-label">COA:</label>
        <b-form-input id="coa" v-model="form.coa" :class="{'is-invalid' : form.errors.coa }"
            aria-describedby="input-coa-feedback" v-focus autofocus/>
        <b-form-invalid-feedback id="input-coa-feedback" v-html="form.errors.coa"/>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" v-model="form.description" rows="4"></textarea>
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
