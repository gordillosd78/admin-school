<?php

use app\models\PadreTutor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PadreTutorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Padre - Tutor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="padre-tutor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Padre-Tutor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nombre',
            'apellido',
            'dni',
            'domicilio',
            'localidad',
            [
                'attribute' => 'fecha_nacimiento',
                'value' => function ($model) {
                    return $model->getFecha($model->fecha_nacimiento);
                }
            ],
            'observacion',
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return $model->getEstado($model->estado);
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, PadreTutor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>