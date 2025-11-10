<?php
namespace app\controllers;

use yii\rest\Controller;
use yii\filters\Cors;
use Yii;
use app\services\VacancyService;
use app\dto\VacancyDto;

class VacanciesController extends Controller
{
    public function __construct(
        $id,
        $module,
        private VacancyService $service,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        //for local dev
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => false,
                'Access-Control-Allow-Headers' => ['Authorization', 'Content-Type', 'X-Requested-With'],
            ],
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = 'json';
        unset($behaviors['rateLimiter']);

        return $behaviors;
    }

    public function actionIndex(): array
    {
        $sortParam = Yii::$app->request->get('sort', '-created_at');
        $direction = str_starts_with($sortParam, '-') ? SORT_DESC : SORT_ASC;
        $sortField = str_starts_with($sortParam, '-') ? substr($sortParam, 1) : $sortParam;

        $sort = in_array($sortField, ['salary', 'created_at'], true) ? [$sortField => $direction] : [];
        $page = (int)Yii::$app->request->get('page', 1);

        $provider = $this->service->getAll($sort, $page);

        $items = array_map(fn($v) => VacancyDto::fromModel($v)->toArray(), $provider->getModels());

        return [
            'items' => $items,
            'pagination' => [
                'page' => $provider->pagination->page + 1,
                'pageSize' => $provider->pagination->pageSize,
                'total' => $provider->getTotalCount(),
            ],
        ];
    }


    public function actionView(int $id): array
    {
        $fields = Yii::$app->request->get('fields');
        $fields = $fields ? array_map('trim', explode(',', $fields)) : [];

        $vacancy = $this->service->get($id);

        return VacancyDto::fromModel($vacancy, $fields)->toArray();
    }

    public function actionCreate(): array
    {
        $body = Yii::$app->request->getBodyParams();

        try {
            $vacancy = $this->service->create($body);
            Yii::$app->response->statusCode = 201;

            return ['id' => $vacancy->id, 'code' => 201];
        } catch (\InvalidArgumentException $e) {
            Yii::$app->response->statusCode = 400;
            return ['errors' => json_decode($e->getMessage(), true), 'code' => 400];
        }
    }
}

