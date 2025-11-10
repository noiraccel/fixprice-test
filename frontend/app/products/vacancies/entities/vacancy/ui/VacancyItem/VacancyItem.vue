<template>
  <li :class="$style.item">
    <h3 :class="$style.item__title">
      <NuxtLink :to="`/vacancy/${vacancy.id}`" :class="$style.item__link">
        {{ vacancy.title }}
      </NuxtLink>
    </h3>
    <p :class="$style.item__salary">Зарплата: {{ vacancy.salary }}</p>
    <p :class="$style.item__desc">{{ vacancy.description.slice(0, 200) }}...</p>
  </li>
</template>

<script setup lang="ts">
import type { VacancyType } from '~/products/vacancies/types'
defineProps<{
  vacancy: VacancyType
}>()

</script>

<style module>
.item {
  border-bottom: 1px solid #ddd;
  padding: 10px 0;
}

.item__title {
  margin: 0 0 4px;
  font-size: 17px;
}

.item__link {
  color: #2563eb;
  text-decoration: none;
}

.item__link:hover {
  text-decoration: underline;
}

.item__salary {
  margin: 0 0 4px;
  font-weight: 500;
}

.item__desc {
  margin: 0;
  color: #555;
}
</style>
