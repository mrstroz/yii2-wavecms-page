<?php

namespace mrstroz\wavecms\page;

class Module extends \yii\base\Module
{
    public $models = [];
    public $forms = [];

    public function init()
    {
        if (!isset($this->models['Home'])) {
            $this->models['Home'] = 'mrstroz\wavecms\page\models\Page';
        }
        if (!isset($this->models['HomeLang'])) {
            $this->models['HomeLang'] = 'mrstroz\wavecms\page\models\PageLang';
        }

        if (!isset($this->models['Page'])) {
            $this->models['Page'] = 'mrstroz\wavecms\page\models\Page';
        }
        if (!isset($this->models['PageLang'])) {
            $this->models['PageLang'] = 'mrstroz\wavecms\page\models\PageLang';
        }

        if (!isset($this->models['HomeSlider'])) {
            $this->models['HomeSlider'] = 'mrstroz\wavecms\page\models\PageItem';
        }
        if (!isset($this->models['HomeSliderLang'])) {
            $this->models['HomeSliderLang'] = 'mrstroz\wavecms\page\models\PageItemLang';
        }

        if (!isset($this->models['Menu'])) {
            $this->models['Menu'] = 'mrstroz\wavecms\page\models\Menu';
        }
        if (!isset($this->models['MenuLang'])) {
            $this->models['MenuLang'] = 'mrstroz\wavecms\page\models\MenuLang';
        }

        if (!isset($this->models['Settings'])) {
            $this->models['Settings'] = 'mrstroz\wavecms\page\models\PageSettings';
        }

        $this->controllerNamespace = 'mrstroz\wavecms\page\controllers';

        parent::init();
    }

}
