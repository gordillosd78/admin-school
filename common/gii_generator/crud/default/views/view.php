<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FontAwesome;
use <?= ltrim($generator->modelClass, '\\') ?>;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = ' <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>: '.$model-><?= $generator->getNameAttribute() ?>;
?>
<?= "<?= " ?>$this->render('../site/_column2_menus', ['model' => $model, 'items'=>$items]) ?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <legend>
        <h1><?= "<?= " ?>FontAwesome::icon('eye')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <p>
        <?= "<?= " ?>Html::a(FontAwesome::icon('pencil').<?= $generator->generateString(' Modificar') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a(FontAwesome::icon('trash').<?= $generator->generateString(' Desactivar / Activar') ?>, ['delete', <?= $urlParams ?>], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => <?= $generator->generateString('¿Está seguro que desea modificar el estado de este registro?') ?>,
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <div class="col-md-8 col-md-offset-2 well">
        <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
        <?php
        if (($tableSchema = $generator->getTableSchema()) === false) {
            foreach ($generator->getColumnNames() as $name) {
                echo "            '" . $name . "',\n";
            }
        } else {
            foreach ($generator->getTableSchema()->columns as $column) {
                $format = $generator->generateColumnFormat($column);
                if ($format === 'boolean')
                    echo "            [
                    'attribute' => '$column->name',
                    'value' => $" . 'model->' . $column->name . " ? FontAwesome::icon('check')->border() : FontAwesome::icon('close')->border(),
                    'format' => 'raw'
                ],\n";
                elseif ($column->name === 'created_by')
                    echo "            [
                        'attribute' => '$column->name',
                        'value' => ($" . "model->created_by) ? $" . "model->createdBy->username : ''
                    ],\n";
                elseif ($column->name === 'updated_by')
                    echo "            [
                        'attribute' => '$column->name',
                        'value' => ($" . "model->updated_by) ? $" . "model->updatedBy->username : ''
                    ],\n";
                else
                    echo "            '" . $column->name . "',\n";
            }
        }
        ?>
        ],
        ]) ?>
    </div>
</div>