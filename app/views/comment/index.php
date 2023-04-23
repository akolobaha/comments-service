<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\Comment;
use app\models\Entity;
use kartik\date\DatePicker;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\grid\GridView;

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success"></div>


    <?php else: ?>

        <div class="row">
            <div class="col-12">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout'=>"{items}\n{pager}\n{summary}",
                    'pager' => [
                        'class' => LinkPager::class,
                        'options' => ['class' => 'pagination'],
                        'linkOptions' => ['class' => 'page-link'],
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => 'disabled',
                        'prevPageCssClass' => 'page-item prev',
                        'nextPageCssClass' => 'page-item next',
                        'prevPageLabel' => '<span aria-hidden="true">&laquo;</span>',
                        'nextPageLabel' => '<span aria-hidden="true">&raquo;</span>',
                        'maxButtonCount' => 3,
                    ],

                    'columns' => [
                        'id',
                        [
                            'attribute' => 'username',
                            'value' => function($model) {
                                return $model->username;
                            }
                        ],
                        [
                            'attribute' => 'comment',
                            'value' => function ($model) {
                                $description = strip_tags($model->comment);
                                return substr($description, 0, 150) . (strlen($description) > 150 ? '...' : '');
                            },

                        ],
                        [
                            'attribute' => 'status',
                            'filter' => Comment::STATUS_LIST,
                            'value' => function ($model) {
                                return $model->getStatusName();
                            }
                        ],
                        [
                            'attribute' => 'entity_id',
                            'filter' => Entity::getTitlesList(),
                            'value' => function ($model) {
                                return $model->entity->title . ' id: (' . $model->entity_id . ')';
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'value' => 'created_at',
                            'format' => ['date', 'php:d.m.Y'],
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'created_at',
                                'options' => ['placeholder' => 'Select date'],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd.mm.yyyy'
                                ]
                            ]),
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                        ],
                    ],


                ]); ?>


            </div>
        </div>

    <?php endif; ?>
</div>
