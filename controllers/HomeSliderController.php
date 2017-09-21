<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\grid\SortColumn;
use mrstroz\wavecms\base\web\Controller;
use Yii;

class HomeSliderController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/home-slider'])) {
            $this->viewForm = $this->module->forms['page/home-slider'];
        }

        $modelMenu = Yii::createObject($this->module->models['HomeSlider']);

        $this->heading = Yii::t('wavecms/page/main', 'Slider');
        $this->query = $modelMenu::find()->joinWith('pageItemLang')->andWhere(['type' => 'home-slider']);

        $this->sort = true;

        $this->columns = array(
            [
                'attribute' => 'pageItemLangTitle',
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