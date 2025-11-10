import { ref } from 'vue'

export function useVacancyCreate() {
    const config = useRuntimeConfig()
    const apiBase = config.public.apiBase
    const loading = ref<boolean>(false)
    const error = ref<string | null>(null)
    const success = ref<boolean>(false)

    async function createVacancy(data: { title: string; description: string; salary: string | number }) {
        loading.value = true
        error.value = null
        try {
            const formData = new FormData()
            formData.append('title', data.title)
            formData.append('description', data.description)
            formData.append('salary', String(data.salary))

            const res = await $fetch<{ id: number }>(`${apiBase}/vacancies`, {
                method: 'POST',
                body: formData
            })

            success.value = true
        } catch (err: any) {
            error.value = err.data?.errors ? JSON.stringify(err.data.errors) : (err.message ?? 'Unknown error')
        } finally {
            loading.value = false
        }
    }

    return { loading, error, success, createVacancy }
}
