<template>
    <Link :href="locationValue" :data="sortLink" as="th" :class="['sort', sortClass]">{{ label }}</Link>
</template>
<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
const props = defineProps({
    label: {
        type: String,
        default: '',
    },
    attribute: {
        type: String,
        default: '',
    },
})

const locationValue = usePage().props.ziggy.location

const sortLink = computed(() => {
    let sortQuery = usePage().props.ziggy.query.sort
    let sortValue = null
    if (sortQuery == props.attribute) {
        sortValue = "-" + props.attribute
    } else if (sortQuery === "-" + props.attribute) {
        sortValue = null
    } else {
        sortValue = props.attribute
    }
    return sortValue ? { sort: sortValue } : {}
})

const sortClass = computed(() => {
    let sortQuery = usePage().props.ziggy.query.sort
    let sortClass = null
    if (sortQuery == props.attribute) {
        sortClass = 'asc'
    } else if (sortQuery === "-" + props.attribute) {
        sortClass = 'desc'
    } else {
        sortClass = null
    }
    return sortClass
})
</script>
<style>
.table .sort{
    position: relative;
}

thead .sort.asc:before,
thead .sort.desc:before {
    content:"\f0360";
    position: absolute;
    right: 0.5rem;
    top: 10px;
    font-size: .8rem;
    font-family: "Material Design Icons";
}

thead .sort.asc:after,
thead .sort.desc:after {
    content: "\f035d";
    position: absolute;
    right: 0.5rem;
    top: 16px;
    font-size: .8rem;
    font-family: "Material Design Icons";
}

.table-sm > thead .sort.asc:before,
.table-sm > thead .sort.desc:before {
    content:"\f0360";
    position: absolute;
    right: 0.5rem;
    top: 2px;
    font-size: .8rem;
    font-family: "Material Design Icons";
}

.table-sm > thead .sort.asc:after,
.table-sm > thead .sort.desc:after {
    content: "\f035d";
    position: absolute;
    right: 0.5rem;
    top: 8px;
    font-size: .8rem;
    font-family: "Material Design Icons";
}

thead .sort.asc:before {
    opacity: 0.8;
}
thead .sort.desc:after {
    opacity: 0.8;
}
</style>