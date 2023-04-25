<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
use rmrevin\yii\fontawesome\FAS;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>


/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= ' \' Administrar ' . Inflector::camel2words(StringHelper::basename($generator->modelClass)) . '\'' ?>;
?>
<?= "<?= " ?>$this->render('../site/_column2_menus', ['items'=>$items]) ?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <legend>
        <h1><?= "<?= " ?>FAS::icon('cogs')->border().Html::encode($this->title) ?></h1>
    </legend>

<?php if (!empty($generator->searchModelClass)) : ?>
    <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>
    <p>
        <?= "<?= " ?>Html::a(FAS::icon('bars'). <?= $generator->generateString(' Nuevo ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $generator->enablePjax ? "<?php Pjax::begin(); ?>\n" : '' ?>
    <?php if ($generator->indexWidgetType === 'grid') : ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
        <?php
        $count = 0;
        if (($tableSchema = $generator->getTableSchema()) === false) {
            foreach ($generator->getColumnNames() as $name) {
                if (++$count < 6) {
                    echo "            '" . $name . "',\n";
                } else {
                    echo "            // '" . $name . "',\n";
                }
            }
        } else {
            foreach ($tableSchema->columns as $column) {
                $format = $generator->generateColumnFormat($column);
                if (++$count < 6) {
                    if ($format === 'boolean')
                        echo "            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => '$column->name', 
                'vAlign' => 'middle'
            ],\n";
                    elseif ($column->name === 'estado')
                        echo "            [
                'attribute' => 'estado',
                'value' => function (\$model) {
                    return \$model->getEstado(\$model->estado);
                }
            ],\n";
                    else
                        echo "            '" . $column->name . ($format === 'text' ? "" : $format) . "',\n";
                } else {
                    echo "            // '" . $column->name . ($format === 'text' ? "" :  $format) . "',\n";
                }
            }
        }
        ?>
        [
        'class' => 'yii\grid\ActionColumn',
        'template'=>'{view}{update}',
        ],

        ],
        ]); ?>
    <?php else : ?>
        <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
        ]) ?>
    <?php endif; ?>
    <?= $generator->enablePjax ? "<?php Pjax::end(); ?>\n" : '' ?>
</div>