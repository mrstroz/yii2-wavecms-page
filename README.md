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
```
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
            'Page' => 'mrstroz\wavecms\page\models\Page',
            'PageLang' => 'mrstroz\wavecms\page\models\PageLang'
         ],
         'forms' => [
            'page/home' => '@backend/views/page/home/form.php',
            'page/text' => '@backend/views/page/text/form.php'
         ]
         */
    ],
],
```

2. Run migration 
```
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-page/migrations
```




