<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class MyActiveRecord extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const ID_NO_DEFINIDO = 1;

    public static $estado = array('0' => 'Inactivo', '1' => 'Activo');
    public static $meses = array('1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
        ];
    }

    /**
     * Retorna array clave valor (estado => descripcion)
     * @params @integer valor del indice del array
     * @return @array
     */
    public static function getEstado($key = null)
    {
        if ($key !== null)
            return self::$estado[$key];
        return self::$estado;
    }

    /**
     * Retorna array clave valor (mes => mes nombre)
     * @params @integer valor del indice del array
     * @return @array
     */
    public static function getMes($key = null)
    {
        if ($key !== null)
            return self::$meses[$key];
        return self::$meses;
    }

    /**
     * Set de fecha para ser ingresado en la base de datos
     * @param fecha by default NULL que se desea convertir al formato Y-m-d
     * @param format by default 'date' si este valor es distinto al que esta por default se le agrega H:m:s 
     * @return string 
     */
    public function setFecha($fecha = null, $format = 'date')
    {
        if ($format != 'date') {
            return ($fecha !== null) ? Yii::$app->formatter->asDate($fecha, 'php:Y-m-d') : date('Y-m-d H:m:s');
        } else {
            return ($fecha !== null) ? Yii::$app->formatter->asDate($fecha, 'php:Y-m-d') : date('Y-m-d');
        }
    }

    /**
     * Get de fecha para cambiar la fecha que viene de la base de datos
     * @param fecha by default NULL que se desea convertir al formato Y-m-d
     * @param format by default 'date' si este valor es distinto al que esta por default se le agrega H:m:s 
     * @return string 
     */
    public function getFecha($fecha = null, $format = 'date')
    {
        if ($format != 'date') {
            return ($fecha !== null) ? Yii::$app->formatter->asDate($fecha, 'php:d-m-Y H:m:s') : date('d-m-Y H:m:s');
        } else {
            return ($fecha !== null) ? Yii::$app->formatter->asDate($fecha, 'php:d-m-Y') : date('d-m-Y');
        }
    }

    public function getCurrency($value)
    {
        return '$ ' . Yii::$app->formatter->asDecimal($value);
    }

    public static function getCookieCuenta()
    {
        $session = Yii::$app->session;
        if ($session->has('cuenta') && $session->get('cuenta') > 0)
            return $session->get('cuenta');
        else {
            $session = Yii::$app->session;
            if ($session->has('menu'))
                $session->remove('menu');
            $session->destroy();
            throw new NotFoundHttpException('Sesion expirada. Identifíquese nuevamente');
        }
    }
}
