<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;


/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = ' Nuevo Curso';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="curso-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados,
        'listaTurnos' => $listaTurnos,
        'listaDivision' => $listaDivision,
        'listaEspacios' => $listaEspacios,
    ]) ?>

</div>