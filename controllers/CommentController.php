<?php

namespace app\controllers;

use app\models\Comment;
use app\models\search\CommentSearch;
use Yii;
use yii\web\Controller;


class CommentController extends Controller
{
    public function actionIndex() {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreate() {
        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Комментарий успешно сохранен');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id) {
        $model = Comment::findOne($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = Comment::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Комментарий успешно обновлен');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        if (Comment::findOne($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Запись успешно удалена');

            return $this->redirect(Yii::$app->request->referrer ? : ['index']);
        }
    }
}
