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

        $this->controllerNamespace = 'mrstroz\wavecms\page\controllers';

        parent::init();
    }

}
