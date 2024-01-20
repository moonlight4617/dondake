<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { BarChart } from 'vue-chart-3'
import { Chart, registerables } from "chart.js";
import { computed, onMounted, reactive, ref, watch } from 'vue';
import axios from 'axios';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { weatherList } from '../enum';
import SalesTable from '@/parts/SalesTable.vue';
import { aggregateSalesData } from '../aggregate';
import DisplayYearMonth from '@/Parts/DisplayYearMonth.vue';
import { getDataPerMonth, previousMonth, nextMonth } from '../fetchAndDisplayYearMonth';

const props = defineProps({
    sales_data: Array
})

const data = reactive({
    data: [],
});
const initialDisplay = () => {
    data.data = props.sales_data;
}

initialDisplay();
const now = new Date();
const yearRef = ref(now.getFullYear());
const monthRef = ref(now.getMonth() + 1);

const dataLabels = ref("sale")

const displayNextMonthFlag = ref(false)

const displayMonth = computed(() => {
    return `${yearRef.value}/${monthRef.value}`
})

const totalValues = computed(() => {
    const aggregatedData = aggregateSalesData(data.data)

    // const weather_list = []
    const temperatureList = []
    const salesList = []
    const profitList = []
    const dateList = []
    // const dateList = Object.keys(aggregated)
    aggregatedData.forEach((item) => {
        dateList.push(`${item.sale_date}/${weatherList[item.weather]}`)
        // weather_list.push(item.weather)
        temperatureList.push(item.temperature)
        salesList.push(item.totalSales)
        profitList.push(item.totalSales - item.totalCosts)
    })
    return { temperatureList, salesList, profitList, dateList };
})

Chart.register(...registerables);
const barData = reactive({
    labels: totalValues.value.dateList,
    datasets: [
        {
            type: 'bar',
            label: "売上",
            data: totalValues.value.salesList,
            backgroundColor: "rgb(75, 192, 192)",
            tension: 0.1,
            yAxisID: 'y-axis-sales',
        },
        // TODO: vue-chart-3では複数グラフ表示する際のy軸のオプションなどがサポートされてないっぽい対応後回し
        // {
        //     label: "気温",
        //     data: totalValues.value.temperatureList,
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
    barData.datasets[0].data = newVal === "sale" ? totalValues.value.salesList : totalValues.value.profitList;
});

watch(totalValues, (newTotalValues) => {
    barData.labels = newTotalValues.dateList;
    barData.datasets[0].data = dataLabels.value === "sale" ? newTotalValues.salesList : newTotalValues.profitList;
})

const previous = async () => {
    await changeYearMonth(previousMonth)
}

const next = async () => {
    await changeYearMonth(nextMonth)
}

const changeYearMonth = async (direction) => {
    const { displayFlag, year, month } = direction(yearRef.value, monthRef.value);
    displayNextMonthFlag.value = displayFlag
    yearRef.value = year
    monthRef.value = month
    data.data = await getDataPerMonth(yearRef.value, monthRef.value)
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-4 py-8">
                    <DisplayYearMonth :previousMonth="previous" :nextMonth="next" :displayMonth="displayMonth"
                        :displayNextMonthFlag="displayNextMonthFlag" />
                    <BarChart :chartData="barData" />
                    <fieldset class="mb-12">
                        <input type="radio" id="sale" name="sale" v-model="dataLabels" value="sale">
                        <label class="mr-4">売上</label>
                        <input type="radio" id="profit" name="profit" v-model="dataLabels" value="profit">
                        <label>粗利益</label>
                    </fieldset>
                    <SalesTable :sales_data=data.data />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
