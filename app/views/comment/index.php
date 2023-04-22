<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\Comment;
use app\models\Entity;
use app\models\search\CommentSearch;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\grid\GridView;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                                                                                    Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row">
            <div class="col-12">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout'=>"{items}\n{pager}\n{summary}",

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
                            'filter' => Entity::getIdsList(),
                            'value' => function ($model) {
                                return $model->entity_id;
                            }
                        ],
                        [
                                'attribute' => 'created_at',
                                'value' => function ($model) {
                                    return date('d-m-Y',$model->created_at);
                                },

                        ],



                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                        ],
                    ],


                ]); ?>


            </div>
        </div>

    <?php endif; ?>
</div>
