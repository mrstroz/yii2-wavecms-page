<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\web\Controller;
use Yii;

class SettingsController extends Controller
{

    public function init()
    {
        $this->type = 'settings';
        if (isset($this->module->forms['page/settings'])) {
            $this->viewForm = $this->module->forms['page/settings'];
        }

        $this->modelClass = $this->module->models['Settings'];
        $this->heading = Yii::t('wavecms/base/main', 'Settings');

        parent::init();
    }


}