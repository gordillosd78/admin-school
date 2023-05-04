<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\Alumno */

$this->title = ' Nuevo Alumno';
?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="alumno-create">

    <legend>
        <h1><?= FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= $this->render('_form', [
        'model' => $model,
        'listaCarrera' => $listaCarrera,
        'listaPadreTutor' => $listaPadreTutor
    ]) ?>

</div>