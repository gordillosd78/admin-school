<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\widgets\ActiveForm;
use app\models\Division;

/* @var $this yii\web\View */
/* @var $model app\models\Division */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-9">
	<div class="division-form bg-light p-3">

		<?php $form = ActiveForm::begin([
			'options' => ['class' => 'disable-submit-buttons']
		]);	?>

		<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'estado')->dropDownList($listaEstados) ?>

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