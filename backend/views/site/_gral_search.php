<?php

use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use rmrevin\yii\fontawesome\FAS;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\LineaTesoreria */
/* @var $form yii\bootstrap\ActiveForm */

?>
<div class="panel panel-default border p-2">
    <div class="panel-heading border-bottom">
        <h4 class="panel-title"><?= $title ?></h4>
    </div>
    <div class="panel-body mt-3">
        <div class="form-group row">
            <div class="col-md-10 d-flex flex-row">
                <?php
                if (isset($components) && count($components) > 0) {
                    $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_INLINE,
                        'formConfig' => ['deviceSize' => ActiveForm::SIZE_SMALL, 'autocomplete' => 'off'],
                        'options' => [
                            'class' => ['d-flex'],
                        ]
                    ]);
                    foreach ($components as $key => $items) {
                        $options = ['class' => [$items['htmlClass']]];
                        switch ($items['type']) {
                            case 'date':
                                echo Html::beginTag('div', $options);
                                echo $form->field($model, $items['name'], ['showLabels' => false])->widget(
                                    DatePicker::class,
                                    [
                                        'bsVersion' => '5.x',
                                        'options' => ['placeholder' => isset($items['placeholder']) ? $items['placeholder'] : '', 'autocomplete' => 'off'],
                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                        'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                                        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ]
                                );
                                echo Html::endTag('div');
                                break;
                            case 'select2':
                                echo Html::beginTag('div', $options);
                                echo $form->field($model, $items['name'], ['showLabels' => false])->widget(
                                    Select2::class,
                                    [
                                        'bsVersion' => '5.x',
                                        'data' => $items['list'],
                                        'options' => [
                                            'placeholder' => isset($items['placeholder']) ? $items['placeholder'] : 'Seleccion una opcion...',
                                            'multiple' => isset($items['multiple'])
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]
                                );
                                echo Html::endTag('div');
                                break;
                            default:
                                echo Html::beginTag('div', $options);
                                echo $form->field($model, $items['name'], ['showLabels' => false])->textInput(
                                    [
                                        'type' => $items['type'],
                                        'min' => isset($items['min']) ? $items['min'] : '',
                                        'max' => isset($items['max']) ? $items['max'] : '',
                                        'placeholder' => isset($items['placeholder']) ? $items['placeholder'] : 'Registros'
                                    ]
                                );
                                echo Html::endTag('div');
                                break;
                        }
                    }
                } else
                    echo 'FORMULARIO DE GRUPO';
                ?>
            </div>
            <div class="d-flex flex-column gap-1 col-md-2">
                <?= Html::a(FAS::icon('bars') . ' Nuevo', [$this->context->id . '/create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::submitButton(FAS::icon('search') . ' Buscar', ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(FAS::icon('broom') . ' Limpiar', ['reset'], ['class' => 'btn btn-warning btn-sm']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>