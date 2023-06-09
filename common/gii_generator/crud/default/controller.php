<?php

/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;
use yii\filters\AccessControl;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace backend\controllers;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)) : ?>
    use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else : ?>
    use yii\data\ActiveDataProvider;
<?php endif; ?>
use backend\controllers\CommonController;
use yii\web\NotFoundHttpException;

/**
* <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
*/
class <?= $controllerClass ?> extends <?= StringHelper::basename('CommonController') . "\n" ?>
{
public $layout = 'column2';

public function actionIndex()
{
<?php if (!empty($generator->searchModelClass)) : ?>
    $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'items' => $this->getMenu()
    ]);
<?php else : ?>
    $dataProvider = new ActiveDataProvider([
    'query' => <?= $modelClass ?>::find(),
    ]);

    return $this->render('index', [
    'dataProvider' => $dataProvider,
    ]);
<?php endif; ?>
}

/**
* Displays a single <?= $modelClass ?> model.
* <?= implode("\n     * ", $actionParamComments) . "\n" ?>
* @return mixed
*/
public function actionView(<?= $actionParams ?>)
{
return $this->render('view', [
'model' => $this->findModel(<?= $actionParams ?>),
'items' => $this->getMenu()
]);
}

/**
* Creates a new <?= $modelClass ?> model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new <?= $modelClass ?>();

if($this->request->isPost){
if ($model->load(Yii::$app->request->post()) && $model->save()) {
return $this->redirect(['view', <?= $urlParams ?>]);
$this->setMensaje('success', "Generado con Exito.");
}
}
else
{
$model->loadDefaultValues();
}

return $this->render('create', [
'model' => $model,
'items' => $this->getMenu()
]);
}

/**
* Updates an existing <?= $modelClass ?> model.
* If update is successful, the browser will be redirected to the 'view' page.
* <?= implode("\n     * ", $actionParamComments) . "\n" ?>
* @return mixed
*/
public function actionUpdate(<?= $actionParams ?>)
{
$model = $this->findModel(<?= $actionParams ?>);

if ($this->request->isPost && $model->load($this->request->post())) {
if ($model->save())
$this->setMensaje('success', "Modificado con éxito!!!");
else
$this->setMensaje('error', "Error al modificar!!!");
return $this->redirect(['view', <?= $urlParams ?>]);
}

return $this->render('update', [
'model' => $model,
'items' => $this->getMenu()
]);
}

/**
* Deletes an existing <?= $modelClass ?> model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* <?= implode("\n     * ", $actionParamComments) . "\n" ?>
* @return mixed
*/
public function actionDelete(<?= $actionParams ?>)
{
$model = $this->findModel($id);
if ($model->estado)
$model->estado = <?= $modelClass ?>::STATUS_INACTIVE;
else
$model->estado = <?= $modelClass ?>::STATUS_ACTIVE;

if ($model->save())
$this->setMensaje('success', "Modificado con Exito.");
else
$this->setMensaje('error', 'Error al tratar de completar la operacion');
return $this->redirect(['index']);
}

/**
* Finds the <?= $modelClass ?> model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* <?= implode("\n     * ", $actionParamComments) . "\n" ?>
* @return <?= $modelClass ?> the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel(<?= $actionParams ?>)
{
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
return $model;
} else {
throw new NotFoundHttpException('El registro requerido no existe.');
}
}
}