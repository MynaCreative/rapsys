<template>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead class="table-light text-muted">
                <tr>
                    <th class="text-center cursor-pointer" width=40px>
                        <i class="ri-add-line text-primary"></i>
                    </th>
                    <th class="text-center" width=40px>#</th>
                    <th class="text-center">AWB</th>
                    <th class="text-center">SMU</th>
                    <th>Description</th>
                    <th>Cost Center</th>
                    <th>Route</th>
                    <th class="text-end">Weight</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Quantity</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="index in 15" :key="index">
                    <td class="text-center cursor-pointer">
                        <i class="ri-close-line text-danger"></i>
                    </td>
                    <td class="text-center">{{ index }}</td>
                    <td class="text-center">
                        <a href="#" class="text-decoration-none">AWB-00001</a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="text-decoration-none">SMU-00001</a>
                    </td>
                    <td>
                        <a href="#" class="text-decoration-none">Description</a>
                    </td>
                    <td>
                        <a href="#" class="text-decoration-none">Cost Center</a>
                    </td>
                    <td>
                        <a href="#" class="text-decoration-none">Route</a>
                    </td>
                    <td class="text-end">
                        <a href="#" class="text-decoration-none">2.00</a>
                    </td>
                    <td class="text-end">
                        <a href="#" class="text-decoration-none">2.000.00</a>
                    </td>
                    <td class="text-end">
                        <a href="#" class="text-decoration-none">2.00</a>
                    </td>
                    <td class="text-end">12.000.0000</td>
                </tr>
            </tbody>
            <tfoot class="bg-soft-light text-muted">
                <tr>
                    <td class="fw-medium text-end" colspan="9">Total</td>
                    <td class="fw-medium text-end">2.00</td>
                    <td class="fw-medium text-end">12.000.0000</td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>
<script setup>

</script>
