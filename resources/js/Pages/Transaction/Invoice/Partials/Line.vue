<template>
    <div>
        <nav>
            <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist" >
                <li class="nav-item" v-for="group in form.expenses" :key="`nav-item-${group.expense_id}`">
                    <a :class="['nav-link', {active: group.expense.code == 'MNL'}]" :id="`nav-${group.expense.code}-tab`" :title="group.expense.name"
                        data-bs-toggle="tab" :href="`#nav-${group.expense.code}`" role="tab" :aria-controls="`nav-${group.expense.code}`" :aria-selected="group.expense.code == 'MNL'">
                        <i :class="`me-1 align-bottom ${group.expense.icon}`"></i> {{ group.expense.name }}
                        <!-- <span class="badge bg-danger align-middle ms-1" v-if="form.items.length > 0">{{ form.items.length }}</span> -->
                    </a>
                </li>
                <li class="nav-item" v-if="!form.id && form.expenses.length < 6 && !(['published','closed','cancelled'].includes(form.document_status))">
                    <a class="nav-link" href="javascript:void(0);" @click="modalFormVisible = true">
                        <i class="me-1 align-bottom ri-upload-fill"></i>
                        Upload
                        <i class="ri-add-fill align-bottom"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="tab-content">
            <div v-for="group in form.expenses" :key="`tab-item-${group.expense.id}`"
                :class="['tab-pane fade', {show: group.expense.code == 'MNL', active: group.expense.code == 'MNL'}]" :id="`nav-${group.expense.code}`"
                role="tabpanel" :aria-labelledby="`nav-${group.expense.code}-tab`" >
                <LineManual :formData="form" :references="references" v-if="group.expense.code == 'MNL'"/>
                <LineUpload :formData="form" :references="references" :expense="group" v-if="group.expense.code != 'MNL'"/>
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
