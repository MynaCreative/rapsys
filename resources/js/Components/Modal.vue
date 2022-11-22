<template>
    <div class="modal fade" ref="element" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div :class="['modal-dialog', size]">
            <div class="modal-content">
                <slot/>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Modal } from 'bootstrap'
import { ref, watch, onMounted } from 'vue'

const modal     = ref(null)
const element   = ref(null)
const props     = defineProps({
    visible: {
        required: true,
    },
    size: {
        required: false,
        default: null
    },
})

onMounted(() => {
    modal.value = new Modal(element.value)
})

watch(props, (value) => {
    if(value.visible){
        modal.value.show()
    }else{
        modal.value.hide()
    }
})
</script>
