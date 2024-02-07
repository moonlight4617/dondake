<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
  categories: Array
})
</script>

<template>
  <Head title="カテゴリー一覧" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリー一覧</h2>
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
                    :href="route('categories.create')">
                  新規登録
                  </Link>
                </div>
                <table class="table-auto w-full text-left whitespace-no-wrap">
                  <thead>
                    <tr>
                      <th
                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                        No.</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カテゴリー
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories" :key="category.id">
                      <td class="px-4 py-3">{{ category.id }}</td>
                      <td class="px-4 py-3">{{ category.name }}</td>
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
