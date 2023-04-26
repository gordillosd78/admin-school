<?php

namespace backend\controllers;

use app\models\PadreTutor;
use app\models\search\PadreTutorSearch;
use backend\controllers\CommonController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PadretutorController implements the CRUD actions for PadreTutor model.
 */
class PadretutorController extends CommonController
{
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

    /**
     * Lists all PadreTutor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PadreTutorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PadreTutor model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->fecha_nacimiento = $model->getFecha($model->fecha_nacimiento);
        $model->created_at = $model->getFecha($model->created_at);
        $model->updated_at = $model->getFecha($model->updated_at);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new PadreTutor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PadreTutor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fecha_nacimiento = $model->setFecha($model->fecha_nacimiento);
                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $listaEstados = PadreTutor::getEstado();
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaEstados' => $listaEstados
        ]);
    }

    /**
     * Updates an existing PadreTutor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listaEstados = PadreTutor::getEstado();
        $model->fecha_nacimiento = $model->setFecha($model->fecha_nacimiento);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                $this->setMensaje('success', "Modificado con éxito!!!");
            else
                $this->setMensaje('error', "Error al modificar!!!");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listaEstados' => $listaEstados
        ]);
    }

    /**
     * Deletes an existing PadreTutor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = PadreTutor::STATUS_INACTIVE;
        else
            $model->estado = PadreTutor::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Borrado con éxito!!!");
        else
            $this->setMensaje('error', "Error al borrar!!!");

        return $this->redirect(['index']);
    }

    /**
     * Finds the PadreTutor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PadreTutor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PadreTutor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
