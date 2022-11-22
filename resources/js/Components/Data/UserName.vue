<template>
    <div class="d-flex align-items-center" v-if="data">
        <div class="flex-shrink-0">
            <img :src="`/img/initials/${data.charAt(0).toLowerCase()}.png`" class="avatar-xxxs rounded-circle">
        </div>
        <div class="flex-grow-1 ms-2">{{ data }}</div>
    </div>
</template>
<script setup>
const props = defineProps({
    data: {
        required: true,
    },
})
</script>
