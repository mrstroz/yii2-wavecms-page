<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\CheckboxColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\grid\SortColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Menu;
use Yii;

class MenuBottomController extends Controller
{

    public function init()
    {
        /** @var Menu $modelMenu */
        $modelMenu = Yii::createObject(Menu::class);

        $this->heading = Yii::t('wavecms_page/main', 'Bottom menu');
        $this->query = $modelMenu::find()->andWhere(['type' => 'bottom']);

        $this->sort = true;

        $this->columns = array(
            [
                'class' => CheckboxColumn::className()
            ],
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