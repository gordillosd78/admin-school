<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Cuota]].
*
* @see \app\models\Cuota
*/
class CuotaQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Cuota[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Cuota|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}