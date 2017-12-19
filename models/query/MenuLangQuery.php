<?php

namespace mrstroz\wavecms\page\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[MenuLang]].
 *
 * @see MenuLang
 */
class MenuLangQuery extends ActiveQuery
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
