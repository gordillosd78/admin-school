<?php

namespace backend\controllers;

use Yii;
use app\models\Espacio;
use app\models\search\EspacioSearch;
use app\models\TipoEspacio;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * EspacioController implements the CRUD actions for Espacio model.
 */
class EspacioController extends CommonController
{
    public $layout = 'column2';

    public function actionIndex()
    {
        $searchModel = new EspacioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Displays a single Espacio model.
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
     * Creates a new Espacio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Espacio();
        $listaTipoEspacio = TipoEspacio::getArrayTipoEspacio();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
            $this->setMensaje('success', "Generado con Exito.");
        } else {
            $listaEstados = Espacio::getEstado();
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaEstados' => $listaEstados,
            'listaTipoEspacio' => $listaTipoEspacio,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Updates an existing Espacio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listaEstados = Espacio::getEstado();
        $listaTipoEspacio = TipoEspacio::getArrayTipoEspacio();


        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                $this->setMensaje('success', "Modificado con éxito!!!");
            else
                $this->setMensaje('error', "Error al modificar!!!");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listaEstados' => $listaEstados,
            'listaTipoEspacio' => $listaTipoEspacio,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Deletes an existing Espacio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = Espacio::STATUS_INACTIVE;
        else
            $model->estado = Espacio::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Espacio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Espacio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Espacio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
