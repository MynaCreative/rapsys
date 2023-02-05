<template>
    <div>
        <nav>
            <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist" >
                <li class="nav-item" v-for="expense in references.expenses" :key="`nav-item-${expense.id}`">
                    <a :class="['nav-link', {active: expense.code == 'MNL', 'd-none': !form.expenses.includes(expense.code)}]" :id="`nav-${expense.code}-tab`" :title="expense.name"
                        data-bs-toggle="tab" :href="`#nav-${expense.code}`" role="tab" :aria-controls="`nav-${expense.code}`" :aria-selected="expense.code == 'MNL'">
                        <i :class="`me-1 align-bottom ${expense.icon}`"></i> {{ expense.name }}
                        <!-- <span class="badge bg-danger align-middle ms-1" v-if="form.items.length > 0">{{ form.items.length }}</span> -->
                    </a>
                </li>
                <li class="nav-item" v-if="form.expenses.length < 6 && !(['published','closed','cancelled'].includes(form.document_status))">
                    <a class="nav-link" href="javascript:void(0);" @click="modalFormVisible = true">
                        <i class="me-1 align-bottom ri-upload-fill"></i>
                        Upload
                        <i class="ri-add-fill align-bottom"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="tab-content">
            <div :class="['tab-pane fade', {show: expense.code == 'MNL', active: expense.code == 'MNL'}]" :id="`nav-${expense.code}`"
                role="tabpanel" :aria-labelledby="`nav-${expense.code}-tab`" v-for="expense in references.expenses" :key="`tab-item-${expense.id}`">
                <LineManual :formData="form" :references="references" v-if="expense.code == 'MNL'"/>
                <LineUpload :formData="form" :references="references" :expense="expense" v-if="expense.code != 'MNL'"/>
            </div>
        </div>
    </div>
    <UploadModal
        :show="modalFormVisible"
        @update:show="modalFormVisible = $event"
        :formData="form"
        @update:formData="form = $event"
        :references="references"
    />
</template>
<script setup>
import { computed, ref } from 'vue'
import LineManual from './Line/Manual.vue'
import LineUpload from './Line/Upload.vue'
import UploadModal from './Line/UploadModal.vue'

const props = defineProps(['formData','references'])
const emit  = defineEmits(['update:formData'])

const expenses = ref([])

const form = computed({
    get() {
        return props.formData
    },
    set(val) {
        emit("update:formData", val)
    },
})

const modalFormVisible = ref(false)
</script>
