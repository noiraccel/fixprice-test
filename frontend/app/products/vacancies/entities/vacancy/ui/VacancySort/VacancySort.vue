<template>
  <label>
    Сортировка:
    <select :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
      <option value="-created_at">По дате (новые)</option>
      <option value="created_at">По дате (старые)</option>
      <option value="-salary">По зарплате (убывание)</option>
      <option value="salary">По зарплате (возрастание)</option>
    </select>
  </label>
</template>

<script setup lang="ts">
defineProps({
  modelValue: {
    type: String,
    required: true
  },
})

defineEmits(['update:modelValue'])
</script>
