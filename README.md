UNDER DEV !!!
=============


# yii2-wavecms-page
Page module for **WaveCMS**

**This module required [Yii 2 WaveCMS User](https://github.com/mrstroz/yii2-wavecms-user).** 

Please do all install steps first from [Yii 2 WaveCMS User](https://github.com/mrstroz/yii2-wavecms-user).

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
            'MenuLang' => 'mrstroz\wavecms\page\models\MenuLang'
         ],
         'forms' => [
            'page/home' => '@backend/views/page/home/form.php',
            'page/home-slider' => '@backend/views/page/home-slider/form.php',
            'page/text' => '@backend/views/page/text/form.php',
            'page/menu-top' => '@backend/views/page/menu-top/form.php',
            'page/menu-bottom' => '@backend/views/page/menu-bottom/form.php'
         ]
         */
    ],
],
```

Form views can be overwritten by backend [themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html);

2. Run migration 
```
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-page/migrations
```

Usage in frontend
-----------------

#### Pages
1. Add new rules to your urlManager. You can do it in one of your bootstrap classes

```php
use mrstroz\wavecms\page\models\Page;
use Yii;
// ...
//Parse request to set language before run ActiveRecord::find()
Yii::$app->urlManager->parseRequest(Yii::$app->request); 
Yii::$app->getUrlManager()->addRules([
    '<link:(' . implode('|', Page::find()->getLinks()->column()) . ')>' => 'site/page'
]);
```

2. Get requested page by link in `page` action
```php
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

#### Menu

1. Get menu by type
```php
use mrstroz\wavecms\page\models\Menu;
// ...
$menu = Menu::find()->getMenu('top')->all();
```

2. Display menu in view. Required [waveFront Base](https://github.com/mrstroz/yii2-wavefront-base)
```php
<?php 

use mrstroz\wavefront\base\helpers\Front;

foreach ($menu as $one) {
    echo '<a href="'.Front::linkUrl($one->page_id, $one->page_url).'">'.$one->title.'</a>'; // or
    echo Front::link($one->page_id, $one->page_url, $one->title); 
}
?>
```




