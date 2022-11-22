<template>
    <b-button variant="soft-primary" @click="reload" title="Reload">
        <i class="ri-refresh-line align-bottom me-1"></i>
    </b-button>
</template>
<script setup>
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    page: {
        required: true,
    },
})

const reload = () => {
    // Inertia.reload()
    Inertia.visit(route(`${props.page.module}.${props.page.name}.index`))
}
</script>
