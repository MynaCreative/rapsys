<template>
    <div>
        <Items :form="form" :references="references"/>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
import Items from './Items.vue'

const props = defineProps(['formData','references'])
const emit  = defineEmits(['update:formData'])

const expenses = ref([])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})
</script>
