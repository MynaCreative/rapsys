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
                            <Link :href="route('transaction.invoices.create')" class="btn btn-primary btn-label waves-effect waves-light">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Create
                            </Link>
                        </b-button-group>
                    </div>
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <b-button-group>
                                <Reload :page="page"/>
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
                                <th>Code</th>
                                <th>Total Item</th>
                                <th>Grand Total</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Active</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">There are no item in this table</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
    { text: 'Transaction' },
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
