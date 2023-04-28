<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Turno]].
*
* @see \app\models\Turno
*/
class TurnoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Turno[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Turno|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}