<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\LanguagesColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\grid\SortColumn;
use mrstroz\wavecms\base\web\Controller;
use Yii;
use yii\db\ActiveRecord;

class MenuBottomController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/menu-top'])) {
            $this->viewForm = $this->module->forms['page/menu-top'];
        }

        /** @var ActiveRecord $modelMenu */
        $modelMenu = Yii::createObject($this->module->models['Menu']);

        $this->heading = Yii::t('wavecms/page/main', 'Bottom menu');
        $this->query = $modelMenu::find()->andWhere(['type' => 'bottom']);

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