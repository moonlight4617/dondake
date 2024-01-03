<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { computed } from 'vue';
import { weatherList } from '../../enum'

const props = defineProps({
  sales_data: Array,
})


const totalValues = computed(() => {
  const aggregated = {};

  props.sales_data.forEach(data => {
    if (!aggregated[data.sale_date]) {
      aggregated[data.sale_date] = {
        sale_date: data.sale_date,
        temperature: 0,
        weather: 0,
        totalSales: 0,
        totalCosts: 0
      };
    }

    aggregated[data.sale_date].totalSales += parseInt(data.sales);
    aggregated[data.sale_date].totalCosts += parseInt(data.costs);
    aggregated[data.sale_date].temperature = parseInt(data.temperature);
    aggregated[data.sale_date].weather = parseInt(data.weather);
  });

  return Object.values(aggregated);
})

</script>


<template>
  <Head title="販売一覧" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">販売一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <section class="text-gray-600 body-font">
            <div class="container px-5 py-8 mx-auto">
              <FlashMessage />
              <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                  <Link as="button"
                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                    :href="route('sales.create')">
                  販売登録
                  </Link>
                </div>
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
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
