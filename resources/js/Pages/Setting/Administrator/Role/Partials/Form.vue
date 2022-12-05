<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback" v-focus autofocus/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-12">
            <label for="guard" class="form-label">Guard</label>
            <b-form-input id="guard" v-model="form.guard_name" :class="{'is-invalid' : form.errors.guard_name }"
                aria-describedby="input-guard-feedback" disabled/>
            <b-form-invalid-feedback id="input-guard-feedback" v-html="form.errors.guard_name"/>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Permissions</label>
            <div :class="['form-check', {'is-invalid' : form.errors.permissions_id }]" v-for="(permission, permission_id) in references.permissions" :key="permission_id">
                <input :class="['form-check-input', {'is-invalid' : form.errors.permissions_id }]" type="checkbox" v-model="form.permissions_id"
                    :value="permission_id" :id="`permission-${permission_id}`" aria-describedby="input-permissions-feedback">
                <label class="form-check-label" :for="`permission-${permission_id}`">{{ permission }}</label>
            </div>
            <b-form-invalid-feedback id="input-permissions-feedback" v-html="form.errors.permissions_id"/>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'
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
</script>
