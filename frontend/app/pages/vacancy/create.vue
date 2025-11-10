<template>
  <div>
    <h1 :class="$style.create__title">Создать вакансию</h1>

    <form @submit.prevent="submit" :class="$style.create__form">
      <div :class="$style.create__field">
        <label :class="$style.create__label">
          Название вакансии:
          <input v-model="title" type="text" required :class="$style.create__input" />
        </label>
      </div>

      <div :class="$style.create__field">
        <label :class="$style.create__label">
          Описание:
          <textarea v-model="description" required :class="$style.create__textarea"></textarea>
        </label>
      </div>

      <div :class="$style.create__field">
        <label :class="$style.create__label">
          Зарплата:
          <input v-model="salary" type="text" required :class="$style.create__input" />
        </label>
      </div>

      <button type="submit" :disabled="loading" :class="$style.create__btn">Создать</button>
    </form>

    <div v-if="success" :class="$style.create__success">
      Вакансия успешно создана!
    </div>

    <div v-if="error" :class="$style.create__error">
      Ошибка: {{ error }}
    </div>

    <NuxtLink to="/" :class="$style.create__back">← Назад к списку вакансий</NuxtLink>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useVacancyCreate } from "~/products/vacancies/entities/vacancy";

const title = ref('')
const description = ref('')
const salary = ref('')

const { loading, error, success, createVacancy } = useVacancyCreate()

async function submit() {
  await createVacancy({
    title: title.value,
    description: description.value,
    salary: salary.value
  })
}
</script>

<style module>
.create__title {
  font-size: 22px;
  margin-bottom: 20px;
}

.create__form {
  display: flex;
  flex-direction: column;
  gap: 14px;
  margin-bottom: 16px;
}

.create__field {
  display: flex;
  flex-direction: column;
}

.create__label {
  font-weight: 500;
  margin-bottom: 4px;
}

.create__input,
.create__textarea {
  width: 100%;
  padding: 6px 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-family: inherit;
  font-size: 15px;
}

.create__textarea {
  min-height: 100px;
  resize: vertical;
}

.create__btn {
  background: #2563eb;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 15px;
  align-self: start;
}

.create__btn:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.create__success {
  color: green;
  margin-bottom: 8px;
}

.create__error {
  color: red;
  margin-bottom: 8px;
}

.create__back {
  display: inline-block;
  margin-top: 10px;
  color: #2563eb;
  text-decoration: none;
}

.create__back:hover {
  text-decoration: underline;
}
</style>
