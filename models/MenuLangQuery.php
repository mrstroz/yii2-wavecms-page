<?php

namespace mrstroz\wavecms\page\models;

/**
 * This is the ActiveQuery class for [[MenuLang]].
 *
 * @see MenuLang
 */
class MenuLangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MenuLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MenuLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
