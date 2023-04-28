<?php

use yii\helpers\Html;
use kartik\widgets\DatePicker;
//use kartik\select2\select2;

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="col-md-9">

    <div class="padre-tutor-form bg-light p-3">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dni')->textInput() ?>

        <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'localidad')->textInput(['maxlength' => true]) ?>

        <!-- <?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?> -->

        <!-- <div class="col-md-4">
        <? //$form->field($model, 'fecha_nacimiento')->widget(
        //DatePicker::class,
        //[
        // 'options' => ['id' => 'fecha_nacimiento', 'placeholder' => 'Fecha Nacimiento', 'autocomplete' => 'off', 'value' => $model->isNewRecord ? $model->getFecha() : $model->fecha,],
        // 'type' => DatePicker::TYPE_COMPONENT_APPEND,
        // 'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
        // 'removeIcon' => '<i class="fas fa-trash text-danger"></i>',

        // 'pluginOptions' => [
        //     'autoclose' => true,
        //     'format' => 'dd-mm-yyyy',
        // ]
        //  ]
        //); 
        ?>
        </div> -->

        <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'estado')->dropDownList($listaEstados) ?>

        <div class="mt-4 d-md-flex flex-colum justify-content-evenly align-items-center form-group">
            <?= Html::submitButton(
                $model->isNewRecord ? ' Crear' : ' Modificar',
                [
                    'class' => $model->isNewRecord ? 'btn btn-success w-75 btn-lg btn-block' : 'btn btn-primary w-75 btn-lg btn-block',
                    'data' => ['disabled-text' => 'Procesando...']
                ]
            )
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>