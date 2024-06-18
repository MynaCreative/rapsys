<script setup>
import { onMounted, ref, toRaw } from 'vue';

import service from './service';

const title = {
    text: 'Top 10 Invoice by Vendor',
    align: 'center'
};

const stat = ref();

const updateChart = async () => {
    const chart = chartRef.value.chart;

    chart.showLoading('Loading ...');

    stat.value = await service.fetchData('chart', 'invoice-vendor');

    chart.update({
        series: [
            {
                data: toRaw(stat.value)
            }
        ]
    });

    chart.hideLoading();
};

onMounted(() => {
    updateChart();
});

const colors = ['#3577f1'];

const chartRef = ref(null);
const chartOptions = ref({
    title,
    colors,
    chart: {
        type: 'bar',
    },
    series: [
        {
            name: 'User',
            dataLabels: {
                inside: true,
                enabled: true,
                format: '{point.y:.0f}'
            },
            tooltip: {
                pointFormat: 'Documents: <b>{point.y}</b>'
            },
            borderRadius: 5,
            colorByPoint: true,
            data: null
        }
    ],
    xAxis: {
        type: 'category',
        labels: {
            formatter: function () {
                return truncateString(this.value);
            }
        }
    },
    yAxis: {
        title: false,
        labels: {
            enabled: false
        }
    },
    exporting: {
        buttons: {
            refreshButton: {
                symbol: 'url(https://api.iconify.design/ic/baseline-refresh.svg?color=%23666)',
                symbolSize: 24,
                symbolX: 27,
                symbolY: 27,
                x: 0,
                align: 'right',
                theme: {
                    fill: 'transparent'
                },
                onclick: function (event) {
                    event.preventDefault();
                    updateChart();
                }
            },
            contextButton: {
                symbol: 'menu',
                align: 'left',
                menuItems: [
                    'viewFullscreen',
                    'printChart',
                    'separator',
                    'downloadPNG',
                    'downloadJPEG',
                    'downloadPDF',
                    'downloadSVG',
                    'separator',
                    'downloadCSV',
                    'downloadXLS',
                    'viewData'
                ]
            }
        }
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    }
});

const truncateString = (inputString, maxWords = 3) => {
    // Split the input string into an array of words
    const words = inputString.split(/\s+/);

    // If the number of words is less than or equal to the maxWords, return the original string
    if (words.length <= maxWords) {
        return inputString;
    }

    // Otherwise, truncate the array to maxWords and join the words back into a string
    const truncatedString = words.slice(0, maxWords).join(' ');

    // Append '...' to the truncated string
    return truncatedString + '...';
};
</script>
<template>
    <div class="w-full">
        <highcharts ref="chartRef" :options="chartOptions"></highcharts>
    </div>
</template>
