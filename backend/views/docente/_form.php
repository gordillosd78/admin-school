<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use kartik\form\ActiveForm;

use app\models\Docente;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="d-flex flex-column justify-content-center align-items-center">
	<div class="docente-form bg-light p-3 w-50">

		<?php $form = ActiveForm::begin([
			'options' => ['class' => 'disable-submit-buttons']
		]);
		?>

		<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'dni')->textInput(['type' => 'number']) ?>

		<?= $form->field($model, 'fecha_nacimiento')->textInput(['type' => 'date']) ?>

		<?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

		<?= $form->field($model, 'telefono')->textInput(['type' => 'number']) ?>

		<?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'estado')->dropDownList($model->getEstado()) ?>

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