<template>
    <span v-if="data">
        {{ $dayjs(data).format('DD MMM, YYYY') }}
    </span>
    <span v-else>
        --
    </span>
</template>
<script setup>
const props = defineProps({
    data: {
        required: true,
    },
})
</script>
