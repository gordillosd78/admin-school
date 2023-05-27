<?php

use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\date\DatePicker;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\LineaTesoreria */
/* @var $form yii\bootstrap\ActiveForm */

$form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['deviceSize' => ActiveForm::SIZE_SMALL, 'autocomplete' => 'off']

]);
?>
<div class="panel panel-default d-flex flex-column w-40">
    <div class="panel-heading">
        <h4><?= $title ?></h4>
    </div>
    <div class="panel-body">
        <div class="form-group row">
            <div class="col-sm-6 col-md-4">
                <?= $form->field($model, 'fechaDesde', ['showLabels' => false])->widget(
                    DatePicker::class,
                    [
                        'bsVersion' => '3',
                        'options' => ['placeholder' => 'Fecha Desde', 'autocomplete' => 'off'],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy',
                        ]
                    ]
                ); ?>
            </div>
            <div class="col-sm-6 col-md-4">
                <?= $form->field($model, 'fechaHasta', ['showLabels' => false])->widget(
                    DatePicker::class,
                    [
                        'bsVersion' => '3',
                        'options' => ['placeholder' => 'Fecha Hasta', 'autocomplete' => 'off'],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ]
                ); ?>
            </div>
            <div class="col-sm-12 col-md-4">
                <?php
                if (isset($lista)) {
                    echo $form->field($model, $lista['field'], ['showLabels' => false])->widget(
                        Select2::class,
                        [
                            'bsVersion' => '3',
                            'data' => $lista['items'],
                            'options' => [
                                'placeholder' => isset($lista['placeholder']) ? $lista['placeholder'] : 'Seleccion una opcion...',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    );
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <?php
                echo $form->field($model, 'estado', ['showLabels' => false])->widget(
                    Select2::class,
                    [
                        'bsVersion' => '3',
                        'data' => (isset($estados)) ? $estados : $model->getEstados(),
                        'maintainOrder' => true,
                        'options' => [
                            'placeholder' => '-- Estados -- ',
                            'multiple' => true,
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]
                );
                ?>
            </div>
            <div class="col-md-3">
                <div class="col-sm-4 col-md-6">
                    <?= $form->field($model, 'rows', ['showLabels' => false])->input('number', ['min' => 10, 'max' => 99, 'placeholder' => 'Registros...']) ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= Html::a(FontAwesome::icon('bars') . ' Nuevo', [$this->context->id . '/create'], ['class' => 'btn btn-success']) ?>
                <?= Html::submitButton(FontAwesome::icon('search') . ' Buscar', ['class' => 'btn btn-primary']) ?>
                <?= Html::a(FontAwesome::icon('refresh') . ' Limpiar', ['reset'], ['class' => 'btn btn-warning']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>