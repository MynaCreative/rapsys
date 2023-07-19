<template>
    <UploadForm :formData="form" :expenseData="expense" :references="references" v-if="!form.id"/>
    <template v-else>
        <UploadItem :formData="form" :expense="expense" :references="references"/>
        <UploadForm :formData="form" :expenseData="expense" :references="references"/>
        <div class="mb-4"></div>
    </template>
</template>
<script setup>
import { computed } from 'vue'

import UploadItem from './UploadItem.vue'
import UploadForm from './UploadForm.vue'

const props = defineProps(['formData','references','expense'])
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
