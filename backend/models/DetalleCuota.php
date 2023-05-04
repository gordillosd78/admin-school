<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "detalle_cuota".
 *
 * @property integer $id
 * @property integer $periodo
 * @property double $subtotal
 * @property integer $cantidad
 * @property double $interes
 * @property integer $cuota_id
 * @property integer $concepto_id
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Concepto $concepto
 * @property User $createdBy
 * @property Cuota $cuota
 * @property User $updatedBy
 */
class DetalleCuota extends MyActiveRecord
{

    private $_subTotal;


    // public static $periodo = [
    //     '1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo',
    //     '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio',
    //     '7' => 'Julio', '8' => 'Agosto', '9' => 'Setiembre',
    //     '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
    // ];



    /**
     * Setter del total de la linea
     */
    public function setSubTotal($value)
    {
        $this->_subTotal = empty($value) ? 0 : $value;
    }

    /**
     * Getter del total de la linea
     * Calculo del total de la linea sin descuentos
     */
    public function getSubTotal($var = null)
    {
        if ($this->isNewRecord) return null;
        if ($this->_subTotal === null)
            $this->setSubTotal(($this->concepto->monto) * $this->cantidad);
        return $this->_subTotal;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_cuota';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['interes'], 'number'],
            [['periodo', 'cantidad', 'cuota_id', 'concepto_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['cuota_id', 'concepto_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['observacion'], 'string', 'max' => 250],
            [['concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Concepto::class, 'targetAttribute' => ['concepto_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['cuota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cuota::class, 'targetAttribute' => ['cuota_id' => 'id']],
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
            'periodo' => 'Periodo',
            'cantidad' => 'Cantidad',
            'interes' => 'Interes',
            'cuota_id' => 'Cuota',
            'concepto_id' => 'Concepto',
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
    public function getConcepto()
    {
        return $this->hasOne(Concepto::class, ['id' => 'concepto_id']);
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
    public function getCuota()
    {
        return $this->hasOne(Cuota::class, ['id' => 'cuota_id']);
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
     * @return \app\models\query\DetalleCuotaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\DetalleCuotaQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayDetalleCuota($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }

    /**
     * Retorna array clave valor (mes => mes nombre)
     * @params @integer valor del indice del array
     * @return @array
     */
    public static function getMes($key = null)
    {
        if ($key !== null)
            return self::$meses[$key] . '/' . date('Y');
        return self::$meses;
    }
}
