<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;
use kartik\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\DetalleCuota */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-12">
	<?php $fecha = $model->getFecha($model->cuota->fecha); //Usamos la fecha en el JQuery 
	?>
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
				<?= $form->field($model, 'periodo', [
					'inputOptions' => [
						'placeholder' => $model->getAttributeLabel('periodo'),
					]
				])->textInput(['disabled' => false, 'id' => 'periodo'])  ?>
			</div>

			<div class="col-md-3">
				<?= $form->field($model, 'vencimiento', [
					'inputOptions' => [
						'placeholder' => $model->getAttributeLabel('vencimiento'),
					]
				])->textInput(['disabled' => false, 'id' => 'vencimiento']) ?>
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
<?php
$script = <<< JS
//Aqui va el codigo JQuery
// $('#concepto_id').change(function () { 
// 	var conceptoId =$('#concepto_id').val();
// 	console.log(conceptoId);	
// 	$.get('index.php?r=concepto/listperiodo',{conceptoId:conceptoId},function(data){
//         $('#periodo_id').html(data);
// 		console.log(data);
//         $('#periodo_id').attr('disabled',false);
        
//     });
// });

$("#concepto_id").change(function(){
    var conceptoId = $('#concepto_id').val(); 
    var fecha = "{$fecha}";//pasamos el valor de la variable desde php a JQuery

    $.get('index.php?r=cuota/vencimiento', {conceptoId:conceptoId,fecha:fecha}, function(data){
         if (data){
             const value = (data) ? $.parseJSON(data) : '';          
             $('#periodo').attr('value', value.periodo);
             $('#vencimiento').attr('value', value.vencimiento);
         }        
     });       
 });

JS;
$this->registerJs($script);
?>