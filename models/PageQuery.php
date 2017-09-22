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
     * This function is used in routing to get all available links for active pages
     * @return ActiveQuery
     */
    public function getLinks()
    {
        return $this
            ->select(['link'])
            ->joinLang()
            ->orFilterWhere($this->whereByType('text'));
    }

    /**
     * @param $type
     * @return array Where array
     */
    public function whereByType($type)
    {
        return ['and',
            '`link` IS NOT NULL',
            '`link` != ""',
            ['=', 'publish', '1'],
            ['=', 'type', $type],
            ['REGEXP', 'languages', '(^|;)(' . Yii::$app->language . ')(;|$)']
        ];
    }

    /**
     * getMap is using in yii2-wavefront-base extension in function Front::linkUrl
     * @return $this
     */
    public function getMap()
    {
        return $this
            ->select([Page::tableName() . '.id', PageLang::tableName() . '.link'])
            ->joinLang();
    }

    /**
     * Get single page by link
     * @param $link
     * @return $this
     */
    public function getByLink($link)
    {
        return $this
            ->joinWith('translations')
            ->andWhere(['link' => $link]);
    }

    /**
     * Join with language table by current language
     * @param null $language
     * @return $this
     */
    public function joinLang($language = null)
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
