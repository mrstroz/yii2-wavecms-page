<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\grid\SortColumn;
use mrstroz\wavecms\base\web\Controller;
use Yii;

class MenuBottomController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/menu-top'])) {
            $this->viewForm = $this->module->forms['page/menu-top'];
        }

        $modelMenu = Yii::createObject($this->module->models['Menu']);

        $this->heading = Yii::t('wavecms/page/main', 'Bottom menu');
        $this->query = $modelMenu::find()->joinWith('menuLang')->andWhere(['type' => 'bottom']);

        $this->sort = true;

        $this->columns = array(
            [
                'attribute' => 'menuLangTitle',
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


        parent::init();
    }


}