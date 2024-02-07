<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  errors: Object,
})

const form = reactive({
  category: null,
})

const storeItem = () => {
  Inertia.post('/categories', form);
}
</script>

<template>
  <Head title="カテゴリー登録" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">カテゴリー登録</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="storeItem">
                <div class="container px-5 py-24 mx-auto">
                  <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー名</label>
                          <input type="text" id="category" name="category" v-model="form.category"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div v-if="errors.category">{{ errors.category }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <button
                          class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">商品登録</button>
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
