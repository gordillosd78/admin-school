<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Parentesco]].
*
* @see \app\models\Parentesco
*/
class ParentescoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Parentesco[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Parentesco|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}