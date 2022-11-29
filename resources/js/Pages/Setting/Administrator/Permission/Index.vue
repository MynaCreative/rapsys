<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <b-button-group>
                            <b-button variant="primary" class="btn-label waves-effect waves-light" @click="modalFormVisible = true, currentId = null">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Create
                            </b-button>
                        </b-button-group>
                    </div>
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <b-button-group>
                                <Reload :page="page"/>
                                <PerPage v-if="collection.links.length > 3"/>
                            </b-button-group>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 border-2 border-top border-bottom">
                <form @submit.prevent="form.get(route(`${page.module}.${page.name}.index`))" class="search-box">
                    <input type="search" class="form-control search border-0 py-3" :placeholder="`Search for ${page.title} ...`" v-model="form.keyword">
                    <i class="ri-search-line search-icon"></i>
                </form>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive table-card mb-0">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <Sort label="Name" attribute='name'/>
                                <Sort label="Label" attribute='label'/>
                                <Sort label="Guard" attribute='guard_name'/>
                                <Sort label="Created At" attribute='created_at'/>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.label }}</td>
                                <td>{{ item.guard_name }}</td>
                                <td class="date"><DataTimestamp :data="item.created_at"/></td>
                                <td>
                                    <ul class="list-inline gap-2 mb-0 text-center">
                                        <li class="list-inline-item" title="View" @click="() => {
                                            currentId = item.id
                                            modalDetailVisible = true
                                        }">
                                            <a href="#" class="text-warning d-inline-block" >
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item edit" title="Edit" @click="() => {
                                            currentId = item.id
                                            modalFormVisible = true
                                        }">
                                            <a href="#" class="text-primary d-inline-block">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" title="Remove">
                                            <a href="#" class="text-danger d-inline-block" @click="service.deleteData(item.id)">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer p-0">
                <Pagination :data="collection"/>
            </div>
        </div>
        <ModalForm
            :show="modalFormVisible"
            @update:show="modalFormVisible = $event"
            :id="currentId"
            @update:id="currentId = $event"
        />
        <ModalDetail
            :show="modalDetailVisible"
            @update:show="modalDetailVisible = $event"
            :id="currentId"
            @update:id="currentId = $event"
        />
    </Layout>
</template>
<script setup>
import { ref } from 'vue'
import { Head, Link, useForm, usePage  } from '@inertiajs/inertia-vue3'

import Layout from '@/Layouts/Main.vue'
import PageHeader from '@/Components/PageHeader.vue'
import Pagination from '@/Components/Pagination.vue'
import DataUserName from '@/Components/Data/UserName.vue'
import DataTimestamp from '@/Components/Data/Timestamp.vue'
import DataActive from '@/Components/Data/Active.vue'
import PerPage from '@/Components/PerPage.vue'
import Reload from '@/Components/Reload.vue'
import Sort from '@/Components/Sort.vue'

import entityData from './entity'
import service from './service'

import ModalForm from './Modals/Form.vue'
import ModalDetail from './Modals/Detail.vue'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Setting' },
    { text: 'Administrator' },
    { text: page.title, active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.value.ziggy.query.keyword ?? null,
})
const currentId = ref(null)
const modalFormVisible = ref(false)
const modalDetailVisible = ref(false)
</script>
