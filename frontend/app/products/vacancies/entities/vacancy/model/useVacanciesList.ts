import { ref, computed, watch } from 'vue'
import type { VacancyType, VacancyResponse } from '../../../types'
export function useVacanciesList() {
    const config = useRuntimeConfig()
    const apiBase = config.public.apiBase
    const page = ref<number>(1)
    const sort = ref<string>('-created_at')
    const items = ref<VacancyType[]>([])
    const total = ref<number>(0)
    const loading = ref<boolean>(false)
    const error = ref<Error|null>(null)
    const totalPages = computed<number>(() => Math.ceil(total.value / 10))

    async function load() {
        loading.value = true
        error.value = null
        try {
            const res = await $fetch<VacancyResponse>(`${apiBase}/vacancies`, {
                method: 'GET',
                query: { page: page.value, sort: sort.value }
            })
            items.value = res.items
            total.value = res.pagination.total
        } catch (err: unknown) {
            error.value = err
            items.value = []
        } finally {
            loading.value = false
        }
    }

    watch(sort, () => {
        page.value = 1
        load()
    })
    watch(page, load)
    load()

    function prev() { if (page.value > 1) page.value-- }
    function next() { if (page.value < totalPages.value) page.value++ }

    return { page, sort, items, totalPages, loading, error, prev, next }
}
