<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="row">
            <!-- <div class="col-lg-12">You're logged in!</div> -->
            <p>
                {"err":true,"msg":" Data Not Found","data":[],"status_code":422}
            </p>

            <pre>
            {
                "RPX": {
                    "DATA": [
                    {
                        "TRACKING_ID": "TRACKING ID",
                        "TRACKING_DESC": "TRACKING DESCRIPTION",
                        "LOCATION": "LOCATION",
                        "TRACKING_DATE": "DATE",
                        "TRACKING_TIME": "TIME"
                    },
                    {
                        "TRACKING_ID": "POD",
                        "TRACKING_DESC": "Shipment received by Consignee",
                        "LOCATION": "NA",
                        "TRACKING_DATE": "Sep 17, 2022",
                        "TRACKING_TIME": "08:44 AM",
                        "TRACKING_COMMENT": "BACKDATE POD|1.0000 Kg"
                    },
                    {
                        "TRACKING_ID": "HOV",
                        "TRACKING_DESC": "Shipment on process of delivery",
                        "LOCATION": "RPX Cirebon",
                        "TRACKING_DATE": "Sep 16, 2022",
                        "TRACKING_TIME": "05:56 PM",
                        "TRACKING_COMMENT": "2516162200005982|1.0000 Kg"
                    },
                    {
                        "TRACKING_ID": "MDE",
                        "TRACKING_DESC": "Manifesting Package",
                        "LOCATION": "RPX Cikarang",
                        "TRACKING_DATE": "Sep 14, 2022",
                        "TRACKING_TIME": "11:20 PM",
                        "TRACKING_COMMENT": "BATCH 3\\/ Adi  Hidayat|1.0000 Kg"
                    },
                    {
                        "TRACKING_ID": "PUP",
                        "TRACKING_DESC": "Picked Up",
                        "LOCATION": "RPX Cikarang",
                        "TRACKING_DATE": "Sep 14, 2022",
                        "TRACKING_TIME": "04:00 PM",
                        "TRACKING_COMMENT": "dkjdkjdkjdkjdkjdkjdkjdkjdkjdkj|1.0000 Kg"
                    }
                    ],
                    "DELIVERY_TO": "",
                    "RECEIVED_BY": "RAHMAT",
                    "DELIVERY_LOC": "",
                    "DELIVERY_DATE": "Sep 17, 2022",
                    "DELIVERY_TIME": "08:44 AM",
                    "ETA": "",
                    "IMAGE_SIGNATURE": "",
                    "IMAGE_FOTO": "",
                    "LATITUDE": "",
                    "LONGITUDE": "",
                    "LOC_DESC": "Residential"
                }
            }
        </pre>

        <p>DELTA_REST_URL=https://api.rpx.co.id/api_beta</p>
            <p>DELTA_REST_USERNAME=demo</p>
            <p>DELTA_REST_PASSWORD="demo"</p>

            <p>DELTA_SOAP_URL=https://api.rpxholding.com/wsdl/rpxwsdl.php?wsdl</p>
            <p>DELTA_SOAP_USERNAME=rapsys</p>
            <p>DELTA_SOAP_PASSWORD="#rapsys2022#"</p>
            
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Main.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>
