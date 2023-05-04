<?php

namespace app\models;

use Yii;
use common\models\MyActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "alumno".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property integer $dni
 * @property date $fecha_nacimiento 
 * @property string $domicilio
 * @property string $localidad
 * @property string $email
 * @property string $foto
 * @property integer $carrera_id
 * @property integer $padre_tutor_id
 * @property string $observacion
 * @property integer $estado
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Carrera $carrera
 * @property User $createdBy
 * @property PadreTutor $padreTutor
 * @property User $updatedBy
 */
class Alumno extends MyActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alumno';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dni', 'carrera_id', 'padre_tutor_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['dni', 'nombre', 'apellido', 'carrera_id', 'padre_tutor_id'], 'required'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 60],
            [['apellido', 'foto'], 'string', 'max' => 50],
            [['domicilio', 'localidad'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 40],
            ['email', 'email'],
            [['observacion'], 'string', 'max' => 250],
            [['dni', 'email'], 'unique'],
            [['carrera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::class, 'targetAttribute' => ['carrera_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['padre_tutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => PadreTutor::class, 'targetAttribute' => ['padre_tutor_id' => 'id']],
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
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'domicilio' => 'Domicilio',
            'localidad' => 'Localidad',
            'email' => 'Email',
            'foto' => 'Foto',
            'carrera_id' => 'Carrera',
            'padre_tutor_id' => 'Tutor',
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
    public function getCarrera()
    {
        return $this->hasOne(Carrera::class, ['id' => 'carrera_id']);
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
    public function getPadreTutor()
    {
        return $this->hasOne(PadreTutor::class, ['id' => 'padre_tutor_id']);
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
     * @return \app\models\query\AlumnoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AlumnoQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayAlumno($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }
}
