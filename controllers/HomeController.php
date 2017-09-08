<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\web\Controller;
use Yii;

class HomeController extends Controller
{

    public function init()
    {
        $modelPage = Yii::createObject($this->module->models['Home']);
        $modelPageLang = Yii::createObject($this->module->models['HomeLang']);

        $this->heading = Yii::t('wavecms/page/main', 'Home page');
        $this->query = $modelPage::find()->leftJoin($modelPageLang::tableName(), $modelPageLang::tableName() . '.page_id = ' . $modelPage::tableName() . '.id')->andWhere(['type' => 'home']);
        $this->scenario = $modelPage::SCENARIO_HOME;

        parent::init();
    }


}