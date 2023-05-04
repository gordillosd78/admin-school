<?php

namespace backend\controllers;

use app\models\Alumno;
use Yii;
use app\models\Cuota;
use app\models\search\CuotaSearch;
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
 * CuotaController implements the CRUD actions for Cuota model.
 */
class CuotaController extends CommonController
{
    public $layout = 'column2';
    private $items = [];

    public function actionIndex()
    {
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = 'column1';
        $searchModel = new CuotaSearch();
        $request = Yii::$app->request;

        $components[] = ['type' => 'date', 'htmlClass' => 'w-25', 'name' => 'fechaDesde', 'placeholder' => 'Fecha Desde'];
        $components[] = ['type' => 'date', 'htmlClass' => 'w-25', 'name' => 'fechaHasta', 'placeholder' => 'Fecha Hasta'];
        $components[] = ['type' => 'select2', 'htmlClass' => 'w-25', 'name' => 'estado', 'placeholder' => 'Seleccione Estado', 'list' => Cuota::getEstado()];
        $components[] = ['type' => 'number', 'htmlClass' => 'col-md-2', 'name' => 'rows', 'placeholder' => 'Registros', 'min' => '0', 'max' => '80'];

        if ($request->post())
            $this->session->set('CuotaSearch', $request->post('CuotaSearch'));

        if ($this->session->get('CuotaSearch')) {
            $searchModel->fechaDesde = $this->session->get('CuotaSearch')['fechaDesde'];
            $searchModel->fechaHasta = $this->session->get('CuotaSearch')['fechaHasta'];
            $searchModel->estado = $this->session->get('CuotaSearch')['estado'];
            $searchModel->rows = $this->session->get('CuotaSearch')['rows'];
        }

        $dataProvider = $searchModel->search();

        $this->items = $this->getAdvancedMenu($this->items, 'tasks', 'Cuota', 'cuota/index');
        //$this->items = $this->getAdvancedMenu($this->items, 'copyright', 'Compras', 'compra/index');
        //$this->items = $this->getAdvancedMenu($this->items, 'bars', 'Procesar', 'procesoreceta/index');
        //$this->items = $this->getAdvancedMenu($this->items, 'retweet', 'Movimientos', 'movimiento/index')

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'components' => $components,
            'items' => $this->items
        ]);
    }

    /**
     * Displays a single Cuota model.
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
     * Creates a new Cuota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cuota();
        $listaAlumnos = Alumno::getArrayAlumno();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->fecha = $model->setFecha($model->fecha);
                $model->estado = Cuota::ABIERTA;
                if ($model->save()) {
                    $this->setMensaje('success', "Generado con Exito. Debe cargar el detalle!!!");
                    return $this->redirect(['detallecuota/view', 'cuota_id' => $model->id, 'alumno_id' => $model->alumno_id]);
                } else
                    $this->setMensaje('error', 'Error al intentar crear Cuota.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'listaAlumnos' => $listaAlumnos,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Updates an existing Cuota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $listaAlumnos = Alumno::getArrayAlumno();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->estado === Cuota::ABIERTA) {
            if ($model->save()) {
                $this->setMensaje('success', "Modificado con éxito!!!");
                return $this->redirect(['detallecuota/view', 'cuota_id' => $model->id, 'alumno_id' => $model->alumno_id]);
            } else
                $this->setMensaje('error', "Error al modificar!!!");
        }

        return $this->render('update', [
            'model' => $model,
            'listaAlumnos' => $listaAlumnos,
            'items' => $this->getMenu()
        ]);
    }

    /**
     * Deletes an existing Cuota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->estado)
            $model->estado = Cuota::STATUS_INACTIVE;
        else
            $model->estado = Cuota::STATUS_ACTIVE;

        if ($model->save())
            $this->setMensaje('success', "Modificado con Exito.");
        else
            $this->setMensaje('error', 'Error al tratar de completar la operacion');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cuota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cuota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cuota::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El registro requerido no existe.');
        }
    }
}
