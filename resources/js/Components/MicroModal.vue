<script setup>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';


const isShow = ref(false);
const search = ref("");
const customers = reactive({})
const emit = defineEmits('update:customerId');

const toggleIsShow = () => {
  isShow.value = !isShow.value
}

const searchCustomer = async () => {
  console.log(search.value)
  await axios.get(`/api/searchCustomer/?search=${search.value}`)
    .then(res => {
      console.log(res.data)
      customers.value = res.data
      toggleIsShow();
    })
    .catch((e) => {
      console.log(e)
    })
}

const selectCustomer = e => {
  emit('update:customerId', e.id)
  search.value = e.kana
  toggleIsShow();
}

onMounted(() => {
  axios.get('/api/user')
    .then(res => {
      console.log(res)
    })
})

</script>


<template>
  <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            顧客検索
          </h2>
          <button type="button" @click="toggleIsShow" class="modal__close" aria-label="Close modal"
            data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <table v-if="customers.value" class="table-auto w-full text-left whitespace-no-wrap">
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
              <tr v-for="customer in customers.value.data" :key="customer.id">
                <button class="text-blue-400" type="button"
                  @click="selectCustomer({ id: customer.id, kana: customer.kana })">
                  <td class="px-4 py-3">{{ customer.id }}</td>
                </button>
                <td class="px-4 py-3">{{ customer.name }}</td>
                <td class="px-4 py-3">{{ customer.kana }}</td>
                <td class="px-4 py-3">{{ customer.tel }}</td>
              </tr>
            </tbody>
          </table>
        </main>
        <footer class="modal__footer">
          <button type="button" @click="toggleIsShow" class="modal__btn" data-micromodal-close
            aria-label="Close this dialog window">閉じる</button>
        </footer>
      </div>
    </div>
  </div>
  <input
    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
    name="search" v-model="search">
  <button
    class="mt-2 flex ml-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md"
    type="button" @click="searchCustomer">検索</button>
</template>