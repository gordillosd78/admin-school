<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_empleado".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Empleado[] $empleados
 * @property PadreTutor[] $padreTutors
 * @property User $createdBy
 * @property User $updatedBy
 */
class TipoEmpleado extends MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['estado', 'created_by', 'updated_by'], 'integer'],
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
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::class, ['tipo_empleado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadreTutors()
    {
        return $this->hasMany(PadreTutor::class, ['tipo_empleado_id' => 'id']);
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
     * @return \app\models\query\TipoEmpleadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TipoEmpleadoQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayTipoEmpleado($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }
}
