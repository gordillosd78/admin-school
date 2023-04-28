<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;



/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString(' Modificar {modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?> . $model-><?= $generator->getNameAttribute() ?>;
?>
<?= "<?=" ?>$this->render('../site/_column2_menus', ['model' => $model, 'items'=>$items]) ?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">
    <legend>
        <h1><?= "<?= " ?>FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>
    <?= "<?= " ?>$this->render('_form', [
    'model' => $model,
    ]) ?>

</div>