<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */

$this->title = 'Update Padre Tutor: ' . $model->id;
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>

<div class="padre-tutor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados,
        'listaParentesco' => $listaParentesco,
        'listaTipoEmpleado' => $listaTipoEmpleado,

    ]) ?>

</div>