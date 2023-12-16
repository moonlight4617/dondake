<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const newTitle = ref("");
const newContent = ref("");
</script>

<template>
  inertiaテスト<br>
  <a href="/">aタグからの遷移</a><br>
  <Link href="/">Linkからの遷移</Link><br>
  <Link :href="route('inertia.index')">inertia.indexのテスト</Link><br>
  <Link :href="route('inertia.show', { id: 1 })">inertia.showのテスト</Link>

  <div class="mb-8"></div>
  <input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
  <input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
  <Link method="post" :href="route('inertia.store')" as="button" :data="{
    title: newTitle,
    content: newContent
  }">新規データ保存</Link>
</template>