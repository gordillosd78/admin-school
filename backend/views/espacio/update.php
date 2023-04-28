<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;



/* @var $this yii\web\View */
/* @var $model app\models\Espacio */

$this->title = ' Modificar Espacio: ' . $model->id;
?>
<?= $this->render('../site/_column2_menus', ['model' => $model, 'items' => $items]) ?>

<div class="espacio-update">
    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>
    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados,
        'listaTipoEspacio' => $listaTipoEspacio,

    ]) ?>

</div>