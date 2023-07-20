<template>
    <div class="card">
        <div class="card-body p-0">
            <div class="row g-0">
                <div class="col-xxl-8">
                    <div class="">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Invoice Line Item Validation Distribution</h4>
                            <!-- <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6M
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1Y
                                </button>
                            </div> -->
                        </div>
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1">
                                        <count-to :startVal='0' :endVal='0' :duration='5000'></count-to></h5>
                                    <p class="text-muted mb-0">Total</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><count-to :startVal='0' :endVal='0' :duration='5000'></count-to></h5>
                                    <p class="text-muted mb-0">Valid</p>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4">
                                <div class="p-3 border border-dashed border-end-0">
                                    <h5 class="mb-1"><count-to :startVal='0' :endVal='0' :duration='5000'></count-to></h5>
                                    <p class="text-muted mb-0">Invalid</p>
                                </div>
                            </div>
                        </div>
                        <apexchart class="apex-charts" height="350" dir="ltr" :series="chartSeries" :options="chartOptions"></apexchart>
                    </div>
                </div>
                <div class="col-xxl-4">
                    <div class="border-start p-4 h-100 d-flex flex-column">
                        <div class="w-100">
                            <div class="d-flex align-items-center">
                                <img src="@/Assets/images/gif/img-5.gif" class="img-fluid avatar-xs rounded-circle object-cover" alt="">
                                <div class="ms-3 flex-grow-1">
                                    <h5 class="fs-16 mb-1 fw-bold">Invoice Receipt</h5>
                                    <p class="text-muted mb-0">Total Amount</p>
                                </div>
                                <!-- <div class="dropdown">
                                    <a href="javascript:void(0);" class="align-middle text-muted" role="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-share-line fs-18"></i>
                                    </a>
                                </div> -->
                            </div>
                            <h3 class="ff-secondary fw-bold mt-4">
                                <i class="mdi mdi-ethereum text-primary"></i> Rp. 0
                            </h3>
                            <p class="text-success mb-3">+0 (0.00%)</p>
                            <p class="text-muted">All this chart is using dummy data, will available when application release or running 1+ month</p>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <p class="fs-14 text-muted mb-1">Valid</p>
                                    <h4 class="fs-20 ff-secondary fw-semibold mb-0">Rp. 0</h4>
                                </div>

                                <div>
                                    <p class="fs-14 text-muted mb-1">Invalid</p>
                                    <h4 class="fs-20 ff-secondary fw-semibold mb-0">Rp. 0</h4>
                                </div>
                            </div>
                            <div class="dash-countdown mt-4 pt-1">
                                <div id="countdown" class="countdownlist"></div>
                            </div>
                            <div class="row mt-4 pt-2">
                                <div class="col">
                                    <Link :href="route('transaction.invoices.index')" class="btn btn-info btn-label waves-effect waves-light w-100 mb-2">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="ri-newspaper-line label-icon align-middle fs-16 me-2"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Invoice
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                                <div class="col">
                                    <Link :href="route('transaction.report.invoice-header')" class="btn btn-secondary btn-label waves-effect waves-light w-100 mb-2">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="ri-newspaper-line label-icon align-middle fs-16 me-2"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                Report
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { CountTo } from 'vue3-count-to'
import { ref, watchEffect  } from 'vue'
import { Link  } from '@inertiajs/vue3'

const getChartColorsArray = (colors) => {
    colors = JSON.parse(colors)
    return colors.map(function (value) {
        var newValue = value.replace(" ", "")
        if (newValue.indexOf(",") === -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue)
            if (color) {
                color = color.replace(" ", "")
                return color
            } else return newValue
        } else {
            var val = value.split(',')
            if (val.length == 2) {
                var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0])
                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")"
                return rgbaColor
            } else {
                return newValue
            }
        }
    })
}

const chartSeries = ref([])
watchEffect(() => {
    chartSeries.value = [
        {
            name: "Total",
            data: [0],
        },
        {
            name: "Valid",
            data: [0],
        },
        {
            name: "Invalid",
            data: [0],
        },
    ]
})

const chartOptions = {
    chart: {
        height: 100,
        type: "area",
        toolbar: "false",
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
        width: 3,
    },
    xaxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
        ],
    },
    yaxis: {
        labels: {
            formatter: function (value) {
                return value;
            },
        },
        tickAmount: 5,
        min: 0,
        max: 150,
    },
    colors: getChartColorsArray('["--vz-gray-400", "--vz-success","--vz-danger"]'),
    fill: {
        opacity: 0,
        colors: ["#0AB39C", "#F06548"],
        type: "solid",
    },
}
</script>
