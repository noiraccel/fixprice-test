export type VacancyType = {
    id: number
    title: string
    salary: number
    description: string
}

export type Pagination = {
    page: number
    pageSize: number
    total: number
}

export type VacancyResponse = {
    items: VacancyType[]
    pagination: Pagination
}