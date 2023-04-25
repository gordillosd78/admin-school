<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
	$safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;
use kartik\form\ActiveForm;
use <?= ltrim($generator->modelClass, '\\') ?>;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php $diabledAttributes = ['habilitado', 'created_by', 'updated_by', 'created_at', 'updated_at']; ?>
<div class="col-md-8 col-md-offset-2 well">
	<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

		<?= "<?php " ?>$form = ActiveForm::begin([
		    'options' => ['class' => 'disable-submit-buttons']
		]);
		?>

		<?php foreach ($generator->getColumnNames() as $attribute) {
			if (in_array($attribute, $safeAttributes) && !in_array($attribute, $diabledAttributes)) {
				echo "<?= " . $generator->generateActiveField($attribute) . " ?>\n\n\t\t\t";
			}
		} ?>

		<div class="col-md-6 col-md-offset-3 form-group">
			<?= "<?= " ?>Html::submitButton(
			$model->isNewRecord ? FAS::icon('bars').' Crear' : FAS::icon('pencil').' Modificar',
			[
			    'class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block' : 'btn btn-primary btn-lg btn-block',
			    'data' => ['disabled-text' => 'Procesando...']
			])
			<?= "?>\n" ?>
		</div>

		<?= "<?php " ?>ActiveForm::end(); ?>
	</div>
</div>