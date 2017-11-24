<?php

namespace mrstroz\wavecms\page\components\helpers;

use Yii;
use yii\base\Component;
use yii\db\ActiveRecord;

class MetaTags extends Component
{

    /**
     * Register meta tags
     * @param array $metaTags should contain ['meta_title' => '', 'meta_description' => '','meta_keywords' = > ''
     */
    public static function register($metaTags)
    {

        if ($metaTags instanceof ActiveRecord) {
            if (isset($metaTags->meta_title)) {
                Yii::$app->view->title = $metaTags->meta_title;
            }

            if (isset($metaTags->meta_description)) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'description',
                    'content' => $metaTags->meta_description,
                ]);
            }

            if (isset($metaTags->meta_keywords)) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'keywords',
                    'content' => $metaTags->meta_keywords,
                ]);
            }
        }

    }
}