# yii2-wavecms-page
**Page module for [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).** 

Please do all install steps first from [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require --prefer-source "mrstroz/yii2-wavecms-page" "~0.1.0"
```

or add

```
"mrstroz/yii2-wavecms-page": "~0.1.0"
```

to the require section of your `composer.json` file.


Required
--------

1. Update `backend/config/main.php` (Yii2 advanced template) 
```php
'modules' => [
    // ...
    'wavecms-page' => [
        'class' => 'mrstroz\wavecms\page\Module',
        /*
         * Override classes
        'classMap' => [
            'Page' => 'common\models\Page',
        ]
        */
    ],
],

```

Form views can be overwritten by backend [themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html);

2. Update `frontend/config/main.php` (Yii2 advanced template) 

```php
'bootstrap' => [
    // ...
    'mrstroz\wavecms\page\FrontendBootstrap'
],
'modules' => [
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
            '@vendor/mrstroz/yii2-wavecms-page/migrations',
            '@vendor/mrstroz/yii2-wavecms-metatags/migrations'
        ],
    ],
],
```

Or run migrates directly

```yii
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-page/migrations
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-metatags/migrations
```


Overriding classes
------------------
Classes can be overridden by:
1. `classMap` attribute for WaveCMS module
```php
'modules' => [
    // ...   
    'wavecms-page' => [
        'class' => 'mrstroz\wavecms\page\Module',
        'classMap' => [
            'Page' => \common\models\Page::class
        ]
    ],
],
```

2. Yii2 Dependency Injection configuration in `backend/config/main.php`
```php
'container' => [
    'definitions' => [
        mrstroz\wavecms\page\models\Page::class => common\models\Page::class
    ],
],
```

Overriding controllers
----------------------
Use `controllerMap` attribute for WaveCMS module to override controllers
```php
'modules' => [
    // ...   
    'wavecms' => [
        'class' => 'mrstroz\wavecms\page\Module',
        'controllerMap' => [
            'text' => 'backend\controllers\TextController'
        ]
    ],
],
```

Overriding views
--------------
Use **[themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html)** for override views
```php
'components' => [
    // ...
    'view' => [
        'theme' => [
            'basePath' => '@app/themes/basic',
            'baseUrl' => '@web/themes/basic',
            'pathMap' => [
                '@wavecms_page/views' => '@app/themes/basic/wavecms-page',
            ],
        ],
    ],
    // ...
],
```

Usage in frontend
-----------------

#### Pages
1. Add new rules to your urlManager. You can do it in one of your `Bootstrap` classes

```php
<?php
use mrstroz\wavecms\page\models\Page;
use Yii;
// ...
//Parse request to set language before run ActiveRecord::find()
Yii::$app->urlManager->parseRequest(Yii::$app->request);
$modelPage = Yii::createObject(Page::class);
$pages = $modelPage::find()->select(['link'])->byAllCriteria()->byType(['text'])->column();

if ($pages) {
    Yii::$app->getUrlManager()->addRules([
        '<link:(' . implode('|', $pages) . ')>' => 'site/page'
    ]);
}
```

2. Get requested page by link in `page` action
```php
<?php
use mrstroz\wavecms\page\models\Page;
// ...
public function actionPage($link)
{
    $page = Page::find()->getByLink($link)->one();
    return $this->render($page->template ?: 'page', [
        'page' => $page
    ]);
}
```

3. If you need extra templates, you can add them to `Page` model in `common\config\bootstrap.php`
```php
<?php 
use mrstroz\wavecms\page\models\Page;
// ... 
Page::$templates['contact'] = Yii::t('app', 'Contact');

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
foreach ($menu as $item) {
    $class = (Front::isLinkActive($item) ? 'active' : '');
    echo Front::link($item, $item->title, ['class' => $class]);
}
// ...
```
OR
```php
<?php 
use mrstroz\wavecms\page\components\helpers\Front;
// ...
/** @var \mrstroz\wavecms\page\models\Menu $menu */
foreach ($menu as $item) {
    $class = (Front::isLinkActive($item) ? 'active' : '');
    echo '<a href="'.Front::linkUrl($item->page_id, $one->page_url).'" class="'.$class.'">'.$item->title.'</a>';
}
// ...
```

#### Meta tags
See [yii2-wavecms-metatags](https://github.com/mrstroz/yii2-wavecms-metatags)


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
3. Slugify https://github.com/powerkernel/yii2-slugify
4. Select2 https://github.com/kartik-v/yii2-widget-select2
5. Datepicker https://github.com/kartik-v/yii2-widget-datepicker
6. Switch widget https://github.com/2amigos/yii2-switch-widget
7. Sitemap - https://github.com/himiklab/yii2-sitemap-module


> ![INWAVE LOGO](http://inwave.pl/html/img/logo.png)  
> INWAVE - Internet Software House  
> [inwave.eu](http://inwave.eu/)





