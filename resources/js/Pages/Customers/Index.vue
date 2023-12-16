<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  customers: Object
})

const searchWord = ref('')

const searchCustomer = () => {
  Inertia.get(route('customers.index'), { search: searchWord.value })
}
</script>

<template>
  <Head title="顧客一覧" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <section class="text-gray-600 body-font">
            <div class="container px-5 py-8 mx-auto">
              <FlashMessage />
              <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                  <input v-model="searchWord"
                    class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  <button @click="searchCustomer"
                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                    検索
                  </button>
                  <Link as="button"
                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                    :href="route('customers.create')">
                  新規登録
                  </Link>
                </div>
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th
                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                        No.</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名
                      </th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                        カナ</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="customer in customers.data" :key="customer.id">
                      <td class="px-4 py-3">{{ customer.id }}</td>
                      <td class="px-4 py-3">{{ customer.name }}</td>
                      <td class="px-4 py-3">{{ customer.kana }}</td>
                      <td class="px-4 py-3">{{ customer.tel }}</td>
                    </tr>
                  </tbody>
                  <!-- <div class="my-4" v-for="customer in customers.data">
                    {{ customer.id }}
                  </div> -->
                </table>
              </div>
            </div>
            <Pagination class="mt-6" :links="customers.links" />
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
