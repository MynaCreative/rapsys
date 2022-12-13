<template>
    <span v-if="data">
        {{ $dayjs(data).format('DD MMM, YYYY') }}
        <small class="text-muted">{{ $dayjs(data).format('HH:mm') }}</small>
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
