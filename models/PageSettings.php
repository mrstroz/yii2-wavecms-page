<?php

namespace mrstroz\wavecms\page\models;

use yii\base\Model;

class PageSettings extends Model
{

    public $is_top_submenu;
    public $is_bottom_submenu;
    public $is_home_slider;

    public function rules()
    {
        return [
            [['is_top_submenu', 'is_bottom_submenu', 'is_home_slider'], 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'is_top_submenu' => \Yii::t('wavecms/page/main','Top submenu'),
            'is_bottom_submenu' => \Yii::t('wavecms/page/main','Bottom submenu'),
            'is_home_slider' => \Yii::t('wavecms/page/main','Home slider'),
        ];
    }

}
