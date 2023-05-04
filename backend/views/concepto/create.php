<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\Concepto */

$this->title = ' Nuevo Concepto';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="concepto-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>