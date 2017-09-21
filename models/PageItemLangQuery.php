<?php

namespace mrstroz\wavecms\page\models;

/**
 * This is the ActiveQuery class for [[PageItemLang]].
 *
 * @see PageItemLang
 */
class PageItemLangQuery extends \yii\db\ActiveQuery
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
