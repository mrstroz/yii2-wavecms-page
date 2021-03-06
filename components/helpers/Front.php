<?php

namespace mrstroz\wavecms\page\components\helpers;

use mrstroz\wavecms\page\models\Menu;
use mrstroz\wavecms\page\models\Page;
use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;

class Front extends Component
{
    /** @var array Array with all text pages. Format: ['id' => ['id' => 1,'type' => 'text','link'=>'about-us']] */
    public static $pages;

    /** @var array Fields used for page table relationship */
    public static $fields = [
        'page_id' => 'page_id',
        'page_url' => 'page_url',
        'page_blank' => 'page_blank',
        'rel' => 'rel'
    ];

    /** @var string Param in url used for page link */
    public static $linkParam = 'link';

    /** @var string Route used for text pages */
    public static $pageRoute = 'site/page';

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
            self::initPages();
        }

        if ($pageUrl) {
            if (strpos($pageUrl, 'http') === 0) {
                return Url::to($pageUrl);
            }

            return Url::to([$pageUrl]);
        }

        if (isset(self::$pages[$pageId]['link'])) {
            if (self::$pages[$pageId]['link']) {
                return Url::to(['/' . self::$pages[$pageId]['link']]);
            }
        }

        return Url::home();
    }


    /**
     * Display link by page
     * @param mixed $menu
     * @param $text Html:a text
     * @param array $options Html:a options
     * @param array $fields
     * @return bool|string
     * @throws \yii\base\InvalidConfigException
     */
    public static function link($menu, $text, array $options = [], array $fields = [])
    {
        if ($menu instanceof ActiveRecord) {

            if (!$fields) {
                $fields = self::$fields;
            }

            if ($menu->{$fields['page_blank']}) {
                $options['target'] = '_blank';
            }

            if ($menu->{$fields['rel']}) {
                $options['rel'] = $menu->{$fields['rel']};
            }

            return Html::a($text, self::linkUrl(
                $menu->{$fields['page_id']},
                $menu->{$fields['page_url']}
            ), $options);
        }

        return false;
    }

    /**
     * Check if page is active
     * @param mixed $menu
     * @param array $fields
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function isLinkActive($menu, array $fields = [])
    {
        if ($menu instanceof ActiveRecord) {
            if (self::$pages === null) {
                self::initPages();
            }

            if (!$fields) {
                $fields = self::$fields;
            }

            /** Check if page_url is the same as current url */
            $pageUrl = $menu->{$fields['page_url']};
            if ($pageUrl) {
                if (strpos($pageUrl, 'http') === 0) {
                    return false;
                }

                return (Url::to([$pageUrl]) === Url::current());
            }

            if (isset(self::$pages[$menu->{$fields['page_id']}]['link'])) {
                if (Yii::$app->request->getQueryParam(self::$linkParam) === self::$pages[$menu->{$fields['page_id']}]['link']) {
                    return true;
                }

                return false;
            }

            return (Url::home() === Url::current());
        }

        return false;

    }

    /**
     * Return movie ID based on YouTube url
     * @param $url
     * @return mixed
     */
    public static function youTubeId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $vars);
        if (isset($vars['v'])) {
            return $vars['v'];
        }
        return false;
    }

    /**
     * Init pages array
     * @throws \yii\base\InvalidConfigException
     */
    private static function initPages()
    {
        $modelPage = Yii::createObject(Page::class);
        $pages = $modelPage::find()->getMap()->asArray()->all();

        if ($pages) {
            foreach ($pages as $page) {
                self::$pages[$page['id']] = $page;
            }
        }

    }
}