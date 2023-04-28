<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Docente]].
*
* @see \app\models\Docente
*/
class DocenteQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Docente[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Docente|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}