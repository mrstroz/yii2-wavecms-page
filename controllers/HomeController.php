<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\web\Controller;
use Yii;
use yii\db\ActiveRecord;

class HomeController extends Controller
{

    public function init()
    {
        /** @var ActiveRecord $modelPage */
        $modelPage = Yii::createObject($this->module->models['Home']);
        /** @var ActiveRecord $modelPageLang */
        $modelPageLang = Yii::createObject($this->module->models['HomeLang']);

        $this->heading = Yii::t('wavecms/page/main', 'Home page');
        $this->query = $modelPage::find()
            ->joinPageLang()
            ->andWhere(['type' => 'home']);
        $this->scenario = $modelPage::SCENARIO_HOME;

        parent::init();
    }


}