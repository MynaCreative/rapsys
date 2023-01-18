<template>
    <div class="d-flex justify-content-between mt-3">
        <nav role="navigation" aria-label="Pagination Navigation" class="table-responsive mb-3" v-if="data.links.length > 3">
            <ul class="pagination pagination-separated mb-0">
                <li v-for="(link, index) in data.links" :key="index"
                    :class="['page-item', {
                        disabled: link.url ? false : true,
                        active: link.active,
                    }]"
                >
                    <Link v-if="link.url" :href="link.url" class="page-link" v-html="link.label"></Link>
                    <span v-else class="page-link" v-html="link.label"></span>
                </li>
            </ul>
        </nav>
        <p class="text-muted p-2 me-2 d-none d-md-block d-lg-block">
            Showing
            <span class="fw-semibold">{{ data.from }}</span>
            to
            <span class="fw-semibold">{{ data.to }}</span>
            of
            <span class="fw-semibold">{{ data.total }}</span>
            results
        </p>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
})
</script>
