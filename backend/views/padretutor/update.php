<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */

$this->title = 'Update Padre Tutor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Padre Tutors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="padre-tutor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados
    ]) ?>

</div>