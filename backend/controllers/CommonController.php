<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use rmrevin\yii\fontawesome\FontAwesome;

class CommonController extends Controller
{
    public $layout = 'column2';

    public $session;
    public $local_id = 'X';

    public function init()
    {
        parent::init();
        $this->session = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;
        $this->local_id = $cookies->getValue('local_id', 'X');
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'view', 'update', 'delete', 'move'],
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'update', 'delete', 'move'],
                        'allow' => true,
                        'roles' => ['admin', 'sistemas'],
                    ],
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'reset'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST']
                ]
            ]
        ];
    }

    /**
     * Genera mensajes informativos para el usuario
     * @param string $type indica que tipo de mensaje es (success, error, info, warning)
     * @param string $message mensaje que desea mostrar
     * @param bool $popup indica si es un mensaje fijo o solo un popup, default Value false
     * los mensajes success por defecto son todos popup
     */
    public function setMensaje($type, $message, $popup = false)
    {
        $session = Yii::$app->session;
        $session->set('popup', $popup); // -- Aqui todos los mensajes son fijos

        switch ($type) {
            case 'success':
                $session->setFlash(
                    'success',
                    '<strong> ' .
                        Fontawesome::icon('check-square')->border()->size(Fontawesome::SIZE_2X) . ' ' . $message
                        . '</strong> '
                );
                $session->set('popup', true); // -- establezco popups usando el parametro
                break;
            case 'error':
                $session->setFlash(
                    'error',
                    '<strong> ' .
                        Fontawesome::icon('bomb')->border()->size(Fontawesome::SIZE_2X) . ' ' . $message
                        . '</strong> '
                );
                break;
            case 'info':
                $session->setFlash(
                    'info',
                    '<strong> ' .
                        Fontawesome::icon('info-circle')->border()->size(Fontawesome::SIZE_2X) . ' ' . $message
                        . '</strong> '
                );
                break;
            case 'warning':
                $session->setFlash(
                    'warning',
                    '<strong> ' .
                        Fontawesome::icon('radiation-alt')->border()->size(Fontawesome::SIZE_2X) . ' ' . $message
                        . '</strong> '
                );
                break;
            default:
                $session->setFlash(
                    'error',
                    '<strong> ' .
                        Fontawesome::icon('bomb')->border()->size(Fontawesome::SIZE_2X) . ' ERROR AL CARGAR MENSAJE DE RETORNO'
                        . '</strong> '
                );
                break;
        }
    }

    public function getMenu($id = null)
    {
        $items[] = ['icon' => 'cog', 'name' => ' Administrar', 'url' => '{{context}}/index', 'visible' => true];
        $items[] = ['icon' => 'bars', 'name' => ' Nuevo', 'url' => '{{context}}/create', 'visible' => true];

        if (isset($id)) {
            $items[] = [
                'icon' => 'pencil',
                'name' => ' Modificar',
                'url' => '{{context}}/update',
                'id' => $id,
                'visible' => true
            ];
            $items[] = [
                'icon' => 'eye',
                'name' => ' Ver',
                'url' => '{{context}}/view',
                'id' => $id,
                'visible' => true
            ];
        }

        return $items;
    }

    public function getAdvancedMenu($items, $icon, $label, $url = NULL, $scond_item = NULL)
    {
        if ($url === NULL) {
            $items[] = [
                'label' => FontAwesome::icon($icon) . ' ' . $label,
                'items' => $scond_item
            ];
        } else {
            $items[] = [
                'label' => FontAwesome::icon($icon) . ' ' . $label,
                'url' => [$url]
            ];
        }

        return $items;
    }

    /**
     * Add a new action in the panel action menu.
     * @param string $icon, string $name, string $url optional param $simple and $id for a complex option menu
     * @param $id by default -1 just only for a complex options
     * @return $item array
     */
    public function addItems($items, $icon, $name, $url, $simple = true, $id = -1)
    {
        $items[] = [
            'icon' => $icon,
            'name' => ' ' . $name,
            'url' => strpos($url, '/') ? $url : '{{context}}/' . $url,
            'visible' => true,
            'id' => $id
        ];

        return $items;
    }

    /**
     * Ayuda a realizar un debug de las variables 
     * @param mixed value cualquier variable que desee debuguear 
     * @param boolean dump indica si quiero in var_dump o un print_r
     * @param boolean stop si quiero o no agregar un die al proceso
     * @param string mensaje previo a la variable 
     * @param string mensaje posterior a la variable
     */
    public function debugVariable($value, $dump = true, $stop = true, $messageBefore = '', $messageAfter = '')
    {
        echo strlen($messageBefore) > 0 ? '<br>' . $messageBefore . '<br>' : '';
        if ($dump)
            var_dump($value);
        else {
            echo '<pre>';
            print_r($value);
            echo '</pre>';
        }
        echo strlen($messageAfter) ? '<br>' . $messageAfter . '<br>' : '';
        if ($stop)
            die();
    }

    public function showErrors($model)
    {
        return implode(' ', array_map(function ($errors) {
            return implode(' ', $errors);
        }, $model->getErrors()));
    }
}
