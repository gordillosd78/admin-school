<?php

namespace app\models;

use common\models\MyActiveRecord;
use common\models\User;
use Yii;

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
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
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
            [['nombre', 'apellido', 'dni'], 'required'],
            [['dni', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 35],
            [['apellido', 'domicilio', 'localidad'], 'string', 'max' => 25],
            [['observacion'], 'string', 'max' => 250],
            [['dni'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
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
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
}
