<?php

namespace mrstroz\wavecms\page\models\query;

use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends ActiveQuery
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
     * Get page by all required criteria
     * @return $this
     */
    public function byAllCriteria()
    {
        return $this
            ->joinLang()
            ->byPublish()
            ->byNotEmptyLink()
            ->byLanguage();
    }

    /**
     * Get only published text pages
     * @param int $publish
     * @return $this
     */
    public function byPublish($publish = 1)
    {
        return $this->andWhere([Page::tableName() . '.publish' => $publish]);
    }

    /**
     * Get pages with not empty link
     * @return $this
     */
    public function byNotEmptyLink()
    {
        return $this
            ->andWhere(PageLang::tableName() . '.link IS NOT NULL')
            ->andWhere(PageLang::tableName() . '.link != ""');
    }

    /**
     * Get pages by language
     * @param null|string $language
     * @return $this
     */
    public function byLanguage($language = null)
    {
        if (!$language) {
            if (Yii::$app->id === 'app-backend') {
                $language = Yii::$app->wavecms->editedLanguage;
            } else {
                $language = Yii::$app->language;
            }
        }

        return $this->andWhere(['REGEXP', Page::tableName() . '.languages', '(^|;)(' . $language . ')(;|$)']);
    }

    /**
     * @param string|array $type
     * @return $this
     */
    public function byType($type)
    {
        return $this->andWhere([Page::tableName() . '.type' => $type]);
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
