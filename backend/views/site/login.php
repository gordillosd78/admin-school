<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="d-flex flex-column justify-content-center align-items-center site-login">
    <div class="col-md-4 shadow-lg p-4 mb-5 bg-body rounded border d-flex flex-column ">
        <h1><?= FontAwesome::icon('landmark')->size('xs') . ' ' . Html::encode($this->title) ?></h1>

        <h5 class="fw-normal mt-2 mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group d-flex justify-content-center">
            <?= Html::submitButton('Login', ['class' => 'w-50 btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>