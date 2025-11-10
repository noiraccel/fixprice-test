import { ref } from 'vue'
import type { VacancyType } from '~/types'

export function useVacancy() {
    const config = useRuntimeConfig()
    const apiBase = config.public.apiBase
    const vacancy = ref<VacancyType | null>(null)
    const loading = ref<boolean>(false)
    const error = ref<Error | null>(null)

    async function loadOne(id: string | number) {
        loading.value = true
        error.value = null
        try {
            vacancy.value = await $fetch<VacancyType>(`${apiBase}/vacancies/${id}`)
        } catch (err: unknown) {
            error.value = err instanceof Error ? err : new Error('Unknown error')
            vacancy.value = null
        } finally {
            loading.value = false
        }
    }

    return { vacancy, loading, error, loadOne }
}
