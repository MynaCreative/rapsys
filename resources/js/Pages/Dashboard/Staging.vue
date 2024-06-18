<script setup>
import { onMounted, ref, toRaw } from 'vue';

import service from './service';

const title = {
    text: 'Invoice Staging current month',
    align: 'center'
};

const stat = ref();

const updateChart = async () => {
    const chart = chartRef.value.chart;

    chart.showLoading('Loading ...');

    stat.value = await service.fetchData('chart', 'invoice-staging');

    chart.update({
        series: toRaw(stat.value.series),
        pane: toRaw(stat.value.pane),
    });

    chart.hideLoading();
};

onMounted(() => {
    updateChart();
});

const chartRef = ref(null);
const chartOptions = ref({
    chart: {
        type: 'solidgauge',
    },

    title: {
        text: 'Invoice Staging (Oracle)',
    },

    tooltip: {
        borderWidth: 0,
        backgroundColor: 'none',
        shadow: false,
        style: {
            fontSize: '16px'
        },
        valueSuffix: '%',
        pointFormat: '{series.name}<br>' +
            '<span style="font-size: 2em; color: {point.color}; ' +
            'font-weight: bold">{point.y}</span>',
        positioner: function (labelWidth) {
            return {
                x: (this.chart.chartWidth - labelWidth) / 2,
                y: (this.chart.plotHeight / 2) + 15
            };
        }
    },

    yAxis: {
        min: 0,
        max: 100,
        lineWidth: 0,
        tickPositions: []
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                enabled: false
            },
            linecap: 'round',
            stickyTracking: false,
            rounded: true
        }
    },

    pane: {
        startAngle: 0,
        endAngle: 360,
        background: [{
            outerRadius: '112%',
            innerRadius: '88%',
            // backgroundColor: trackColors[0],
            borderWidth: 0
        }, { 
            outerRadius: '87%',
            innerRadius: '63%',
            // backgroundColor: trackColors[1],
            borderWidth: 0
        }, { 
            outerRadius: '62%',
            innerRadius: '38%',
            // backgroundColor: trackColors[2],
            borderWidth: 0
        }]
    },

    series: [],
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
