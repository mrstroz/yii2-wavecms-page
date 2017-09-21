<?php

namespace mrstroz\wavecms\page\models;

/**
 * This is the ActiveQuery class for [[PageItem]].
 *
 * @see PageItem
 */
class PageItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PageItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
