<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\grid\SortColumn;
use mrstroz\wavecms\base\helpers\NavHelper;
use mrstroz\wavecms\base\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class MenuChildrenController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/menu-children'])) {
            $this->viewForm = $this->module->forms['page/menu-children'];
        }

        /** @var ActiveRecord $modelMenu */
        $modelMenu = Yii::createObject($this->module->models['Menu']);

        $this->heading = Yii::t('wavecms/page/main', 'Submenu');
        $this->query = $modelMenu::find()->andWhere(['type' => 'children']);

        $this->sort = true;

        $this->columns = array(
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'languages',
                'content' => function ($data) {
                    $column = '';
                    if ($data->languages) {
                        foreach ($data->languages as $lang) {
                            $column .= '<span class="label label-default text-uppercase">' . $lang . '</span> ';
                        }
                    }
                    return $column;
                }
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