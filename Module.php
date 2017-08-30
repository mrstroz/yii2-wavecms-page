<?php

namespace mrstroz\wavecms\page;

use Yii;

class Module extends \yii\base\Module
{

    public function init()
    {
        if ( Yii::$app->id === 'app-backend' ) {
            $this->controllerNamespace = 'mrstroz\wavecms\page\controllers\backend';
        } else {
            $this->controllerNamespace = 'mrstroz\wavecms\page\controllers\frontend';
        }

        parent::init();
    }

}
