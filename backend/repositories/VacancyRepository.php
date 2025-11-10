<?php

namespace app\repositories;

use app\models\Vacancy;
use yii\data\ActiveDataProvider;

class VacancyRepository
{
    public function getAll(array $sort = [], int $page = 1, int $pageSize = 10): ActiveDataProvider
    {
        $query = Vacancy::find();

        if (!empty($sort)) {
            $query->orderBy($sort);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'page' => $page - 1,
                'pageSize' => $pageSize,
            ],
        ]);
    }

    public function find(int $id): ?Vacancy
    {
        return Vacancy::findOne($id);
    }

    public function save(Vacancy $vacancy): bool
    {
        return $vacancy->save();
    }
}
