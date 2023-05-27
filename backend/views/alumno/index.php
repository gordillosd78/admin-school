<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AlumnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ' Administrar Alumno';
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="alumno-index">

    <legend>
        <h1><?= FontAwesome::icon('cogs')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <p>
        <?= Html::a(FontAwesome::icon('bars') . ' Nuevo Alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'nombre',
            'apellido',
            'dni',
            'domicilio',
            'localidad',
            'email',
            // 'foto',
            // 'carrera_id',
            [
                'attribute' => 'padre_tutor_id',
                'value' => function ($model) {
                    return $model->padreTutor->apellido . ' ' . $model->padreTutor->nombre;
                }
            ],
            // 'observacion',
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