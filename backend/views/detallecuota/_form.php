<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleCuota */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-12">
	<div class="row detalle-cuota-form bg-light p-4">
		<div class="col-md-9">

			<?php $form = ActiveForm::begin([
				'action' => ['detallecuota/create', 'cuota_id' => $model->cuota_id],
				'options' => ['class' => 'row disable-submit-buttons']
			]);
			?>
			<div class="col-md-3">
				<?= $form->field($model, 'concepto_id')->dropDownList(
					$listadoConceptos,
					[
						'prompt' => 'Seleccione un Concepto de pago...',
						'id' => 'concepto_id',
						'disabled' => false
					]
				) ?>
			</div>

			<div class="col-md-3">
				<?= $form->field($model, 'periodo')->dropDownList(
					$listadoPeriodos,
					[
						'prompt' => 'Seleccione un Periodo de pago...',
						'id' => 'periodo_id',
						'disabled' => false
					]
				) ?>
			</div>

			<div class="col-md-3">
				<?= $form->field($model, 'cantidad', [
					'inputOptions' => [
						'placeholder' => $model->getAttributeLabel('cantidad'),
					]
				])->textInput(['type' => 'number', 'min' => 0, 'disabled' => false, 'id' => 'cantidad_id']) ?>
			</div>

			<div class="col-md-6">
				<?= $form->field($model, 'observacion', [
					'inputOptions' => [
						'placeholder' => $model->getAttributeLabel('observacion'),
					]
				])->textarea(['resize' => false]) ?>
			</div>
		</div>

		<div class="col-md-3 col-md-offset-3 form-group"">
			<?= Html::submitButton(
				$model->isNewRecord ? FontAwesome::icon('bars') . ' Agregar' : FontAwesome::icon('pencil') . ' Modificar',
				[
					'class' => $model->isNewRecord ? 'btn btn-success w-75 btn-lg btn-block' : 'btn btn-primary w-75 btn-lg btn-block',
					'data' => ['disabled-text' => 'Procesando...']
				]
			)
			?>
            <?= Html::a(FontAwesome::icon('reply-all') . ' Atras', ['cuota/index'], ['class' => 'btn btn-default bg-white w-75 btn-block border mt-2']) ?>

		</div>
		<?php ActiveForm::end(); ?>		
	</div>
</div>