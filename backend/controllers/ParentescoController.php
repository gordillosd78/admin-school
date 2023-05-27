<?php

namespace backend\controllers;

use Yii;
use app\models\Parentesco;
use app\models\search\ParentescoSearch;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * ParentescoController implements the CRUD actions for Parentesco model.
 */
class ParentescoController extends CommonController
{
    public $layout = 'column2';

    public function actionIndex()
    {
        $searchModel = new ParentescoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Displays a single Parentesco model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->created_at  = $model->getFecha($model->created_at);
        $model->updated_at  = $model->getFecha($model->updated_at);
        return $this->render('view', [
            'model' => $model,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Creates a new Parentesco model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parentesco();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                $this->setMensaje('success', "Generado con Exito.");
            }
        } else {
            $listaEstados = $model->getEstado();
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaEstados' => $listaEstados,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Updates an existing Parentesco model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listaEstados = $model->getEstado();

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
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Deletes an existing Parentesco model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = Parentesco::STATUS_INACTIVE;
        else
            $model->estado = Parentesco::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Parentesco model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Parentesco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parentesco::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
