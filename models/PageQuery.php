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
            ->joinPageLang()
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
            ->joinPageLang();
    }

    public function getByLink($link)
    {
        return $this
            ->joinWith('translations')
            ->andWhere(['link' => $link]);
    }

    public function joinPageLang($language = null)
    {
        if (!$language) {
            if (Yii::$app->id === 'app-backend') {
                $language = Yii::$app->wavecms->editedLanguage;
            } else {
                $language = Yii::$app->language;
            }
        }

        return $this->leftJoin(PageLang::tableName(),
            PageLang::tableName() . '.page_id = ' . Page::tableName() . '.id AND 
                ' . PageLang::tableName() . '.language = "' . $language . '"');
    }
}
