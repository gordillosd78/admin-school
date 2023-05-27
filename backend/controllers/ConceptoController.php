<?php

namespace backend\controllers;

use Yii;
use app\models\Concepto;
use app\models\Cuota;
use app\models\search\ConceptoSearch;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * ConceptoController implements the CRUD actions for Concepto model.
 */
class ConceptoController extends CommonController
{
    public $layout = 'column2';

    public function actionIndex()
    {
        $searchModel = new ConceptoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Displays a single Concepto model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Creates a new Concepto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Concepto();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Concepto model.
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
     * Deletes an existing Concepto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = Concepto::STATUS_INACTIVE;
        else
            $model->estado = Concepto::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Concepto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Concepto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Concepto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }


    public function actionListperiodo($conceptoId)
    {
        if ($conceptoId === Concepto::CUOTA) {
            $meses = Cuota::$meses;
            // echo "<option value = '1'>No Definido</option>";
            if (count($meses) > 0) {
                foreach ($meses as $key => $value) {

                    echo "<option value = '" . $key . "'>" . $value . "</option>";
                }
            }
        } elseif ($conceptoId === Concepto::SEGURO_ESCOLAR || $conceptoId === Concepto::MATRICULA) {
            echo "<option value = '" . Concepto::PAGO_UNICO . "'>Pago Unico</option>";
        }
    }
}
