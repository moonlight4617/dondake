<script setup>
import { computed } from 'vue';
import { weatherList } from '../enum'
import { aggregateSalesData } from '../aggregate'

const props = defineProps({
  sales_data: Array,
})


const totalValues = computed(() => {
  return aggregateSalesData(props.sales_data)
})

</script>


<template>
  <table class="table-auto w-full text-left whitespace-no-wrap">
    <thead>
      <tr>
        <th
          class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
          日付</th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">天気
        </th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">気温
        </th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">売上
        </th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">仕入
        </th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
          粗利益</th>
        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="data in totalValues" :key="data.sale_date">
        <!-- <Link :href="route('items.edit', { item: item.id })" class="text-indigo-800"> -->
        <td class="px-4 py-3">{{ data.sale_date }}</td>
        <!-- </Link> -->
        <td class="px-4 py-3">{{ weatherList[data.weather] }}</td>
        <td class="px-4 py-3">{{ data.temperature }}</td>
        <td class="px-4 py-3">{{ data.totalSales.toLocaleString() }}</td>
        <td class="px-4 py-3">{{ data.totalCosts.toLocaleString() }}</td>
        <td class="px-4 py-3">{{ (data.totalSales - data.totalCosts).toLocaleString() }}</td>
      </tr>
    </tbody>
  </table>
</template>
