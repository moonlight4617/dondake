<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { BarChart } from 'vue-chart-3'
import { Chart, registerables } from "chart.js";
import { computed, reactive, ref, watch } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { weatherList } from '../enum'


const props = defineProps({
    sales_data: Array
})

const dataLabels = ref("sale")

const totalValues = computed(() => {
    const aggregated = {};

    props.sales_data.forEach(data => {
        if (!aggregated[data.sale_date]) {
            aggregated[data.sale_date] = {
                sale_date: null,
                temperature: 0,
                weather: 0,
                totalSales: 0,
                totalCosts: 0
            };
        }

        aggregated[data.sale_date].sale_date = data.sale_date;
        aggregated[data.sale_date].totalSales += parseInt(data.sales);
        aggregated[data.sale_date].totalCosts += parseInt(data.costs);
        aggregated[data.sale_date].temperature = parseInt(data.temperature);
        aggregated[data.sale_date].weather = parseInt(data.weather);
    });

    // const weather_list = []
    const temperature_list = []
    const sales_list = []
    const profit_list = []
    const date_list = []
    // const date_list = Object.keys(aggregated)
    Object.values(aggregated).forEach((item) => {
        date_list.push(`${item.sale_date}/${weatherList[item.weather]}`)
        // weather_list.push(item.weather)
        temperature_list.push(item.temperature)
        sales_list.push(item.totalSales)
        profit_list.push(item.totalSales - item.totalCosts)
    })
    return { temperature_list, sales_list, profit_list, date_list };
})

Chart.register(...registerables);
const barData = reactive({
    labels: totalValues.value.date_list,
    datasets: [
        {
            type: 'bar',
            label: "売上",
            data: totalValues.value.sales_list,
            backgroundColor: "rgb(75, 192, 192)",
            tension: 0.1,
            yAxisID: 'y-axis-sales',
        },
        // TODO: vue-chart-3では複数グラフ表示する際のy軸のオプションなどがサポートされてないっぽい対応後回し
        // {
        //     label: "気温",
        //     data: totalValues.value.temperature_list,
        //     type: "line",
        //     borderColor: 'rgb(255, 99, 132)',
        //     borderWidth: 2,
        //     fill: false,
        //     yAxisID: 'y-axis-temperature',
        // }
    ]
})

// TODO: vue-chart-3では複数グラフ表示する際のy軸のオプションなどがサポートされてないっぽいので対応後回し
// const options = reactive({
//     scales: {
//         yAxes: [
//             {
//                 id: 'y-axis-sales',
//                 type: 'linear',
//                 position: 'left',
//                 ticks: {
//                     beginAtZero: true,
//                 },
//             },
//             {
//                 id: 'y-axis-temperature',
//                 type: 'linear',
//                 position: 'right',
//                 ticks: {
//                     beginAtZero: true,
//                 },
//             },
//         ],
//     },
// });

watch(dataLabels, (newVal) => {
    barData.datasets[0].label = newVal === "sale" ? "売上" : "粗利益";
    barData.datasets[0].data = newVal === "sale" ? totalValues.value.sales_list : totalValues.value.profit_list;
});


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <BarChart :chartData="barData" />
                        <fieldset>
                            <legend>表示</legend>
                            <input type="radio" id="sale" name="sale" v-model="dataLabels" value="sale">
                            <label class="mr-4">売上</label>
                            <input type="radio" id="profit" name="profit" v-model="dataLabels" value="profit">
                            <label>粗利益</label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
