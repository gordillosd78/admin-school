<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord as CommandsMyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuota".
 *
 * @property integer $id
 * @property string $fecha
 * @property string $vencimiento
 * @property double $total
 * @property integer $alumno_id
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Alumno $alumno
 * @property User $createdBy
 * @property DetalleCuota[] $detalleCuotas
 * @property User $updatedBy
 */
class Cuota extends CommandsMyActiveRecord
{
    const ANULADA = 0;
    const ABIERTA = 10;
    const CERRADA = 20;
    const ERROR = 30;

    public static $estado = ['0' => 'Anulada', '10' => 'Abierta', '20' => 'Cerrada'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuota';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'vencimiento', 'created_at', 'updated_at'], 'safe'],
            [['total'], 'number'],
            [['alumno_id'], 'required'],
            [['alumno_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['observacion'], 'string', 'max' => 250],
            [['alumno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumno::class, 'targetAttribute' => ['alumno_id' => 'id']],
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
            'fecha' => 'Fecha',
            'vencimiento' => 'Vencimiento',
            'total' => 'Total',
            'alumno_id' => 'Alumno',
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
    public function getAlumno()
    {
        return $this->hasOne(Alumno::class, ['id' => 'alumno_id']);
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
    public function getDetalleCuotas()
    {
        return $this->hasMany(DetalleCuota::class, ['cuota_id' => 'id']);
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
     * @return \app\models\query\CuotaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CuotaQuery(get_called_class());
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
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayCuota($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }
}
