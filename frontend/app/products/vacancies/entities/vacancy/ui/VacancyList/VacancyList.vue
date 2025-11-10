<template>
  <ul :class="$style.list">
    <VacancyItem v-for="vacancy in items" :key="vacancy.id" :vacancy="vacancy"/>
  </ul>
</template>

<script setup lang="ts">
import { VacancyItem } from '~/products/vacancies/entities/vacancy/'
import type { VacancyType } from '~/products/vacancies/types'

defineProps<{
  items: VacancyType[]
}>()
</script>

<style module>
.list {
  list-style: none;
  padding: 0;
  margin: 0;
}
</style>
