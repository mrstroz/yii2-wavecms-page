<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\components\base\SettingsModel;
use mrstroz\wavecms\components\behaviors\ImageBehavior;

class PageSettings extends SettingsModel
{

    public $is_top_submenu;
    public $is_bottom_submenu;
    public $is_home_slider;
    public $favicon;
    public $default_meta_title;
    public $default_meta_description;
    public $default_meta_keywords;
    public $top_javascript;
    public $btm_javascript;


    public function behaviors()
    {
        return [
            'image' => [
                'class' => ImageBehavior::className(),
                'attribute' => 'favicon',
            ]
        ];
    }

    public function rules()
    {
        return [
            [['is_top_submenu', 'is_bottom_submenu', 'is_home_slider'], 'boolean'],
            [['favicon'], 'image', 'extensions' => 'png', 'skipOnEmpty' => true],
            [['default_meta_title', 'default_meta_description', 'default_meta_keywords'], 'string'],
            [['top_javascript', 'btm_javascript'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'is_top_submenu' => \Yii::t('wavecms_page/main', 'Top submenu'),
            'is_bottom_submenu' => \Yii::t('wavecms_page/main', 'Bottom submenu'),
            'is_home_slider' => \Yii::t('wavecms_page/main', 'Home slider'),
            'favicon' => \Yii::t('wavecms_page/main', 'Favicon'),
            'default_meta_title' => \Yii::t('wavecms_page/main', 'Default meta title'),
            'default_meta_description' => \Yii::t('wavecms_page/main', 'Default meta description'),
            'default_meta_keywords' => \Yii::t('wavecms_page/main', 'Default meta keywords'),
            'top_javascript' => \Yii::t('wavecms_page/main', 'Top javascript'),
            'btm_javascript' => \Yii::t('wavecms_page/main', 'Bottom javascript'),
        ];
    }

}
