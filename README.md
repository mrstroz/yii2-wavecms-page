# yii2-wavecms-page
**Page module for [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).** 

Please do all install steps first from [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require --prefer-source "mrstroz/yii2-wavecms-page" "dev-master"
```

or add

```
"mrstroz/yii2-wavecms-page": "dev-master"
```

to the require section of your `composer.json` file.


Required
--------

1. Update `backend/config/main.php` (Yii2 advanced template) 
```php
'bootstrap' => [
    // ...
    'mrstroz\wavecms\page\Bootstrap'
],
'modules' => [
    // ...
    'page' => [
        'class' => 'mrstroz\wavecms\page\Module',
        /*
         * Overwrite model classes and form views
         'models' => [
            'Home' => 'mrstroz\wavecms\page\models\Page',
            'HomeLang' => 'mrstroz\wavecms\page\models\PageLang',
            'HomeSlider' => 'mrstroz\wavecms\page\models\PageItem',
            'HomeSliderLang' => 'mrstroz\wavecms\page\models\PageItemLang',
            'Page' => 'mrstroz\wavecms\page\models\Page',
            'PageLang' => 'mrstroz\wavecms\page\models\PageLang', 
            'Menu' => 'mrstroz\wavecms\page\models\Menu',
            'MenuLang' => 'mrstroz\wavecms\page\models\MenuLang',
            'Settings' => 'mrstroz\wavecms\page\models\Settings'
         ],
         'forms' => [
            'page/home' => '@backend/views/page/home/form.php',
            'page/home-slider' => '@backend/views/page/home-slider/form.php',
            'page/text' => '@backend/views/page/text/form.php',
            'page/menu-top' => '@backend/views/page/menu-top/form.php',
            'page/menu-bottom' => '@backend/views/page/menu-bottom/form.php',
            'page/settings' => '@backend/views/page/settings/form.php',
         ]
         */
    ],
],
'controllerMap' => [
    'elfinder' => [
        'class' => 'mihaildev\elfinder\Controller',
        'access' => ['@'],
        'disabledCommands' => ['netmount'],
        'roots' => [
            [
                'baseUrl'=>'@frontWeb',
                'basePath'=>'@frontWebroot',
                'path' => 'userfiles',
                'name' => 'Files'
            ]
        ]
    ]
]
```

Form views can be overwritten by backend [themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html);

2. Update `frontend/config/main.php` (Yii2 advanced template) 

```php
'modules' => [
    // ...
    'sitemap' => [
        'class' => 'himiklab\sitemap\Sitemap',
        'models' => [
            'mrstroz\wavecms\page\models\Page',
        ],
        'urls' => [
            [
                'loc' => ['/'],
                'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                'priority' => 1,
                ]
            ],
            'cacheExpire' => 1
        ]
    ],
],
// ...
'components' => [
    'urlManager' => [
        'rules' => [
            // Add rule for sitemap.xml
            ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
        ],
    ],
]
```

3. Run migration 

Add the `migrationPath` in `console/config/main.php` and run `yii migrate`:

```php
// Add migrationPaths to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => [
            '@vendor/mrstroz/yii2-wavecms-page/migrations'  
        ],
    ],
],
```

Or run migrates directly

```yii
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-page/migrations
```

Usage in frontend
-----------------

#### Pages
1. Add new rules to your urlManager. You can do it in one of your bootstrap classes

```php
<?php
use mrstroz\wavecms\page\models\Page;
use Yii;
// ...
//Parse request to set language before run ActiveRecord::find()
Yii::$app->urlManager->parseRequest(Yii::$app->request); 
Yii::$app->getUrlManager()->addRules([
    '<link:(' . implode('|', Page::find()->select(['link'])->byAllCriteria()->byType(['text'])->column()) . ')>' => 'site/page'
]);
```

2. Get requested page by link in `page` action
```php
<?php
use mrstroz\wavecms\page\models\Page;
// ...
public function actionPage($link)
{
    $page = Page::find()->getByLink($link)->one();

    $this->render('page', [
        'page' => $page
    ]);
}
```

#### Page templates
1. Add new template to `Page` model in `common\config\bootstrap.php`
```php
<?php 
use mrstroz\wavecms\page\models\Page;
// ... 
Page::$templates['contact'] = Yii::t('app', 'Contact');

```

2. Use in frontend to display different view
```php
<?php
use mrstroz\wavecms\page\models\Page;
// ...
public function actionPage($link)
{
    $page = Page::find()->getByLink($link)->one();

    $this->render($page->template, [
        'page' => $page
    ]);
}
```

#### Menu

1. Get menu by type
```php
<?php 
use mrstroz\wavecms\page\models\Menu;
// ...
$menu = Menu::find()->getMenu('top')->all();
// ...
?>
```

2. Display menu in view. 
```php
<?php 
use mrstroz\wavecms\page\components\helpers\Front;
// ...
/** @var \mrstroz\wavecms\page\models\Menu $menu */
foreach ($menu as $one) {
    echo '<a href="'.Front::linkUrl($one->page_id, $one->page_url).'">'.$one->title.'</a>'; // or
    echo Front::link($one, $one->title); 
}
// ...
```

#### Meta tags
1. Register meta tags by `Front` helper
```php
<?php
use mrstroz\wavecms\page\models\Page; 
use mrstroz\wavecms\page\components\helpers\MetaTags;
// ...
$page = Page::find()->getByLink($link)->one();
MetaTags::register($page);

```

#### Add pages to sitemap
According to [Sitemap module](https://github.com/himiklab/yii2-sitemap-module), we need to add behaviour to our AR model and then add model to sitemap module configuration (see frontend/config/main.php)
```php
use himiklab\sitemap\behaviors\SitemapBehavior;

public function behaviors()
{
    return [
        'sitemap' => [
            'class' => SitemapBehavior::className(),
            'scope' => function ($model) {
                /** @var \yii\db\ActiveQuery $model */
                $model->select(['url', 'lastmod']);
                $model->andWhere(['is_deleted' => 0]);
            },
            'dataClosure' => function ($model) {
                /** @var self $model */
                return [
                    'loc' => Url::to($model->url, true),
                    'lastmod' => strtotime($model->lastmod),
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.8
                ];
            }
        ],
    ];
}
```


Used packages
-------------
1. CKEditor https://github.com/MihailDev/yii2-ckeditor
2. ElFinder https://github.com/MihailDev/yii2-elfinder
3. Slugify https://github.com/modernkernel/yii2-slugify
4. Select2 https://github.com/kartik-v/yii2-widget-select2 https://github.com/2amigos/yii2-select2-widget
5. Datepicker https://github.com/kartik-v/yii2-widget-datepicker
6. Switch widget https://github.com/2amigos/yii2-switch-widget
7. Sitemap - https://github.com/himiklab/yii2-sitemap-module




