<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\grid\SortColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Menu;
use Yii;

class MenuTopController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/menu-top'])) {
            $this->viewForm = $this->module->forms['page/menu-top'];
        }

        /** @var Menu $modelMenu */
        $modelMenu = Yii::createObject($this->module->models['Menu']);

        $this->heading = Yii::t('wavecms/page/main', 'Top menu');
        $this->query = $modelMenu::find()->andWhere(['type' => 'top']);

        $this->sort = true;

        $this->columns = array(
            [
                'attribute' => 'title',
            ],
            [
                'class' => LanguagesColumn::className(),
            ],
            [
                'class' => SortColumn::className(),
            ],
            [
                'class' => PublishColumn::className(),
            ],
            [
                'class' => ActionColumn::className(),
            ],
        );


        parent::init();
    }


}