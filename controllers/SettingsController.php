<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\PageSettings;
use Yii;

class SettingsController extends Controller
{

    public function init()
    {
        $this->type = 'settings';

        $this->modelClass = PageSettings::class;
        $this->heading = Yii::t('wavecms_page/main', 'Settings');

        $this->on(self::EVENT_AFTER_MODEL_SAVE, function ($event) {
            if (Yii::$app->cacheFrontend) {
                Yii::$app->cacheFrontend->flush();
            }
        });

        parent::init();
    }


}