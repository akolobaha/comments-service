<?php
namespace app\controllers;

use app\models\Comment;
use app\models\search\CommentSearch;
use yii\rest\Controller;
use function PHPUnit\Framework\isJson;

class ApiController extends Controller
{

    public $modelClass = 'app\models\Comment';

    public function actionIndex() {
        $query = \Yii::$app->request->queryParams;

        $queryParams = ["CommentSearch" => [
            "id" => isset($query['id']) ? $query['id'] : '',
            "username" => isset($query['username']) ? $query['username'] : '',
            "comment" => isset($query['comment']) ? $query['comment'] : '',
            "status" => isset($query['status']) ? $query['status'] : '',
            "entity_id" => isset($query['entity']) ? $query['entity'] : '',
            "created_at" => isset($query['date']) ? $query['date'] : '',
        ]];

        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $dataProvider->getModels();
    }

    public function actionCreate() {
        $model = new Comment();
        $json_params = json_decode(\Yii::$app->request->getRawBody(), TRUE);

        if (!empty($json_params['subject_id']))
            $model->entity_id = $json_params['subject_id'];
        if (!empty($json_params['username']))
            $model->username = $json_params['username'];
        if (!empty($json_params['comment']))
            $model->comment = $json_params['comment'];

        if ($model->save())
            return ['message' => 'OK!'];

        return ['message' => 'Invalid data', 'errors' => $model->getErrors()];
    }
}