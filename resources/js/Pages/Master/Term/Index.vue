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
                            <b-button variant="success" class="btn-label waves-effect waves-light right" @click="modalImportVisible = true">
                                <i class="bx bx-import label-icon align-middle fs-16"></i>
                                Import
                            </b-button>
                            <b-button variant="warning" class="btn-label waves-effect waves-light right" @click="modalExportVisible = true">
                                <i class="bx bx-export label-icon align-middle fs-16"></i>
                                Export
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
                                <th width="60">#</th>
                                <Sort label="Code" attribute='code'/>
                                <Sort label="Name" attribute='name'/>
                                <Sort label="Day" attribute='day'/>
                                <Sort width="140" label="Created At" attribute='created_at'/>
                                <th width="140">Created By</th>
                                <th width="70">Active</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>{{ item.code }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.day }}</td>
                                <td class="date"><DataTimestamp :data="item.created_at"/></td>
                                <td><DataUserName :data="item.created_user?.name"/></td>
                                <td><DataActive :data="item.deleted_at"/></td>
                                <td>
                                    <ul class="list-inline gap-2 mb-0 text-center">
                                        <template v-if="!item.deleted_at">
                                            <li class="list-inline-item" title="View" @click="() => {
                                                currentId = item.id
                                                modalDetailVisible = true
                                            }">
                                                <a href="javascript:void(0);" class="text-warning d-inline-block" >
                                                    <i class="ri-eye-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" title="Edit" @click="() => {
                                                currentId = item.id
                                                modalFormVisible = true
                                            }">
                                                <a href="javascript:void(0);" class="text-primary d-inline-block">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" title="Remove">
                                                <a href="javascript:void(0);" class="text-danger d-inline-block" @click="service.deleteData(item.id)">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </template>
                                        <template v-else>
                                            <li class="list-inline-item" title="Restore">
                                                <a href="javascript:void(0);" class="text-info d-inline-block" @click="service.deleteData(item.id, true)">
                                                    <i class="ri-refresh-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </template>
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
        <ModalImport
            :show="modalImportVisible"
            @update:show="modalImportVisible = $event"
        />
        <ModalExport
            :show="modalExportVisible"
            @update:show="modalExportVisible = $event"
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
import { Head, Link, useForm, usePage  } from '@inertiajs/vue3'

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
import ModalImport from './Modals/Import.vue'
import ModalExport from './Modals/Export.vue'
import ModalDetail from './Modals/Detail.vue'

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Master' },
    { text: page.title, active: true },
]

const props = defineProps(['collection','filters'])

const form = useForm({
    keyword: usePage().props.ziggy.query.keyword ?? null,
})
const currentId = ref(null)
const modalFormVisible = ref(false)
const modalImportVisible = ref(false)
const modalExportVisible = ref(false)
const modalDetailVisible = ref(false)
</script>
