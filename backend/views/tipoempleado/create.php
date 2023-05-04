<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;


/* @var $this yii\web\View */
/* @var $model app\models\TipoEmpleado */

$this->title = ' Nuevo Tipo Empleado';
?>

<?= $this->render('../site/_column2_menus', ['items'=>$items]) ?>
<div class="tipo-empleado-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>