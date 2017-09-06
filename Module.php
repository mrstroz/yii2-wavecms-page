<?php

namespace mrstroz\wavecms\page;

class Module extends \yii\base\Module
{
    public $models = [];
    public $forms = [];

    public function init()
    {
        if (!isset($this->models['Page'])) {
            $this->models['Page'] = 'mrstroz\wavecms\page\models\Page';
        }
        if (!isset($this->models['PageLang'])) {
            $this->models['PageLang'] = 'mrstroz\wavecms\page\models\PageLang';
        }
        if (!isset($this->models['Menu'])) {
            $this->models['Menu'] = 'mrstroz\wavecms\page\models\Menu';
        }
        if (!isset($this->models['MenuLang'])) {
            $this->models['MenuLang'] = 'mrstroz\wavecms\page\models\MenuLang';
        }

        $this->controllerNamespace = 'mrstroz\wavecms\page\controllers';

        parent::init();
    }

}
