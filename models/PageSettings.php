<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\components\base\SettingsModel;
use mrstroz\wavecms\components\behaviors\ImageBehavior;

class PageSettings extends SettingsModel
{

    public $favicon;
    public $footer_copyright;

    public $is_top_submenu;
    public $is_bottom_submenu;

    public $is_home_slider;
    public $is_home_grid;
    public $is_home_sections;

    public $is_page_grid;
    public $is_page_sections;

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
            [['favicon'], 'image', 'extensions' => 'png', 'skipOnEmpty' => true],
            [['footer_copyright'], 'string'],

            [['is_top_submenu', 'is_bottom_submenu'], 'boolean'],
            [['is_home_slider', 'is_home_grid','is_home_sections'], 'boolean'],
            [['is_page_grid', 'is_page_sections'], 'boolean'],

            [['default_meta_title', 'default_meta_description', 'default_meta_keywords'], 'string'],
            [['top_javascript', 'btm_javascript'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'favicon' => \Yii::t('wavecms_page/main', 'Favicon'),
            'footer_copyright' => \Yii::t('wavecms_page/main', 'Copyright'),

            'is_top_submenu' => \Yii::t('wavecms_page/main', 'Top submenu'),
            'is_bottom_submenu' => \Yii::t('wavecms_page/main', 'Bottom submenu'),

            'is_home_slider' => \Yii::t('wavecms_page/main', 'Slider'),
            'is_home_grid' => \Yii::t('wavecms_page/main', 'Grid'),
            'is_home_sections' => \Yii::t('wavecms_page/main', 'Sections'),

            'is_page_grid' => \Yii::t('wavecms_page/main', 'Grid'),
            'is_page_sections' => \Yii::t('wavecms_page/main', 'Sections'),

            'default_meta_title' => \Yii::t('wavecms_page/main', 'Default meta title'),
            'default_meta_description' => \Yii::t('wavecms_page/main', 'Default meta description'),
            'default_meta_keywords' => \Yii::t('wavecms_page/main', 'Default meta keywords'),
            'top_javascript' => \Yii::t('wavecms_page/main', 'Top javascript'),
            'btm_javascript' => \Yii::t('wavecms_page/main', 'Bottom javascript'),
        ];
    }

}
