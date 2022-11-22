<template>
    <Layout>
        <slot name="header"></slot>
        <div class="row">
            <div class="col-lg-12"><slot /></div>
        </div>
    </Layout>
</template>
<script setup>
import Layout from '@/Layouts/Authenticated.vue'
</script>
