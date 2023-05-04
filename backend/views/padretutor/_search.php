<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PadreTutorSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="padre-tutor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'dni') ?>

    <?= $form->field($model, 'domicilio') ?>

    <?php // echo $form->field($model, 'localidad') 
    ?>

    <?php // echo $form->field($model, 'fecha_nacimiento') 
    ?>

    <?php // echo $form->field($model, 'observacion') 
    ?>

    <?php // echo $form->field($model, 'estado') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <?php // echo $form->field($model, 'created_by') 
    ?>

    <?php // echo $form->field($model, 'updated_by') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>