<script setup>

const props = defineProps({
  previousMonth: Function,
  nextMonth: Function,
  displayMonth: String,
  displayNextMonthFlag: Boolean,
})

</script>


<template>
  <h3 class="text-center font-bold mb-4">
    <!-- 後ほどアイコンに変更 -->
    <span @click="previousMonth" class="mr-4">＜</span>
    {{ displayMonth }}
    <span @click="nextMonth" v-if="displayNextMonthFlag" class="ml-4">＞</span>
  </h3>
</template>
