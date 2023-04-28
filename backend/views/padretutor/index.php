<?php

use app\models\PadreTutor;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PadreTutorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Padre - Tutor'; ?>

<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>

<div class="padre-tutor-index">

    <legend>
        <h1><?= FontAwesome::icon('cogs')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <p>
        <?= Html::a(FontAwesome::icon('bars') . Yii::t('app', ' Nuevo Padre-Tutor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nombre',
            'apellido',
            'domicilio',
            'localidad',
            [
                'attribute' => 'fecha_nacimiento',
                'value' => function ($model) {
                    return $model->getFecha($model->fecha_nacimiento);
                }
            ],
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->getEstado($model->estado);
                }
            ],
            // [
            //     'class' => ActionColumn::class,
            //     'urlCreator' => function ($action, PadreTutor $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //     }
            // ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'template' => '{view}{update}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>