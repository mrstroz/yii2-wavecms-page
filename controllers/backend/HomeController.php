<?php

namespace mrstroz\wavecms\page\controllers\backend;

use mrstroz\wavecms\base\web\Controller;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use Yii;

class HomeController extends Controller
{

    public function init()
    {

        $this->viewPath = '@wavecms_page/views/backend/home';

        $this->heading = Yii::t('wavecms/page/main', 'Home page');
        $this->query = Page::find()->leftJoin(PageLang::tableName(), PageLang::tableName() . '.page_id = ' . Page::tableName() . '.id')->andWhere(['type' => 'home']);
        $this->scenario = Page::SCENARIO_HOME;

        parent::init();
    }


}