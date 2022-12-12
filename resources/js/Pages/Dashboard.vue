<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
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
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>
