<?php

namespace backend\controllers;

use Yii;
use app\models\TipoEspacio;
use app\models\search\TipoEspacioSearch;
use backend\controllers\CommonController;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * TipoespacioController implements the CRUD actions for TipoEspacio model.
 */
class TipoespacioController extends CommonController
{
    public $layout = 'column2';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new TipoEspacioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Displays a single TipoEspacio model.
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
     * Creates a new TipoEspacio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoEspacio();
        //$this->debugVariable($model->load($this->request->post()));

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                $this->setMensaje('success', "Generado con Exito.");
            }
        } else {
            $listaEstados = TipoEspacio::getEstado();
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaEstados' => $listaEstados,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Updates an existing TipoEspacio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listaEstados = TipoEspacio::getEstado();

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
     * Deletes an existing TipoEspacio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = TipoEspacio::STATUS_INACTIVE;
        else
            $model->estado = TipoEspacio::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoEspacio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TipoEspacio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoEspacio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
