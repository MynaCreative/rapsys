<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ title }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item" v-for="(item, index) in breadcrumbs" :key="index" :class="{ active: item[0] }">
                            <Link :href="item.to">{{ item.text }}</Link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'
const props = defineProps({
    title: {
        type: String,
        default: "",
    },
    breadcrumbs: {
        type: Array,
        default: () => {
            return [];
        },
    },
})
</script>
