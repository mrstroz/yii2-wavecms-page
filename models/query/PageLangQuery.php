<?php

namespace mrstroz\wavecms\page\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[PageLang]].
 *
 * @see PageLang
 */
class PageLangQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PageLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
