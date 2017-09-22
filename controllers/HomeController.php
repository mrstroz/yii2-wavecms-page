<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\web\Controller;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use Yii;

class HomeController extends Controller
{

    public function init()
    {
        /** @var Page $modelPage */
        $modelPage = Yii::createObject($this->module->models['Home']);
        /** @var PageLang $modelPageLang */
        $modelPageLang = Yii::createObject($this->module->models['HomeLang']);

        $this->heading = Yii::t('wavecms/page/main', 'Home page');
        $this->query = $modelPage::find()
            ->joinLang()
            ->andWhere(['type' => 'home']);
        $this->scenario = $modelPage::SCENARIO_HOME;

        parent::init();
    }


}