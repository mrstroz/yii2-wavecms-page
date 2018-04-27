<?php

namespace mrstroz\wavecms\page;

use mrstroz\wavecms\components\helpers\FontAwesome;
use mrstroz\wavecms\page\models\Menu;
use mrstroz\wavecms\page\models\MenuLang;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageItem;
use mrstroz\wavecms\page\models\PageItemLang;
use mrstroz\wavecms\page\models\PageLang;
use mrstroz\wavecms\page\models\PageSettings;
use mrstroz\wavecms\page\models\query\MenuLangQuery;
use mrstroz\wavecms\page\models\query\MenuQuery;
use mrstroz\wavecms\page\models\query\PageItemLangQuery;
use mrstroz\wavecms\page\models\query\PageLangQuery;
use mrstroz\wavecms\page\models\query\PageQuery;
use mrstroz\wavecms\page\models\search\PageSearch;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Exception;
use yii\i18n\PhpMessageSource;

/**
 * Class Bootstrap
 * @package mrstroz\wavecms\page
 * Boostrap class for wavecms page
 */
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::setAlias('@wavecms_page', '@vendor/mrstroz/yii2-wavecms-page');

        /** Set backend language based on user lang (Must be done before define translations */
        if ($app->id === 'app-backend') {
            if (!Yii::$app->user->isGuest) {
                Yii::$app->language = Yii::$app->user->identity->lang;
            }
        }

        $this->initTranslations();

        /** @var Module $module */
        if ($app->hasModule('wavecms') && ($module = $app->getModule('wavecms-page')) instanceof Module) {

            if ($app->id === 'app-backend') {

                $this->initNavigation();
                $this->initContainer($module);
            }
        }
    }

    /**
     * Init translations
     */
    protected function initTranslations()
    {
        Yii::$app->i18n->translations['wavecms_page/*'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@wavecms_page/messages',
            'fileMap' => [
                'main' => 'main.php',
            ],
        ];
    }

    /**
     * Init class map and dependency injection container
     * @param Module $module
     * @return void
     * @throws Exception
     */
    protected function initContainer($module)
    {
        $map = [];

        $defaultClassMap = [

            /* MODELS */
            'Menu' => Menu::class,
            'MenuLang' => MenuLang::class,
            'Page' => Page::class,
            'PageLang' => PageLang::class,
            'PageItem' => PageItem::class,
            'PageItemLang' => PageItemLang::class,
            'PageSettings' => PageSettings::class,

            /* QUERIES */
            'MenuQuery' => MenuQuery::class,
            'MenuLangQuery' => MenuLangQuery::class,
            'PageQuery' => PageQuery::class,
            'PageLangQuery' => PageLangQuery::class,
            'PageItemQuery' => PageLangQuery::class,
            'PageItemLangQuery' => PageItemLangQuery::class,

            /* SEARCH */
            'PageSearch' => PageSearch::class
        ];

        $routes = [
            'mrstroz\\wavecms\\page\\models' => [
                'Menu',
                'MenuLang',
                'Page',
                'PageLang',
                'PageItem',
                'PageItemLang',
                'PageSettings',
            ],
            'mrstroz\\wavecms\\models\\page\\query' => [
                'MenuQuery',
                'MenuLangQuery',
                'PageQuery',
                'PageLangQuery',
                'PageItemQuery',
                'PageItemLangQuery',
            ],
            'mrstroz\\wavecms\\models\\page\\search' => [
                'PageSearch'
            ]
        ];

        $mapping = array_merge($defaultClassMap, $module->classMap);

        foreach ($mapping as $name => $definition) {
            $map[$this->getContainerRoute($routes, $name) . "\\$name"] = $definition;
        }

        $di = Yii::$container;

        foreach ($map as $class => $definition) {
            /** Check if definition does not exist in container. */
            if (!$di->has($class)) {
                $di->set($class, $definition);
            }
        }

    }

    /**
     * Init left navigation
     */
    protected function initNavigation()
    {
        Yii::$app->params['nav']['wavecms_menu'] = [
            'label' => FontAwesome::icon('bars') . Yii::t('wavecms_page/main', 'Menu'),
            'url' => 'javascript: ;',
            'options' => [
                'class' => 'drop-down'
            ],
            'permission' => 'wavecms_page',
            'position' => 1000,
            'items' => [
                [
                    'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms_page/main', 'Top menu'),
                    'url' => ['/wavecms-page/menu-top/index']
                ],
                ['label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms_page/main', 'Bottom menu'),
                    'url' => ['/wavecms-page/menu-bottom/index']
                ]

            ]
        ];

        Yii::$app->params['nav']['wavecms_page'] = [
            'label' => FontAwesome::icon('sitemap') . Yii::t('wavecms_page/main', 'Pages'),
            'url' => 'javascript: ;',
            'options' => [
                'class' => 'drop-down'
            ],
            'permission' => 'wavecms_page',
            'position' => 2000,
            'items' => [
                [
                    'label' => FontAwesome::icon('home') . Yii::t('wavecms_page/main', 'Home page'),
                    'url' => ['/wavecms-page/home/page']
                ],
                ['label' => FontAwesome::icon('file-alt') . Yii::t('wavecms_page/main', 'Text pages'),
                    'url' => ['/wavecms-page/text/index']
                ],
                ['label' => FontAwesome::icon('cog') . Yii::t('wavecms_page/main', 'Settings'),
                    'url' => ['/wavecms-page/settings/settings']
                ]


            ]
        ];
    }

    /**
     * Get container route for class name
     * @param array $routes
     * @param $name
     * @throws \yii\base\Exception
     * @return int|string
     */
    private function getContainerRoute(array $routes, $name)
    {
        foreach ($routes as $route => $names) {
            if (in_array($name, $names, false)) {
                return $route;
            }
        }
        throw new Exception("Unknown configuration class name '{$name}'");
    }
}