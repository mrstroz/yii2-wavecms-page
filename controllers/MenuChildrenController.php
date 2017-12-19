<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\grid\SortColumn;
use mrstroz\wavecms\components\helpers\NavHelper;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Menu;
use Yii;

class MenuChildrenController extends Controller
{

    public function init()
    {
        /** @var Menu $modelMenu */
        $modelMenu = Yii::createObject(Menu::class);

        $this->heading = Yii::t('wavecms_page/main', 'Submenu');
        $this->query = $modelMenu::find()->andWhere(['type' => 'children']);

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

        $parentRoute = explode('/', Yii::$app->request->getQueryParam('parentRoute'));
        if (count($parentRoute) > 2) {
            NavHelper::$active[] = $parentRoute[0] . '/' . $parentRoute[1] . '/index';
        }
        parent::init();
    }


}