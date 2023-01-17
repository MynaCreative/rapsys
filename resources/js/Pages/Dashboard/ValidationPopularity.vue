<template>
    <div class="card card-height-100">
        <div class="card-header border-0 pb-0">
            <h6 class="card-title mb-0">Invoice Validation Popularity</h6>
            <apexchart class="apex-charts" height="240" dir="ltr" :series="chartSeries" :options="chartOptions"></apexchart>
        </div>
        <div class="card-body">
            <div class="mt-3 pt-2">
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">
                        <p class="text-truncate text-muted fs-14 mb-0">
                            <i class="mdi mdi-circle align-middle text-primary me-2"></i>Valid
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="mb-0">24.58%</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate text-muted fs-14 mb-0">
                            <i class="mdi mdi-circle align-middle text-danger me-2"></i>Invalid
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="mb-0">17.58%</p>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center">
                <a href="javascript:void(0);" class="text-muted text-decoration-underline">Show All</a>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watchEffect  } from 'vue'

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
    chartSeries.value = [{
        name: 'Valid',
        data: [12.45, 16.2, 8.9, 11.42, 12.6, 18.1, 18.2, 14.16]
    }, {
        name: 'Invalid',
        data: [-11.45, -15.42, -7.9, -12.42, -12.6, -18.1, -18.2, -14.16]
    }]
})

const chartOptions = {
    chart: {
        type: 'bar',
        height: 260,
        stacked: true,
        toolbar: {
            show: false
        },
    },
    stroke: {
        colors: "#000"
    },
    plotOptions: {
        bar: {
            columnWidth: '20%',
            borderRadius: [4, 4]
        },
    },
    colors: getChartColorsArray('["--vz-success", "--vz-danger"]'),
    fill: {
        opacity: 1
    },
    dataLabels: {
        enabled: false,
        textAnchor: 'top',
    },
    yaxis: {
        labels: {
            show: false,
            formatter: function (y) {
                return y.toFixed(0) + "%";
            }
        }
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        labels: {
            rotate: -90
        }
    }
}
</script>
