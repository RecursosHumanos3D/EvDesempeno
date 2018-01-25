<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Conductas]].
 *
 * @see Conductas
 */
class ConductasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Conductas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Conductas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
