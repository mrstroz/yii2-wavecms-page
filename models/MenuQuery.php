<?php

namespace mrstroz\wavecms\page\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Menu]].
 *
 * @see Menu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Menu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Menu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getMenu($type)
    {
        return $this
            ->joinWith('translations')
            ->andFilterWhere(['and',
                ['=', 'publish', '1'],
                ['=', 'type', $type],
                ['REGEXP', 'languages', '(^|;)(' . Yii::$app->language . ')(;|$)']
            ])
            ->orderBy('sort');
    }
}
