<template>
    <b-button variant="soft-primary" @click="reload" title="Reload">
        <i class="ri-refresh-line align-bottom me-1"></i>
    </b-button>
</template>
<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    page: {
        required: true,
    },
})

const reload = () => {
    // router.reload()
    router.visit(route(`${props.page.module}.${props.page.name}.index`))
}
</script>
