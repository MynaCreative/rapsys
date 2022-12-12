<template>
    <Layout>
        <Head :title="page.title" />
        <template #header>
            <PageHeader :title="page.title" :breadcrumbs="breadcrumbs" />
        </template>
        <b-alert  show variant="danger" class="alert-additional fade show" role="alert">
            <div class="alert-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-error-warning-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Something was wrong!</h5>
                        <p class="mb-0">
                            <strong>Connection Failed</strong>
                            : Some feature need this connection to be working
                        </p>
<pre>
{
    "connection_checking": {
        "REST": {
            "status": "failed",
            "url": "https://api.rpx.co.id/api_beta",
            "message": "cURL error 28: Connection timed out after 10001 milliseconds",
        },
        "SOAP": {
            "status": "failed",
            "url": "https://api.rpxholding.com/wsdl/rpxwsdl.php?wsdl",
            "message": "cURL error 28: Connection timed out after 10001 milliseconds",
        },
    }
}
</pre>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Please contact your administrator / IT department for this issue. Change a few things up and try again.</p>
            </div>
        </b-alert>
        <div class="card">
            <div class="card-header border-0">
                <div class="row g-4">
                    <div class="col-sm-auto">
                        <b-button-group>
                            <Link :href="route(`${page.module}.${page.name}.create`)" class="btn btn-primary btn-label waves-effect waves-light disabled">
                                <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                Create
                            </Link>
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
                    <table class="table table-hover table-nowrap table-sm align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <Sort label="Code" attribute='code'/>
                                <Sort label="Invoice Number" attribute='invoice_number'/>
                                <Sort label="Vendor" attribute='vendor_id'/>
                                <Sort label="Invoice Amount" attribute='amount' class="text-center"/>
                                <Sort label="Invoice Date" attribute='invoice_date'/>
                                <Sort label="Invoice Receipt Date" attribute='invoice_receipt_date'/>
                                <Sort label="Created At" attribute='created_at'/>
                                <th class="text-center">Document Status</th>
                                <th>Created By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item, index in collection.data" :key="item.id">
                                <td>{{ (collection.current_page - 1) * collection.per_page + index + 1 }}</td>
                                <td>{{ item.code }}</td>
                                <td>{{ item.invoice_number }}</td>
                                <td>{{ item.vendor?.code }} - {{ item.vendor?.name }}</td>
                                <td class="text-center">9.500.000,00</td>
                                <td>{{ $dayjs(item.invoice_date).format('DD MMM, YYYY') }}</td>
                                <td>{{ $dayjs(item.invoice_receipt_date).format('DD MMM, YYYY') }}</td>
                                <td class="date"><DataTimestamp :data="item.created_at"/></td>
                                <td class="text-center"><b-badge variant="light" class="text-capitalize">{{ item.document_status }}</b-badge></td>
                                <td><DataUserName :data="item.created_user?.name"/></td>
                                <td>
                                    <ul class="list-inline gap-2 mb-0 text-center">
                                            <li class="list-inline-item edit" title="Edit" @click="() => {
                                                currentId = item.id
                                                modalFormVisible = true
                                            }">
                                                <Link :href="route(`${page.module}.${page.name}.edit`, item.id)" class="text-primary d-inline-block" title="Edit">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </Link>
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

const page = entityData().page

const breadcrumbs = [
    { text: 'Dashboard', to: route('dashboard') },
    { text: 'Master' },
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
