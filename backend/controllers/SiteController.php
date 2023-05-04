<?php

namespace backend\controllers;

use common\models\LoginForm;
use rmrevin\yii\fontawesome\FontAwesome;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $items = array();
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (!Yii::$app->user->can('admin')) {
                Yii::$app->user->logout();
                return $this->goHome();
            } else {
                $auth = Yii::$app->authManager;
                $session = Yii::$app->session;
                $roles = $auth->getAssignments(Yii::$app->user->id);
                foreach ($roles as $value) {
                    $child = $auth->getChildren($value->roleName);
                    foreach ($child as $child_item) {
                        if (strpos($child_item->description, ","))
                            list($icono, $descripcion) = explode(",", $child_item->description);

                        //if (in_array($child_item->name, $model->sistema)) // -- Menu sistema
                        //  $DropDownSistemaItems[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                        if (in_array($child_item->name, $model->procesos)) // -- Menu procesos
                            $DropDownProcesosItems[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                        // elseif (in_array($child_item->name, $model->admin)) // -- Menu Administrar
                        //   $DropDownAdminItems[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                        // elseif (in_array($child_item->name, $model->tipos)) // -- Menu Tipos
                        //   $DropDownTiposAdmin[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                        // elseif (in_array($child_item->name, $model->articulos)) // -- Menu Articulos
                        //   $DropDownArticulos[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                        else
                            $items[] = ['label' => FontAwesome::icon($icono) . ' ' . $descripcion, 'url' => [$child_item->name . "/index"]];
                    }
                }
                if (isset($DropDownProcesosItems))
                    $items[] = $this->setMenuByArray($DropDownProcesosItems, 'database', 'Procesos');
                //if (isset($DropDownArticulos))
                //  $DropDownAdminItems[] = $this->setMenuByArray($DropDownArticulos, 'boxes', 'Articulos');
                //if (isset($DropDownTiposAdmin))
                //  $DropDownAdminItems[] = $this->setMenuByArray($DropDownTiposAdmin, 'database', 'Tipos');
                // if (isset($DropDownAdminItems))
                //   $items[] = $this->setMenuByArray($DropDownAdminItems, 'cogs', 'Administrar');
                //if (isset($DropDownSistemaItems))
                //  $items[] = $this->setMenuByArray($DropDownSistemaItems, 'bars', 'Sistema');

                if ($session->isActive) {
                    $session->set('items', $items);
                }


                return $this->goBack();
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Establece formato al array usado para los menus
     * 
     * @param array $menu array con valores previo ya cargados
     * @param string $icon icono que se utilizara
     * @param string $name nombre que se muestra en el menu
     * @return array
     */
    public function setMenuByArray($array, $icon, $name)
    {
        return [
            'label' => FontAwesome::icon($icon) . ' ' . $name,
            'items' => $array
        ];
    }
}
