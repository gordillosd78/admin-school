<?php

namespace app\models\query;

/**
* This is the ActiveQuery class for [[\app\models\Curso]].
*
* @see \app\models\Curso
*/
class CursoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }

    /**
    * @inheritdoc
    * @return \app\models\Curso[]|array
    */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
    * @inheritdoc
    * @return \app\models\Curso|array|null
    */
    public function one($db = null)
    {
        return parent::one($db);
    }
}