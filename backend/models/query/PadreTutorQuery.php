<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\PadreTutor]].
 *
 * @see \app\models\PadreTutor
 */
class PadreTutorQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[estado]]=1');
    }


    /**
     * {@inheritdoc}
     * @return \app\models\PadreTutor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\PadreTutor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
