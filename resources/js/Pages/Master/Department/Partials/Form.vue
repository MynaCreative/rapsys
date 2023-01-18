<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback" autofocus/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-12">
            <label for="cost_center" class="form-label">Cost Center</label>
            <b-form-input id="cost_center" v-model="form.cost_center" :class="{'is-invalid' : form.errors.cost_center }"
                aria-describedby="input-cost_center-feedback"/>
            <b-form-invalid-feedback id="input-cost_center-feedback" v-html="form.errors.cost_center"/>
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
