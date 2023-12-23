<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  errors: Object,
  item: Object,
  category: String
})

const form = reactive({
  name: props.item.name,
  category: props.category,
  price: props.item.price,
  cost: props.item.cost,
  memo: props.item.memo,
})

const updateItem = () => {
  Inertia.patch(route('items.update', { item: props.item.id }), form);
}

const deleteItem = (id) => {
  Inertia.delete(route('items.destroy', { item: id }),
    {
      onBefore: () => confirm('本当に削除しますか？')
    });
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品編集</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="updateItem">
                <div class="container px-5 py-24 mx-auto">
                  <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                          <input type="text" id="name" name="name" v-model="form.name"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div v-if="props.errors.name">{{ props.errors.name }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                          <input type="text" id="category" name="category" v-model="form.category"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div v-if="props.errors.category">{{ props.errors.category }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="price" class="leading-7 text-sm text-gray-600">販売価格</label>
                          <input type="number" id="price" name="price" v-model="form.price"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div v-if="props.errors.price">{{ props.errors.price }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="cost" class="leading-7 text-sm text-gray-600">仕入価格</label>
                          <input type="number" id="cost" name="cost" v-model="form.cost"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div v-if="props.errors.cost">{{ props.errors.cost }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                          <textarea id="memo" name="memo" v-model="form.memo"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                          <div v-if="props.errors.memo">{{ props.errors.memo }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <button
                          class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">商品更新</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="mt-8 p-2 w-full">
                <button @click="deleteItem(item.id)"
                  class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">
                  商品削除</button>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
