<?php

namespace mrstroz\wavecms\page\components\helpers;

use mrstroz\wavecms\page\models\Page;
use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Front extends Component
{
    public static $pages;
    public static $fields = [
        'page_id' => 'page_id',
        'page_url' => 'page_url',
        'page_blank' => 'page_blank'
    ];

    /**
     * Get image url by filename
     * @param $file
     * @param bool $folder
     * @return string
     */
    public static function imgUrl($file, $folder = false)
    {
        $src = '@web/images/';
        if ($folder !== false) {
            $src .= $folder . '/';
        }
        $src .= $file;

        return Url::to($src);
    }

    /**
     * Display img tag
     * @param string $file
     * @param bool $folder
     * @param array $options
     * @return string
     */
    public static function img($file, $folder = false, array $options = [])
    {
        return Html::img(self::imgUrl($file, $folder), $options);
    }

    /**
     * Get page url by id
     * @param $pageId
     * @param $pageUrl
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function linkUrl($pageId, $pageUrl)
    {
        if (self::$pages === null) {
            $modelPage = Yii::createObject(Page::class);
            self::$pages = ArrayHelper::map($modelPage::find()->getMap()->asArray()->all(), 'id', 'link');
        }

        if ($pageUrl) {
            if (strpos($pageUrl, 'http') === 0) {
                return Url::to($pageUrl);
            }

            return Url::to([$pageUrl]);
        }

        if (isset(self::$pages[$pageId])) {

            if (self::$pages[$pageId]) {
                return Url::to(['/' . self::$pages[$pageId]]);
            }
        }

        return Url::home();
    }


    /**
     * Display link by page
     * @param Page $page
     * @param $text
     * @param array $options
     * @param array $fields
     * @return bool|string
     * @throws \yii\base\InvalidConfigException
     */
    public static function link($page, $text, array $options = [], array $fields = [])
    {
        if ($page instanceof ActiveRecord) {
            if (!$fields) {
                $fields = self::$fields;
            }

            if ($page->{$fields['page_blank']}) {
                $options['target'] = '_blank';
            }

            return Html::a($text, self::linkUrl(
                $page->{$fields['page_id']},
                $page->{$fields['page_url']}
            ), $options);
        }

        return false;
    }
}