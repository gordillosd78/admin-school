<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "espacio".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $capacidad
 * @property integer $tipo_espacio_id
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property Curso[] $cursos
 * @property TipoEspacio $tipoEspacio
 * @property User $updatedBy
 */
class Espacio extends MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'espacio';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_espacio_id'], 'required'],
            [['capacidad', 'tipo_espacio_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 50],
            [['observacion'], 'string', 'max' => 250],
            [['nombre'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['tipo_espacio_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEspacio::class, 'targetAttribute' => ['tipo_espacio_id' => 'id']],
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
            'descripcion' => 'Descripcion',
            'capacidad' => 'Capacidad',
            'tipo_espacio_id' => 'Tipo Espacio',
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
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['espacio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEspacio()
    {
        return $this->hasOne(TipoEspacio::class, ['id' => 'tipo_espacio_id']);
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
     * @return \app\models\query\EspacioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EspacioQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayEspacio($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }
}
