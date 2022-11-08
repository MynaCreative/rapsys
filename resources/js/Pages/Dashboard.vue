<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="row">
            <div class="col-lg-12">You're logged in!</div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>
