<?php
namespace app\controllers;

use app\models\Comment;
use app\models\Entity;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\Response;
use function PHPUnit\Framework\isJson;

class ApiController extends Controller
{
    const LIMIT = 1000;

    public $modelClass = 'app\models\Comment';

    public function actionIndex() {
        return Comment::find()->limit(self::LIMIT)->all();
    }

    public function actionView($id) {
        return Comment::find()->where(['id' => $id])->asArray()->one();
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