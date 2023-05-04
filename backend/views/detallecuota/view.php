<?php

use app\models\Cuota;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FontAwesome;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleCuota */

$this->title = ' Detalle de Cuota Nro: ' . $model->cuota_id; ?>
<div class="detalle-cuota-view">

    <fieldset class='bg-light p-4 border border-radius rounded-3 mb-2 '>
        <legend class="text-primary d-flex justify-content-between align-items-end">
            <h3><?= FontAwesome::icon('eye')->border() . Html::encode($this->title) ?></h3>
            <h4><?= Html::encode('Fecha: ' . $model->getFecha($model->cuota->fecha)); ?></h4>
        </legend>
        <hr>
        <div class="d-flex justify-content-between">
            <h4 class="me-5">Alumno: <span class="text-danger"> <?= Html::encode($model->cuota->alumno->apellido . ', ' . $model->cuota->alumno->nombre); ?></span></h4>
            <h4 class="me-5"><?= Html::encode('Dni: ' . $model->cuota->alumno->dni); ?></h4>
            <h4 class="me-5"><?= Html::encode('Padre/Tutor: ' . $model->cuota->alumno->padreTutor->apellido . ', ' . $model->cuota->alumno->padreTutor->nombre); ?></h4>
        </div>
        <div class="d-flex justify-content-start align-items-baseline">
            <h4 class="me-5"><?= Html::encode('Responsable de Cobro: ' . $model->cuota->createdBy->username); ?></h4>
            <div class="detalle-cuota-estado">
                Estado: <span class="ms-2 badge rounded-pill bg-info"><?= Html::encode(Cuota::getEstado($model->cuota->estado)) ?></span>
            </div>
        </div>
    </fieldset>

    <div class="row">
        <?= $this->render('_form', [
            'model' => $model,
            'listadoConceptos' => $listadoConceptos,
            'listadoPeriodos' => $listadoPeriodos
        ]) ?>
    </div>

    <div class="row">
        <?= $this->render('index', [
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>

    <div class="row">
        <div class="w-100 d-flex flex-column align-items-center">

            <div class="d-flex flex-column justify-content-evenly align-items-center w-50">
                <?= Html::a(
                    FontAwesome::icon('lock') . ' Confirmar Cuota',
                    ['cuota/view', 'id' => $model->cuota_id],
                    [
                        'class' => 'btn btn-success btn-lg btn-block w-50',
                        'title' => 'Confirmar Cuota',
                        'data-method' => 'post',
                        'data-confirm' => 'Esta por confirmar la cuota. desea Continuar?'
                    ]
                ) ?>
                <?= Html::a(
                    FontAwesome::icon('window-close') . ' Anular Cuota',
                    ['cuota/move', 'id' => $model->cuota_id, 'status' => Cuota::ANULADA],
                    [
                        'class' => 'btn btn-danger btn-lg btn-block w-50 mt-2',
                        'title' => 'Anular Cuota',
                        'data-method' => 'post',
                        'data-confirm' => 'Se Borrara la cuota, Desea Continuar?'
                    ]
                ) ?>
            </div>
        </div>
    </div>

</div>