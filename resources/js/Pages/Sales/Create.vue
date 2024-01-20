<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { getToday } from '@/common';
import { Inertia } from '@inertiajs/inertia';
import { computed, onMounted, reactive, ref } from 'vue';
import { weatherList } from '../../enum'

const props = defineProps({
  errors: Object,
  items: Array,
})

const form = reactive({
  date: null,
  temperature: 20,
  weather: 1,
  items: []
})

const itemList = ref([]);

const totalValues = computed(() => {
  let totalPrice = 0
  let totalCost = 0
  let totalProfit = 0
  itemList.value.forEach(item => {
    totalPrice += item.price * item.quantity
    totalCost += item.cost * item.quantity
    totalProfit += (item.price - item.cost) * item.quantity
  })
  return { totalPrice, totalCost, totalProfit }
})

const storeSales = () => {
  itemList.value.forEach(item => {
    if (item.quantity > 0)
      form.items.push({ id: item.id, price: item.price, cost: item.cost, quantity: item.quantity })
  });
  Inertia.post(route('sales.store'), form);
}

onMounted(() => {
  form.date = getToday();
  props.items.forEach((item) => {
    itemList.value.push({
      id: item.id, name: item.name, price: item.price, cost: item.cost, quantity: 0
    })
  })
})
</script>

<template>
  <Head title="商品購入" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">販売登録</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="storeSales">
                <div class="container px-5 py-24 mx-auto">
                  <div class="md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                        <input type="date" id="date" name="date" v-model="form.date"
                          class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mr-8">
                        <div v-if="props.errors.date">{{ props.errors.date }}</div>
                        <label for="weather" class="leading-7 text-sm text-gray-600">天気</label>
                        <select name="weather" id="weather" v-model="form.weather"
                          class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mr-8">
                          <option v-for=" [id, weather]  in  Object.entries(weatherList) " :key="id" :value="id">
                            {{ weather }}
                          </option>
                        </select>
                        <div v-if="props.errors.weather">{{ props.errors.weather }}</div>
                        <label for="temperature" class="leading-7 text-sm text-gray-600">気温</label>
                        <input type="number" id="temperature" name="temperature" v-model="form.temperature"
                          class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out w-20">
                        <div v-if="props.errors.temperature">{{ props.errors.temperature }}</div>℃
                      </div>
                      <div class="p-2 pt-8 w-full">
                        <label class="leading-7 text-sm text-gray-600">商品・サービス</label>
                        <div v-if="props.errors.items">{{ props.errors.items }}</div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                No.</th>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                商品名
                              </th>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                販売価格
                              </th>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                仕入価格
                              </th>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                数量
                              </th>
                              <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                粗利
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="item  in  itemList" :key="item.id">
                              <td class="px-4 py-3">{{ item.id }}</td>
                              <td class="px-4 py-3">{{ item.name }}</td>
                              <td class="px-4 py-3">
                                <input type="number" min="0" id="price" name="price" v-model="item.price"
                                  class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 transition-colors duration-200 ease-in-out w-28">
                              </td>
                              <td class="px-4 py-3">
                                <input type="number" min="0" id="cost" name="cost" v-model="item.cost"
                                  class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 transition-colors duration-200 ease-in-out w-28">
                              </td>
                              <td>
                                <input type="number" min="0" id="quantity" name="quantity" v-model="item.quantity"
                                  class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 transition-colors duration-200 ease-in-out w-20">
                              </td>
                              <td class="px-4 py-3">{{ ((item.price - item.cost) * item.quantity).toLocaleString() }}</td>
                            </tr>
                            <tr class="border-t-2">
                              <td class="pt-4"></td>
                              <td class="pt-4">計</td>
                              <td class="pt-4">{{ totalValues.totalPrice.toLocaleString() }}</td>
                              <td class="pt-4">{{ totalValues.totalCost.toLocaleString() }}</td>
                              <td class="pt-4"></td>
                              <td class="pt-4">{{ totalValues.totalProfit.toLocaleString() }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="p-2 w-full">
                        <button
                          class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
