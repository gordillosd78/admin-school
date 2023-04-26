<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */

$this->title = 'Create Padre Tutor';
$this->params['breadcrumbs'][] = ['label' => 'Padre Tutors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="padre-tutor-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados
    ]) ?>
</div>