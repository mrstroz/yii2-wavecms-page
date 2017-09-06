<?php

namespace mrstroz\wavecms\page\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return ActiveQuery
     */
    public function getLinks()
    {
        return $this
            ->select(['link'])
            ->joinWith('pageLang')
            ->orFilterWhere(['and',
                ['=', 'publish', '1'],
                ['=', 'type', 'text'],
                ['REGEXP', 'languages', '(^|;)(' . Yii::$app->language . ')(;|$)']
            ]);
    }

    public function getMap()
    {
        return $this
            ->select([Page::tableName() . '.id', PageLang::tableName() . '.link'])
            ->joinWith('pageLang');
    }

    public function getByLink($link)
    {
        return $this
            ->joinWith('translations')
            ->andWhere(['link' => $link]);
    }
}
