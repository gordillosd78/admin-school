<?php

namespace app\models;

use app\models\query\PadreTutorQuery;
use common\models\MyActiveRecord;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "padre_tutor".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $dni
 * @property string|null $domicilio
 * @property string|null $localidad
 * @property string|null $fecha_nacimiento
 * @property string|null $observacion
 * @property int|null $estado
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $parentesco_id
 * @property int $tipo_empleado_id
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Parentesco $parentesco_id
 * @property TipoEmpleado $tipo_empleado_id
 * 
 * 
 */
class PadreTutor extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'padre_tutor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'dni', 'tipo_empleado_id', 'parentesco_id'], 'required'],
            [['dni', 'tipo_empleado_id', 'parentesco_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 35],
            [['apellido', 'domicilio', 'localidad'], 'string', 'max' => 25],
            [['observacion'], 'string', 'max' => 250],
            [['dni'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['parentesco_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parentesco::class, 'targetAttribute' => ['parentesco_id' => 'id']],
            [['tipo_empleado_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEmpleado::class, 'targetAttribute' => ['tipo_empleado_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'dni' => 'Dni',
            'domicilio' => 'Domicilio',
            'localidad' => 'Localidad',
            'tipo_empleado_id' => 'Ocupacion',
            'parentesco_id' => 'Parentesco',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'telefono' => 'Telefono',
            'email' => 'Email',
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
    public function getParentesco()
    {
        return $this->hasOne(Parentesco::class, ['id' => 'parentesco_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEmpleado()
    {
        return $this->hasOne(TipoEmpleado::class, ['id' => 'tipo_empleado_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\PadreTutorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\PadreTutorQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayPadreTutor($order = 'nombre')
    {
        return ArrayHelper::map(self::find()->orderBy($order)->active()->asArray()->all(), 'id', 'nombre');
    }

    /**
     * @inheritdoc
     * Retorna un array clave valor (id => nombre)
     * @params @string indicando el criterio de ordenamiento del array por defecto campo nombre
     * @return @Array.
     */
    public static function getArrayNombreApellidoTutor($order = 'nombre')
    {
        $query = self::find();
        $query->select(['id', 'apellido', 'nombre']);

        return ArrayHelper::map($query->active()->asArray()->all(), 'id', 'nombre', 'apellido');
    }
}
