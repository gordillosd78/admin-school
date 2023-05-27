<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "concepto".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $periodo
 * @property double $monto
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Concepto extends MyActiveRecord
{
    const MATRICULA = '2';
    const CUOTA = '3';
    const SEGURO_ESCOLAR = '4';
    const PAGO_UNICO = '13';

    public static $periodoPago = array('1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre', '13' => 'Pago Unico');
    public static $periodo = array('1' => 'No Definido', '2' => 'Mensual', '3' => 'Pago Unico');

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'concepto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto'], 'number'],
            [['estado', 'periodo', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['observacion'], 'string', 'max' => 250],
            [['nombre'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /** 
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'periodo' => 'Periodo',
            'monto' => 'Monto',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ConceptoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ConceptoQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayConcepto($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }

    public static function getArrayPeriodo($key = null)
    {
        if ($key !== null)
            return self::$periodo[$key];
        return self::$periodo;
    }
}
