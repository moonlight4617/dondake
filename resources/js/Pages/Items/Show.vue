<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
  item: Object
})
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品詳細</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                  <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label class="leading-7 text-sm text-gray-600">商品名</label>
                        <div type="text"
                          class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8">
                          {{ item.name }}
                        </div>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="price" class="leading-7 text-sm text-gray-600">価格</label>
                        <div type="number" id="price"
                          class="w-full bg-opacity-50 rounded border border-gray-300 text-base outline-none text-gray-700 py-1 px-3 leading-8">
                          {{ item.price }}
                        </div>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label class="leading-7 text-sm text-gray-600">メモ</label>
                        <div
                          class="w-full bg-opacity-50 rounded border border-gray-300 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6">
                          {{ item.memo }}
                        </div>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label class="leading-7 text-sm text-gray-600">販売状況</label>
                        <div
                          class="w-full bg-opacity-50 rounded border border-gray-300 text-base outline-none text-gray-700 py-1 px-3 leading-8">
                          <span v-if="item.is_selling === 1">販売中</span>
                          <span v-if="item.is_selling === 0">停止中</span>
                        </div>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <Link as="button" :href="route('items.edit', { id: item.id })"
                        class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                      商品編集
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
