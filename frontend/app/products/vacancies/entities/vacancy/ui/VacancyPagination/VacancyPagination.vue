<template>
  <div :class="$style.pagination">
    <button
        :class="$style.pagination__btn"
        @click="$emit('prev')"
        :disabled="page <= 1"
    >
      Назад
    </button>

    <span :class="$style.pagination__page">Страница {{ page }} / {{ totalPages }}</span>

    <button
        :class="$style.pagination__btn"
        @click="$emit('next')"
        :disabled="page >= totalPages"
    >
      Вперёд
    </button>
  </div>
</template>

<script setup lang="ts">
defineProps({
  page: {
    type: Number,
    required: true
  },
  totalPages: {
    type: Number,
    required: true
  }
})
</script>

<style module>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
}

.pagination__btn {
  background: #2563eb;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.pagination__btn:disabled {
  background: #ccc;
  cursor: not-allowed;
}

.pagination__page {
  font-size: 0.95rem;
}
</style>
