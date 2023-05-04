<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * This is the model class for table "docente".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property integer $dni
 * @property string $fecha_nacimiento
 * @property string $domicilio
 * @property string $email
 * @property integer $telefono
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
class Docente extends MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docente';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'dni', 'email', 'telefono'], 'required'],
            [['dni', 'telefono', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['nombre', 'email'], 'string', 'max' => 50],
            [['apellido', 'domicilio'], 'string', 'max' => 25],
            [['observacion'], 'string', 'max' => 250],
            [['dni'], 'unique'],
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
            'apellido' => 'Apellido',
            'dni' => 'Dni',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'domicilio' => 'Domicilio',
            'email' => 'Email',
            'telefono' => 'Telefono',
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
     * @return \app\models\query\DocenteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\DocenteQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayDocente($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }
}
