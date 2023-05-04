<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;


/* @var $this yii\web\View */
/* @var $model app\models\Docente */

$this->title = ' Nuevo Docente';
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="docente-create w-40 d-flex flex-column justify-content-center">
    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados,
    ]) ?>

</div>