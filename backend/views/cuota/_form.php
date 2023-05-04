<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cuota */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-9 well">
	<div class="cuota-form bg-light p-3">

		<?php $form = ActiveForm::begin([
			'options' => ['class' => 'disable-submit-buttons']
		]);
		?>

		<div class="col-md-4">
			<?= $form->field($model, 'alumno_id')->widget(
				Select2::class,
				[
					'bsVersion' => '5.x',
					'hideSearch' => false,
					'data' => $listaAlumnos,
					'options' => [
						'placeholder' => 'Seleccione un alumno...',
						'multiple' => false,
						'id' => 'alumno_id'
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]
			) ?>
		</div>

		<div class="col-md-4">
			<?= $form->field($model, 'fecha')->widget(
				DatePicker::class,
				[
					'options' => ['id' => 'fecha', 'placeholder' => 'Fecha', 'autocomplete' => 'off', 'value' => $model->isNewRecord ? $model->getFecha() : $model->fecha,],
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


		<div class="mt-4 d-md-flex flex-colum justify-content-evenly align-items-center form-group">
			<?= Html::submitButton(
				$model->isNewRecord ? FontAwesome::icon('bars') . ' Crear' : FontAwesome::icon('pencil') . ' Modificar',
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