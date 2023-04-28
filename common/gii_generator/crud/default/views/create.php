<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString(' Nuevo ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
?>

<?= "<?= " ?>$this->render('../site/_column2_menus', ['items'=>$items]) ?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <legend>
        <h1><?= "<?= " ?>FontAwesome::icon('bars') . Html::encode($this->title) ?></h1>
    </legend>

    <?= "<?= " ?>$this->render('_form', [
    'model' => $model,
    ]) ?>

</div>