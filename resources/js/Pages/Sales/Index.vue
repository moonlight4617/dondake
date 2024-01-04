<script setup>
import { computed, onMounted, reactive, ref, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import SalesTable from '@/Parts/SalesTable.vue';
import DisplayYearMonth from '@/Parts/DisplayYearMonth.vue';
import { getDataPerMonth, previousMonth, nextMonth } from '../../fetchAndDisplayYearMonth';

const props = defineProps({
  sales_data: Array,
})

const data = reactive({
  data: [],
});
const initialDisplay = () => {
  data.data = props.sales_data;
}

initialDisplay();

const displayMonth = computed(() => {
  return `${yearRef.value}/${monthRef.value}`
})

const now = new Date();
const yearRef = ref(now.getFullYear());
const monthRef = ref(now.getMonth() + 1);

const displayNextMonthFlag = ref(false)

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
                <DisplayYearMonth :previousMonth="previous" :nextMonth="next" :displayMonth="displayMonth"
                  :displayNextMonthFlag="displayNextMonthFlag" />
                <SalesTable :sales_data=sales_data />
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
