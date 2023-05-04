<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Carrera]].
*
* @see \app\models\Carrera
*/
class CarreraQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Carrera[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Carrera|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}