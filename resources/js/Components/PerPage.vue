<template>
    <b-input-group>
        <template #prepend>
            <b-input-group-text>Per Page</b-input-group-text>
        </template>
        <b-form-select v-model="per_page" :options="[10,20,30]" @change="($event) => $inertia.visit(locationValue, {
            data: {
                per_page: $event
            }
        })"></b-form-select>
    </b-input-group>
</template>
<script setup>
import { ref, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'

const per_page = ref(10)
const locationValue = usePage().props.ziggy.location
const perPageQuery = usePage().props.ziggy.query.per_page

if(perPageQuery){
    per_page.value = perPageQuery
}
</script>
