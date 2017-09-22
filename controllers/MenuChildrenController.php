<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\LanguagesColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\grid\SortColumn;
use mrstroz\wavecms\base\helpers\NavHelper;
use mrstroz\wavecms\base\web\Controller;
use mrstroz\wavecms\page\models\Menu;
use Yii;

class MenuChildrenController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/menu-children'])) {
            $this->viewForm = $this->module->forms['page/menu-children'];
        }

        /** @var Menu $modelMenu */
        $modelMenu = Yii::createObject($this->module->models['Menu']);

        $this->heading = Yii::t('wavecms/page/main', 'Submenu');
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