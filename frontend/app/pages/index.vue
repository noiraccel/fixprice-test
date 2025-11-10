<template>
  <div>
    <div :class="$style.vacancies__header">
      <h1 :class="$style.vacancies__title">Вакансии</h1>
      <NuxtLink to="/vacancy/create" :class="$style.vacancies__create">+ Создать вакансию</NuxtLink>
    </div>

    <VacancySort v-model="sort" :class="$style.vacancies__sort"/>

    <div v-if="loading">Загрузка...</div>
    <div v-else-if="error">Ошибка: {{ error.message }}</div>
    <VacancyList v-else :items="items" />

    <VacancyPagination
        v-if="totalPages > 0"
        :page="page"
        :total-pages="totalPages"
        @prev="prev"
        @next="next"
    />
  </div>
</template>

<script setup lang="ts">
import {
  VacancyPagination,
  VacancyList, VacancySort,
} from '~/products/vacancies/entities/vacancy'
import { useVacanciesList } from "~/products/vacancies/entities/vacancy";

const { page, sort, items, totalPages, loading, error, prev, next } = useVacanciesList()
</script>

<style module>
.vacancies__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.vacancies__title {
  margin: 0;
  font-size: 24px;
}

.vacancies__create {
  color: #fff;
  background: #2563eb;
  padding: 6px 10px;
  border-radius: 4px;
  text-decoration: none;
}

.vacancies__sort {
  margin-bottom: 12px;
}
</style>
