<script setup>
import { onMounted, ref, toRaw } from 'vue';
import { router } from '@inertiajs/vue3';

import service from './service';

const title = {
    text: 'Invoice Approval',
    align: 'center'
};

const stat = ref();

const updateChart = async () => {
    const chart = chartRef.value.chart;

    chart.showLoading('Loading ...');

    stat.value = await service.fetchData('chart', 'invoice-approval');

    chart.update({
        series: [
            {
                data: toRaw(stat.value)
            }
        ],
        plotOptions: {
            pie: {
                colors: getColorsForStat(colors, toRaw(stat.value))
            }
        }
    });

    chart.hideLoading();
};

onMounted(() => {
    updateChart();
});

// slate-200, orange-400, green-500, red-500, sky-100
const colors = [
    {
        name: 'none',
        color: '#e2e8f0'
    },
    {
        name: 'pending',
        color: '#fb923c'
    },
    {
        name: 'approved',
        color: '#22c55e'
    },
    {
        name: 'revision',
        color: '#0ea5e9'
    },
    {
        name: 'rejected',
        color: '#ef4444'
    }
];

const getColorsForStat = (colors, stat) => {
    return stat
        .map((item) => {
            const colorObject = colors.find((color) => color.name === item.name);
            return colorObject ? colorObject.color : null;
        })
        .filter((color) => color !== null);
};

const chartRef = ref(null);
const chartOptions = ref({
    title,
    chart: {
        type: 'pie',
        events: {
            // load() {}
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <small>({point.y})</small>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 5,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.1f} %<br><small>({point.y})</small>',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            },
            point: {
                events: {
                    click: function () {
                        router.get(
                            route(`ppcr.proposals.index`, {
                                filter: {
                                    approval_status: [this.name]
                                }
                            })
                        );
                    }
                }
            }
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
    series: [
        {
            name: 'percentage',
            data: null
        }
    ],
    credits: {
        enabled: false
    }
});
</script>
<template>
    <div class="w-full">
        <highcharts ref="chartRef" :options="chartOptions"></highcharts>
    </div>
</template>
