<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CuotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Cuotas Mensuales';
?>

<div class="cuota-index">
    <div class="row mb-4">
        <div class="col-md-3">
            <?= $this->render('../site/_column1_menu', [
                'actionsTitle' => 'Opciones',
                'items' => $items
            ]) ?>
        </div>
        <div class="col-md-9">
            <?= $this->render('../site/_gral_search', [
                'model' => $searchModel,
                'components' => $components,
                'title' => $this->title
            ]) ?>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterModel' => false,
        'columns' => [
            [
                'attribute' => 'id',
                'header' => '#',
            ],
            [
                'attribute' => 'fecha',
                'value' => function ($model) {
                    return $model->getFecha($model->fecha);
                },
            ],
            [
                'attribute' => 'alumno_id',
                'header' => 'DNI',
                'value' => function ($model) {
                    return $model->alumno->dni;
                }

            ],
            [
                'attribute' => 'alumno_id',
                'value' => function ($model) {
                    return $model->alumno->apellido . ', ' . $model->alumno->nombre;
                }
            ],
            'vencimiento',
            'observacion',
            'total',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'header' => 'Acciones',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>