<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\grid\SortColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\PageItem;
use Yii;

class HomeSliderController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/home-slider'])) {
            $this->viewForm = $this->module->forms['page/home-slider'];
        }

        /** @var PageItem $modelMenu */
        $modelMenu = Yii::createObject($this->module->models['HomeSlider']);

        $this->heading = Yii::t('wavecms/page/main', 'Slider');
        $this->query = $modelMenu::find()->andWhere(['type' => 'home-slider']);

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