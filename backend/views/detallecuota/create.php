<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleCuota */

$this->title = ' Nuevo Detalle Cuota';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="detalle-cuota-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>