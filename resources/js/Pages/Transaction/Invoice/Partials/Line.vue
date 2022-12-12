<template>
    <ul class="nav nav-tabs nav-border-top nav-border-top-primary" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#MNL" role="tab" aria-selected="false">
                Manual
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('SAR')">
            <a class="nav-link" data-bs-toggle="tab" href="#SAR" role="tab" aria-selected="false">
                SMU Airlines
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('HSR')">
            <a class="nav-link" data-bs-toggle="tab" href="#HSR" role="tab" aria-selected="false">
                Handling SMU / RA Charges
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('DLO')">
            <a class="nav-link" data-bs-toggle="tab" href="#DLO" role="tab" aria-selected="false">
                Delivery Only
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('PCO')">
            <a class="nav-link" data-bs-toggle="tab" href="#PCO" role="tab" aria-selected="false">
                Pickup Only
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('PCD')">
            <a class="nav-link" data-bs-toggle="tab" href="#PCD" role="tab" aria-selected="false">
                Pickup & Delivery
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('CSL')">
            <a class="nav-link" data-bs-toggle="tab" href="#CSL" role="tab" aria-selected="false">
                Consolidator
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('MBG')">
            <a class="nav-link" data-bs-toggle="tab" href="#MBG" role="tab" aria-selected="false">
                MBG (Damage/Missing)
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('SHH')">
            <a class="nav-link" data-bs-toggle="tab" href="#SHH" role="tab" aria-selected="false">
                SHCP/Handcarry Handling
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('TMK')">
            <a class="nav-link" data-bs-toggle="tab" href="#TMK" role="tab" aria-selected="false">
                Tagihan Mitra Kurir (Insentif Bulanan)
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('RVN')">
            <a class="nav-link" data-bs-toggle="tab" href="#RVN" role="tab" aria-selected="false">
                Rental Van
            </a>
        </li>
        <li class="nav-item" v-if="expenses.includes('TLH')">
            <a class="nav-link" data-bs-toggle="tab" href="#TLH" role="tab" aria-selected="false">
                Trucking Line Haul
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <div class="dropdown">
                    <a
                        class="text-reset dropdown-btn"
                        href="#"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <span class="text-muted">
                            More Line Type
                            <i class="ri-more-fill align-middle me-2 fs-15"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" data-bs-toggle="tab" href="#SAR" role="tab" aria-selected="false" @click="expenses.push('SAR')">SMU Airlines</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#HSR" role="tab" aria-selected="false" @click="expenses.push('HSR')">Handling SMU / RA Charges</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#DLO" role="tab" aria-selected="false" @click="expenses.push('DLO')">Delivery Only</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#PCO" role="tab" aria-selected="false" @click="expenses.push('PCO')">Pickup Only</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#PCD" role="tab" aria-selected="false" @click="expenses.push('PCD')">Pickup & Delivery</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#CSL" role="tab" aria-selected="false" @click="expenses.push('CSL')">Consolidator</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#MBG" role="tab" aria-selected="false" @click="expenses.push('MBG')">MBG (Damage/Missing)</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#SHH" role="tab" aria-selected="false" @click="expenses.push('SHH')">SHCP/Handcarry Handling</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#TMK" role="tab" aria-selected="false" @click="expenses.push('TMK')">Tagihan Mitra Kurir (Insentif Bulanan)</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#RVN" role="tab" aria-selected="false" @click="expenses.push('RVN')">Rental Van</a>
                        <a class="dropdown-item" data-bs-toggle="tab" href="#TLH" role="tab" aria-selected="false" @click="expenses.push('TLH')">Trucking Line Haul</a>
                    </div>
                </div>
            </a>
            
        </li>
    </ul>
    <div class="tab-content  text-muted">
        <div class="tab-pane active" id="MNL" role="tabpanel">
            <div class="card-body" style="min-height:500px">
                <h6>Manual</h6>
                <Items :form="form" :references="references"/>
            </div>
        </div>
        <div class="tab-pane" id="SAR" role="tabpanel">
            <div class="card-body" style="min-height:500px">
                <h6>SMU Airlines</h6>
                <Items :form="form" :references="references"/>
            </div>
        </div>
        <div class="tab-pane" id="HSR" role="tabpanel">
            <div class="card-body" style="min-height:500px">
                <h6>Handling SMU / RA Charges</h6>
                <Items :form="form" :references="references"/>
            </div>
        </div>
        <div class="tab-pane" id="DLO" role="tabpanel">
            <div class="card-body" style="min-height:500px">
                <h6>Delivery Only</h6>
                <Items :form="form" :references="references"/>
            </div>
        </div>
        <div class="tab-pane" id="PCO" role="tabpanel">
            <div class="card-body" style="min-height:500px">
                <h6>Pickup Only</h6>
                <Items :form="form" :references="references"/>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
import Items from './Items.vue'

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
</script>
