<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FontAwesome;
use app\models\TipoEspacio;

/* @var $this yii\web\View */
/* @var $model app\models\TipoEspacio */

$this->title = ' Tipo Espacio: ' . $model->id;
?>
<?= $this->render('../site/_column2_menus', ['model' => $model, 'items' => $items]) ?>
<div class="tipo-espacio-view">
    <legend>
        <h1><?= FontAwesome::icon('eye')->border() . Html::encode($this->title) ?></h1>
    </legend>

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