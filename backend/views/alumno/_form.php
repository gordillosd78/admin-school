<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Alumno */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-12">
	<div class="alumno-form d-flex bg-light p-3">

		<?php $form = ActiveForm::begin([
			'options' => ['class' => 'd-flex flex-column disable-submit-buttons']
		]);
		?>
		<div class="d-flex flex-wrap justify-content-around">
			<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'dni')->textInput(['type' => 'number', 'max' => 99999999, 'min' => 0]) ?>

			<?= $form->field($model, 'fecha_nacimiento')->widget(
				DatePicker::class,
				[
					'options' => ['id' => 'fecha_nacimiento', 'placeholder' => 'Fecha_Nacmiento', 'autocomplete' => 'off', 'value' => $model->isNewRecord ? $model->getFecha() : $model->fecha_nacimiento,],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
					'removeIcon' => '<i class="fas fa-trash text-danger"></i>',

					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'dd-mm-yyyy',
					]
				]
			); ?>

			<?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'localidad')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>

			<?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'carrera_id')->widget(
				Select2::class,
				[
					'data' => $listaCarrera,
					'theme' => Select2::THEME_BOOTSTRAP,
					'options' => [
						'placeholder' => 'Seleccione una Carrera...',
						'multiple' => false,
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]
			) ?>


			<?= $form->field($model, 'padre_tutor_id')->widget(
				Select2::class,
				[
					'data' => $listaPadreTutor,
					'theme' => Select2::THEME_BOOTSTRAP,
					'options' => [
						'placeholder' => 'Seleccione un Tutor...',
						'multiple' => false,
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]
			) ?>

			<?= $form->field($model, 'observacion')->textarea(['resize' => false]) ?>

			<?= $form->field($model, 'estado')->dropDownList($model->getEstado()) ?>
		</div>
		<div class="mt-4 d-md-flex flex-colum justify-content-evenly align-items-center form-group">
			<?= Html::submitButton(
				$model->isNewRecord ? FontAwesome::icon('bars') . ' Crear' : FontAwesome::icon('pencil') . ' Modificar',
				[
					'class' => $model->isNewRecord ? 'btn btn-success w-50 btn-lg btn-block' : 'btn btn-primary w-50 btn-lg btn-block',
					'data' => ['disabled-text' => 'Procesando...']
				]
			)
			?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>