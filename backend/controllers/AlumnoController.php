<?php

namespace backend\controllers;

use Yii;
use app\models\Alumno;
use app\models\Carrera;
use app\models\PadreTutor;
use app\models\search\AlumnoSearch;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * AlumnoController implements the CRUD actions for Alumno model.
 */
class AlumnoController extends CommonController
{
    public $layout = 'column2';

    public function actionIndex()
    {
        $searchModel = new AlumnoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $items = $this->addItems($this->getMenu(), 'barcode', 'Cuota', 'cuota/index');


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => $items
        ]);
    }

    /**
     * Displays a single Alumno model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->fecha_nacimiento = $model->getFecha($model->fecha_nacimiento);
        $model->created_at = $model->getFecha($model->created_at);
        $model->updated_at = $model->getFecha($model->updated_at);

        return $this->render('view', [
            'model' => $model,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Creates a new Alumno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $items = $this->addItems($this->getMenu(), 'barcode', 'Padre-Tutor', 'padretutor/index');

        $model = new Alumno();
        $apellidosNombres = PadreTutor::getArrayNombreApellidoTutor();
        $listaPadreTutor = [];
        foreach ($apellidosNombres as $apellido => $apellidoNombre) {
            foreach ($apellidoNombre as $key => $nombre) {
                $listaPadreTutor[$key] = $apellido . ' ' . $nombre;
            }
        }
        $listaCarrera = Carrera::getArrayCarrera();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->fecha_nacimiento = $model->setFecha($model->fecha_nacimiento);
                if ($model->save()) {
                    $this->setMensaje('success', "Generado con Exito.");
                } else
                    $this->setMensaje('error', "No se pudo crear el Alumno!!!");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaCarrera' => $listaCarrera,
            'listaPadreTutor' => $listaPadreTutor,
            'items' => $items
        ]);
    }

    /**
     * Updates an existing Alumno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $apellidosNombres = PadreTutor::getArrayNombreApellidoTutor();
        $listaPadreTutor = [];
        foreach ($apellidosNombres as $apellido => $apellidoNombre) {
            foreach ($apellidoNombre as $key => $nombre) {
                $listaPadreTutor[$key] = $apellido . ' ' . $nombre;
            }
        }
        $listaCarrera = Carrera::getArrayCarrera();

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                $this->setMensaje('success', "Modificado con éxito!!!");
            else
                $this->setMensaje('error', "Error al modificar!!!");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listaCarrera' => $listaCarrera,
            'listaPadreTutor' => $listaPadreTutor,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Deletes an existing Alumno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = Alumno::STATUS_INACTIVE;
        else
            $model->estado = Alumno::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Alumno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Alumno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
