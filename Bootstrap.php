<?php

namespace mrstroz\wavecms\page;

use mrstroz\wavecms\components\helpers\FontAwesome;
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
                'label' => FontAwesome::icon('bars') . Yii::t('wavecms/page/main', 'Menu'),
                'url' => 'javascript: ;',
                'options' => [
                    'class' => 'drop-down'
                ],
                'permission' => 'page',
                'position' => 1000,
                'items' => [
                    [
                        'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms/page/main', 'Top menu'),
                        'url' => ['/page/menu-top/index']
                    ],
                    ['label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms/page/main', 'Bottom menu'),
                        'url' => ['/page/menu-bottom/index']
                    ]

                ]
            ];

            Yii::$app->params['nav'][] = [
                'label' => FontAwesome::icon('sitemap') . Yii::t('wavecms/page/main', 'Pages'),
                'url' => 'javascript: ;',
                'options' => [
                    'class' => 'drop-down'
                ],
                'permission' => 'page',
                'position' => 2000,
                'items' => [
                    [
                        'label' => FontAwesome::icon('home') . Yii::t('wavecms/page/main', 'Home page'),
                        'url' => ['/page/home/page']
                    ],
                    ['label' => FontAwesome::icon('file-text-o') . Yii::t('wavecms/page/main', 'Text pages'),
                        'url' => ['/page/text/index']
                    ],
                    ['label' => FontAwesome::icon('cog') . Yii::t('wavecms/base/main', 'Settings'),
                        'url' => ['/page/settings/settings']
                    ]


                ]
            ];
        }
    }
}