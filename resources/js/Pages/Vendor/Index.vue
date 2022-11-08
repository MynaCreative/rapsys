<template>
    <Head title="Item Expenses" />
    <AuthenticatedLayout>
        <div class="row">
        <div class="col-lg-12">
            <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div>
                    <h5 class="card-title mb-0">{{ name }} List</h5>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div>
                    <button class="btn btn-soft-danger me-1">
                        <i class="ri-delete-bin-2-line"></i>
                    </button>
                    <button type="button" class="btn btn-success add-btn me-1" data-bs-toggle="modal" id="create-btn"
                        data-bs-target="#showModal">
                        <i class="ri-add-line align-bottom me-1"></i> Add {{ name }}
                    </button>
                    <button type="button" class="btn btn-info">
                        <i class="ri-refresh-line align-bottom me-1"></i>
                        Synchronize
                    </button>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body border-bottom-dashed border-bottom">
                <form></form>
            </div>
            <div class="card-body">
                <div>
                <div class="table-responsive table-card mb-1">
                    <table class="table align-middle" id="customerTable">
                    <thead class="table-light text-muted">
                        <tr>
                        <th scope="col" style="width: 50px">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll" value="option" />
                            </div>
                        </th>
                        <th class="sort">#</th>
                        <th class="sort">Name</th>
                        <th class="sort">Description</th>
                        <th class="sort">Created At</th>
                        <th class="sort">Status</th>
                        <th class="sort">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list form-check-all">
                        <tr v-for="index in 10" :key="index">
                        <th scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1" />
                            </div>
                        </th>
                        <td>{{ index }}</td>
                        <td>{{ name }} {{ index }}</td>
                        <td>Description</td>
                        <td>2022-11-04 14:00</td>
                        <td><span class="badge text-uppercase badge-soft-success">Active</span></td>
                        <td>
                            <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top" title="Edit">
                                <a href="#editmodal" data-bs-toggle="modal"
                                class="text-primary d-inline-block edit-item-btn">
                                <i class="ri-pencil-fill fs-16"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top" title="Remove">
                                <a class="text-danger d-inline-block remove-item-btn">
                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                </a>
                            </li>
                            </ul>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#" >
                            Previous
                        </a>
                        <a class="page-item pagination-next" href="#">
                            Next
                        </a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!--end col-->
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/inertia-vue3'

let name = 'Vendor'
</script>