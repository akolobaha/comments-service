<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\Html;

$this->title = 'Comment ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <fieldset disabled="">
                <legend>Disabled fieldset example</legend>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">id</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->id; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">username</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->username; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">comment</label>
                    <textarea rows="10" type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->comment; ?>"></textarea>
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">entity id</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->entity_id; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">entity title</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->entity->title; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">ip</label>
                    <input  type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->ip; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">user agent</label>
                    <textarea rows="5" type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->user_agent; ?>"></textarea>
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">status</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $model->getStatusName(); ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">created</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= date('d.m.Y H:i:s', $model->created_at);
                    ; ?>">
                </div>

                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">updated</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= date('d.m.Y H:i:s', $model->updated_at);
                    ; ?>">
                </div>

            </fieldset>

        </div>
    </div>

</div>
