<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;



/* @var $this yii\web\View */
/* @var $model app\models\TipoEmpleado */

$this->title = ' Modificar Tipo Empleado: ' . $model->id;
?>
<?=$this->render('../site/_column2_menus', ['model' => $model, 'items'=>$items]) ?>

<div class="tipo-empleado-update">
    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>