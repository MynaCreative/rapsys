<template>
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
            aria-describedby="input-name-feedback" v-focus autofocus :disabled="!!form.id"/>
        <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
    </div>
    <div class="mb-3">
        <label for="label" class="form-label">Label:</label>
        <b-form-input id="label" v-model="form.label" :class="{'is-invalid' : form.errors.label }"
            aria-describedby="input-label-feedback"/>
        <b-form-invalid-feedback id="input-label-feedback" v-html="form.errors.label"/>
    </div>
    <div class="mb-3">
        <label for="guard" class="form-label">Guard:</label>
        <b-form-input id="guard" v-model="form.guard_name" :class="{'is-invalid' : form.errors.guard_name }"
            aria-describedby="input-guard-feedback" disabled/>
        <b-form-invalid-feedback id="input-guard-feedback" v-html="form.errors.guard_name"/>
    </div>
    <div class="mb-3">
        <label for="permission-group" class="form-label">Permission Group:</label>
        <b-form-input id="permission-group" v-model="form.permission_group_id" :class="{'is-invalid' : form.errors.permission_group_id }"
            aria-describedby="input-permission-group-feedback"/>
        <b-form-invalid-feedback id="input-permission-group-feedback" v-html="form.errors.permission_group_id"/>
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
