<?php

use app\models\Cuota;
use yii\helpers\Html;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DetalleCuotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Detalle Cuota';
?>
<div class="detalle-cuota-index mt-3">
    <?php
    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'pageSummary' => 'Totales',
            'pageSummaryOptions' => ['colspan' => 2],
        ],
        [
            'attribute' => 'cantidad',
            'vAlign' => 'middle',
            'hAlign' => 'middle',
        ],
        [
            'attribute' => 'concepto_id',
            'value' => function ($model) {
                return $model->concepto->nombre;
            },
            'vAlign' => 'middle',
            'hAlign' => 'middle',
        ],
        [
            'attribute' => 'periodo',
            'value' => function ($model) {
                return $model->getMes($model->periodo);
            },
            'vAlign' => 'middle',
            'hAlign' => 'middle',
        ],
        [
            'attribute' => 'monto',
            'value' => function ($model) {
                return $model->concepto->monto;
            },
            'vAlign' => 'middle',
            'hAlign' => 'right',
        ],
        [
            'attribute' => 'subtotal',
            'value' => function ($model) {
                return $model->subTotal;
            },
            'vAlign' => 'middle',
            'hAlign' => 'right',
        ],
        [
            'attribute' => 'observacion',
            'vAlign' => 'middle',
            'hAlign' => 'middle',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model, $key) {
                    if ($model->cuota->estado === Cuota::ABIERTA)
                        return Html::a(
                            FontAwesome::icon('trash')->size(FontAwesome::SIZE_LARGE),
                            ['delete', 'id' => $model->id],
                            [
                                'title' => 'Eliminar Concepto',
                                'data-method' => 'post',
                                'data-confirm' => 'Seguro que desea eliminar este concepto?'
                            ]
                        );
                }
            ],
        ],
    ];
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>