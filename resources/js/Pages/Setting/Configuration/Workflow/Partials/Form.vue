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
            <b-form-input id="sequence" v-model="form.sequence" type="number" :class="{'is-invalid' : form.errors.sequence }"
                aria-describedby="input-sequence-feedback"/>
            <b-form-invalid-feedback id="input-sequence-feedback" v-html="form.errors.sequence"/>
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
