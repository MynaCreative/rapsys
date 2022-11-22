<template>
    <span class="badge badge-soft-danger" v-if="data">No</span>
    <span class="badge badge-soft-success" v-else>Yes</span>
</template>
<script setup>
const props = defineProps({
    data: {
        required: true,
    },
})
</script>
