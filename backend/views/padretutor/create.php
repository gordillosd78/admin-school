<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */

$this->title = Yii::t('app', ' Nuevo Padre-Tutor'); ?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>

<div class="padre-tutor-create d-flex flex-column justify-content-center">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaParentesco' => $listaParentesco,
        'listaTipoEmpleado' => $listaTipoEmpleado,

    ]) ?>
</div>