<?php

namespace mrstroz\wavecms\page\models\query;

use mrstroz\wavecms\page\models\PageItem;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[PageItem]].
 *
 * @see PageItem
 */
class PageItemQuery extends ActiveQuery
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

    /**
     * @return PageItemQuery
     */
    public function getItems()
    {
        return $this->byCriteria()->orderBy('sort');
    }

    /**
     * @return PageItemQuery
     */
    public function byCriteria()
    {
        return $this
            ->joinWith('translations')
            ->andFilterWhere(['and',
                ['=', 'publish', '1'],
                ['REGEXP', 'languages', '(^|;)(' . Yii::$app->language . ')(;|$)']
            ]);
    }
}
