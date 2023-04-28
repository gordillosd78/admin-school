<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;


/* @var $this yii\web\View */
/* @var $model app\models\TipoEspacio */

$this->title = ' Nuevo Tipo Espacio';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="tipo-espacio-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
        'listaEstados' => $listaEstados,
    ]) ?>

</div>