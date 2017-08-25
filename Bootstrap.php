<?php

namespace mrstroz\wavecms\page;

use mrstroz\wavecms\base\helpers\FontAwesome;
use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->id === 'app-backend') {
            Yii::setAlias('@wavecms_page', '@vendor/mrstroz/yii2-wavecms-page');

            Yii::$app->i18n->translations['wavecms/page/*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@wavecms_page/messages',
                'fileMap' => [
                    'wavecms/page/main' => 'main.php',
                ],
            ];

            Yii::$app->params['nav'][] = [
                'label' => FontAwesome::icon('sitemap') . Yii::t('wavecms/page/main', 'Pages'),
                'url' => 'javascript: ;',
                'options' => [
                    'class' => 'drop-down'
                ],
                'permission' => 'page',
                'position' => 90,
                'items' => [
                    [
                        'label' => FontAwesome::icon('home') . Yii::t('wavecms/page/main', 'Home page'),
                        'url' => ['/page/home/page']
                    ],
                    ['label' => FontAwesome::icon('file') . Yii::t('wavecms/page/main', 'Text pages'),
                        'url' => ['/page/text/index']
                    ]

                ]
            ];
        }
    }
}