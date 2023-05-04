<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CuotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Cuotas Mensuales';
?>

<div class="cuota-index">
    <div class="d-flex justify-content-between w-100">
        <?= $this->render('../site/_column1_menu', [
            'actionsTitle' => 'Opciones',
            'items' => $items
        ]) ?>

        <?= $this->render('../site/_gral_search', [
            'model' => $searchModel,
            'components' => $components,
            'title' => $this->title
        ]) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'header' => '#',
            ],
            'fecha',
            'vencimiento',
            'total',

            // 'observacion',
            [
                'attribute' => 'alumno_id',
                'value' => function ($model) {
                    return $model->alumno->apellido . ', ' . $model->alumno->nombre;
                }
            ],
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>