<template>
  <div v-if="vacancy">
    <h1 :class="$style.vacancy__title">{{ vacancy.title }}</h1>
    <p :class="$style.vacancy__salary">Зарплата: {{ vacancy.salary }}</p>
    <p :class="$style.vacancy__desc">{{ vacancy.description }}</p>

    <NuxtLink to="/" :class="$style.vacancy__back">← Назад к списку</NuxtLink>
  </div>
  <div v-else>
    <p>Загрузка вакансии...</p>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useVacancy } from "~/products/vacancies/entities/vacancy";

const { vacancy, loadOne } = useVacancy()
const route = useRoute()

onMounted(() => {
  loadOne(route.params.id as string)
})

</script>

<style module>
.vacancy__title {
  font-size: 22px;
  margin-bottom: 10px;
}

.vacancy__salary {
  font-weight: 600;
  margin-bottom: 10px;
}

.vacancy__desc {
  margin-bottom: 20px;
  line-height: 1.5;
  color: #333;
}

.vacancy__back {
  color: #2563eb;
  text-decoration: none;
}

.vacancy__back:hover {
  text-decoration: underline;
}
</style>
