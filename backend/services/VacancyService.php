<?php

namespace app\services;

use app\models\Vacancy;
use app\repositories\VacancyRepository;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class VacancyService
{
    public function __construct(public VacancyRepository $repository) {}

    public function create(array $data): Vacancy
    {
        $vacancy = new Vacancy();
        $vacancy->title = $data['title'] ?? null;
        $vacancy->description = $data['description'] ?? null;
        $vacancy->salary = isset($data['salary']) ? (int)$data['salary'] : null;

        if (!$vacancy->validate()) {
            throw new \InvalidArgumentException(json_encode($vacancy->getErrors()));
        }

        $this->repository->save($vacancy);
        return $vacancy;
    }

    public function get(int $id): Vacancy
    {
        $vacancy = $this->repository->find($id);
        if (!$vacancy) {
            throw new NotFoundHttpException('Vacancy not found');
        }

        return $vacancy;
    }

    public function getAll(array $sort = [], int $page = 1, int $pageSize = 10): ActiveDataProvider
    {
        return $this->repository->getAll($sort, $page, $pageSize);
    }
}
