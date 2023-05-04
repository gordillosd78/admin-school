<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Carrera';
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="carrera-index">

    <legend>
        <h1><?= FontAwesome::icon('cogs')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <p>
        <?= Html::a(FontAwesome::icon('bars') . ' Nuevo Carrera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'nombre',
            'descripcion',
            'resolucion',
            'duracion',
            // 'estado',
            // 'observacion',
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