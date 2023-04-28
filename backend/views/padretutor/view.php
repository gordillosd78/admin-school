<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use rmrevin\yii\fontawesome\FontAwesome;

/** @var yii\web\View $this */
/** @var app\models\PadreTutor $model */

$this->title = 'Padre-Tutor #' . $model->id;


\yii\web\YiiAsset::register($this);
?>
<?= $this->render('../site/_column2_menus', ['items' => $items]) ?>
<div class="padre-tutor-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(FontAwesome::icon('pencil') . ' Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(FontAwesome::icon('trash') . ' Desactivar / Activar', ['delete', 'id' => $model->id], [
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
                'domicilio',
                'localidad',
                'fecha_nacimiento',
                // [
                //     'attribute' => 'fecha_nacimiento',
                //     'value' => $model->getFecha($model->fecha_nacimiento)
                // ],
                'observacion',
                [
                    'attribute' => 'estado',
                    'value' => $model->getestado($model->estado)
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