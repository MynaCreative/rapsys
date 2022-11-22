<template>
    {{ $dayjs(data).format('DD MMM, YYYY') }}
    <small class="text-muted">{{ $dayjs(data).format('HH:mm') }}</small>
</template>
<script setup>
const props = defineProps({
    data: {
        required: true,
    },
})
</script>
