<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use Yii;

class HomeController extends Controller
{

    public function init()
    {
        $this->type = 'page';

        /** @var Page $modelPage */
        $modelPage = Yii::createObject(Page::class);
        /** @var PageLang $modelPageLang */
        $modelPageLang = Yii::createObject(PageLang::class);

        $this->heading = Yii::t('wavecms_page/main', 'Home page');
        $this->query = $modelPage::find()
            ->joinLang()
            ->andWhere(['type' => 'home']);
        $this->scenario = $modelPage::SCENARIO_HOME;

        parent::init();
    }


}