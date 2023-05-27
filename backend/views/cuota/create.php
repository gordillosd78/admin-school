<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\Cuota */

$this->title = ' Nueva Cuota';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="cuota-create 
            d-flex flex-column 
            justify-content-center 
            align-items-center w-80">

    <legend class="col-md-9">
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
        <hr>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
        'listaAlumnos' => $listaAlumnos
    ]) ?>

</div>