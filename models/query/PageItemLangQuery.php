<?php

namespace mrstroz\wavecms\page\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[PageItemLang]].
 *
 * @see PageItemLang
 */
class PageItemLangQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PageItemLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageItemLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
