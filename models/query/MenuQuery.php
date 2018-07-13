<?php

namespace mrstroz\wavecms\page\models\query;

use mrstroz\wavecms\page\models\Menu;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Menu]].
 *
 * @see Menu
 */
class MenuQuery extends ActiveQuery
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

    /**
     * @param $type
     * @return MenuQuery
     */
    public function getMenu($type)
    {
        return $this
            ->byCriteria()
            ->andWhere(['=', 'type', $type])
            ->orderBy('sort');
    }

    /**
     * @return MenuQuery
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
