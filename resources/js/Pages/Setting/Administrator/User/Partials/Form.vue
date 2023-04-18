<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback" autofocus/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-12">
            <label for="username" class="form-label">Username</label>
            <b-form-input id="username" v-model="form.username" :class="{'is-invalid' : form.errors.username }"
                aria-describedby="input-username-feedback"/>
            <b-form-invalid-feedback id="input-username-feedback" v-html="form.errors.username"/>
        </div>
        <div class="col-lg-12">
            <label for="email" class="form-label">Email</label>
            <b-form-input id="email" v-model="form.email" :class="{'is-invalid' : form.errors.email }"
                aria-describedby="input-email-feedback"/>
            <b-form-invalid-feedback id="input-email-feedback" v-html="form.errors.email"/>
        </div>
        <div class="col-lg-12" v-if="!form.id">
            <label for="password" class="form-label">Password</label>
            <b-form-input type="password" id="password" v-model="form.password" :class="{'is-invalid' : form.errors.password }"
                aria-describedby="input-password-feedback"/>
            <b-form-invalid-feedback id="input-password-feedback" v-html="form.errors.password"/>
        </div>
        <div class="col-lg-12">
            <label for="position" class="form-label">Position</label>
            <b-form-input id="position" v-model="form.position" :class="{'is-invalid' : form.errors.position }"
                aria-describedby="input-position-feedback"/>
            <b-form-invalid-feedback id="input-position-feedback" v-html="form.errors.position"/>
        </div>
        <div class="col-lg-12">
            <label for="department" class="form-label">Department</label>
            <Multiselect id="department" v-model="form.department_id" :class="{'is-invalid' : form.errors.department_id }"
                aria-describedby="input-department-feedback" :options="references.departments" placeholder="Select data"></Multiselect>
            <b-form-invalid-feedback id="input-department-feedback" v-html="form.errors.department"/>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Roles</label>
            <div :class="['form-check', {'is-invalid' : form.errors.roles_id }]" v-for="(role, role_id) in references.roles" :key="role_id">
                <input :class="['form-check-input', {'is-invalid' : form.errors.roles_id }]" type="checkbox" v-model="form.roles_id"
                    :value="role_id" :id="`role-${role_id}`" aria-describedby="input-roles-feedback">
                <label class="form-check-label" :for="`role-${role_id}`">{{ role }}</label>
            </div>
            <b-form-invalid-feedback id="input-roles-feedback" v-html="form.errors.roles_id"/>
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
