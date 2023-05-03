<template>
    <div class="row g-2">
        <div class="col-lg-12">
            <label for="department" class="form-label">Department</label>
            <Multiselect id="department" v-model="form.department_id" :class="{'is-invalid' : form.errors.department_id }" :searchable="true"
                aria-describedby="input-department-feedback" :options="references.departments" placeholder="Select data"></Multiselect>
            <b-form-invalid-feedback id="input-department-feedback" v-html="form.errors.department"/>
        </div>
        <div class="col-lg-6">
            <label for="code" class="form-label">Code</label>
            <b-form-input id="code" v-model="form.code" :class="{'is-invalid' : form.errors.code }"
                aria-describedby="input-code-feedback"/>
            <b-form-invalid-feedback id="input-code-feedback" v-html="form.errors.code"/>
        </div>
        <div class="col-lg-6">
            <label for="name" class="form-label">Name</label>
            <b-form-input id="name" v-model="form.name" :class="{'is-invalid' : form.errors.name }"
                aria-describedby="input-name-feedback" autofocus/>
            <b-form-invalid-feedback id="input-name-feedback" v-html="form.errors.name"/>
        </div>
        <div class="col-lg-12">
            <table class="table table-sm table-bordered table-hover table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th class="align-middle text-center" rowspan="2">
                            <a href="#"><i class="ri-add-fill align-bottom cursor-pointer" title="Add" @click="add()"></i></a>
                        </th>
                        <th class="align-middle text-center" width="50" rowspan="2">Step</th>
                        <th class="align-middle text-center" rowspan="2">User</th>
                        <th class="align-middle text-center" colspan="2">Range</th>
                        <th class="align-middle text-center" rowspan="2">Description</th>
                    </tr>
                    <tr>
                        <th class="text-center" width="120">From</th>
                        <th class="text-center" width="120">To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item, index in form.items" :key="index">
                        <td class="text-center align-middle">
                            <i class="ri-close-line text-danger cursor-pointer" title="Remove" @click="remove(index)"></i>
                        </td>
                        <td class="text-center">
                            <input type="number" v-model.number="item.sequence" class="form-control text-end">
                        </td>
                        <td>
                            <select class="form-select" v-model="item.user_id">
                                <option value="">Select user</option>
                                <option v-for="user, value in references.users" :value="value">{{ user }}</option>
                            </select>
                        </td>
                        <td class="text-end">
                            <money3-component v-model.number="item.range_from" v-bind="moneyConfig" class="form-control text-end"></money3-component>
                        </td>
                        <td class="text-end">
                            <money3-component v-model.number="item.range_to" v-bind="moneyConfig" class="form-control text-end"></money3-component>
                        </td>
                        <td class="text-center">
                            <input type="text" v-model="item.description" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description" rows="4"></textarea>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue'
import { Money3Component } from 'v-money3'
import Multiselect from '@vueform/multiselect'

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

const add = () => {
    let item = {
        user_id : null,
        sequence : null,
        range_from : 0,
        range_to : 0,
    }
    form.value.items.push({ ...item})
}

const remove = (index) => {
    form.value.items.splice(index, 1)
}

const moneyConfig =  {
    precision: 0,
    masked: false
}
</script>
