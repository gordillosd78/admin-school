<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FontAwesome;
use app\models\Espacio;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EspacioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Espacio';
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="espacio-index">

    <legend>
        <h1><?= FontAwesome::icon('cogs')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <p>
        <?= Html::a(FontAwesome::icon('bars') . ' Nuevo Espacio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'nombre',
            'descripcion',
            'capacidad',
            [
                'attribute' => 'tipo_espacio_id',
                'value' => function ($model) {
                    return $model->tipoEspacio->nombre;
                }
            ],
            'observacion',
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->getEstado($model->estado);
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