<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Alumno */

$this->title = ' Alumno: ' . $model->id;
?>
<?= $this->render('../site/_column2_menus', ['model' => $model, 'items' => $items]) ?>
<div class="alumno-view">
    <legend>
        <h1><?= FAS::icon('eye')->border() . Html::encode($this->title) ?></h1>
    </legend>

    <p>
        <?= Html::a(FAS::icon('pencil') . ' Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(FAS::icon('trash') . ' Desactivar / Activar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea modificar el estado de este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="col-md-8 col-md-offset-2 well">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nombre',
                'apellido',
                'dni',
                'fecha_nacimiento',
                'domicilio',
                'localidad',
                'email',
                'foto',
                [
                    'attribute' => 'padre_tutor_id',
                    'value' => function ($model) {
                        return $model->padreTutor->apellido . ' ' . $model->padreTutor->nombre;
                    }
                ],

                [
                    'attribute' => 'carrera_id',
                    'value' => function ($model) {
                        return $model->carrera->nombre;
                    }
                ],
                'observacion',
                [
                    'attribute' => 'estado',
                    'value' => $model->getEstado($model->estado),

                ],
                'created_at',
                'updated_at',
                [
                    'attribute' => 'created_by',
                    'value' => ($model->created_by) ? $model->createdBy->username : ''
                ],
                [
                    'attribute' => 'updated_by',
                    'value' => ($model->updated_by) ? $model->updatedBy->username : ''
                ],
            ],
        ]) ?>
    </div>
</div>