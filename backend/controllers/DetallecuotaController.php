<?php

namespace backend\controllers;

use app\models\Concepto;
use app\models\Cuota;
use Yii;
use app\models\DetalleCuota;
use app\models\search\DetalleCuotaSearch;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * DetallecuotaController implements the CRUD actions for DetalleCuota model.
 */
class DetallecuotaController extends CommonController
{
    public $layout = 'column2';

    public function actionIndex()
    {
        $searchModel = new DetalleCuotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Displays a single DetalleCuota model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($cuota_id)
    {
        $this->layout = 'column1';
        $model = new DetalleCuota();
        $model->cuota_id = $cuota_id;
        $searchModel = new DetalleCuotaSearch();
        $searchModel->cuota_id = $cuota_id;
        $dataProvider = $searchModel->search();
        $listadoConceptos = Concepto::getArrayConcepto();
        $listadoPeriodos = $model->getMes();
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'listadoConceptos' => $listadoConceptos,
            'listadoPeriodos' => $listadoPeriodos,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Creates a new DetalleCuota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuota_id)
    {
        $model = new DetalleCuota();
        $model->cuota_id = $cuota_id;

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'cuota_id' => $model->cuota_id,]);
                $this->setMensaje('success', "Generado con Exito.");
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Updates an existing DetalleCuota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                $this->setMensaje('success', "Modificado con éxito!!!");
            else
                $this->setMensaje('error', "Error al modificar!!!");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Deletes an existing DetalleCuota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $cuota_id = $model->cuota_id;
        if ($model->cuota->estado === Cuota::ABIERTA) {
            $model->delete();
            $this->setMensaje('success', "Se quito la linea con Exito.");
        } else
            $this->setMensaje('error', 'La cuota esta cerrada y no puede ser modificada!!!');

        return $this->redirect(['detallecuota/view', 'cuota_id' => $cuota_id]);
    }

    /**
     * Finds the DetalleCuota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return DetalleCuota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetalleCuota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
