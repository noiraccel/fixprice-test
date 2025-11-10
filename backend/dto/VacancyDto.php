<?php

namespace app\dto;

use app\models\Vacancy;

class VacancyDto
{
    public int $id;
    public string $title;
    public ?int $salary;
    public ?string $description;
    public ?string $createdAt;
    public ?string $updatedAt;

    public static function fromModel(Vacancy $vacancy, array $fields = []): self
    {
        $dto = new self();

        $defaultFields = ['id', 'title', 'salary', 'description'];
        $validFields = array_merge($defaultFields, ['createdAt', 'updatedAt']);

        if (empty($fields)) {
            $fields = $defaultFields;
        }

        foreach ($fields as $field) {
            if (!in_array($field, $validFields, true)) {
                continue;
            }
            switch ($field) {
                case 'id':
                    $dto->id = $vacancy->id;
                    break;
                case 'title':
                    $dto->title = $vacancy->title;
                    break;
                case 'salary':
                    $dto->salary = isset($vacancy->salary) ? (int)$vacancy->salary : null;
                    break;
                case 'description':
                    $dto->description = $vacancy->description;
                    break;
                case 'createdAt':
                    $dto->createdAt = $vacancy->created_at;
                    break;
                case 'updatedAt':
                    $dto->updatedAt = $vacancy->updated_at;
                    break;
            }
        }

        return $dto;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}