<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\grid\SortColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\PageItem;
use Yii;
use yii\grid\DataColumn;

class SectionController extends Controller
{

    public function init()
    {
        /** @var PageItem $modelMenu */
        $modelMenu = Yii::createObject(PageItem::class);

        $this->heading = Yii::t('wavecms_page/main', 'Sections');
        $this->query = $modelMenu::find()->andWhere(['type' => 'section']);

        $this->sort = true;

        $this->columns = array(
            [
                'attribute' => 'title',
            ],
            [
                'class' => DataColumn::class,
                'attribute' => 'template',
                'content' => function ($model) {
                    /** @var PageItem $model */
                    if (isset(PageItem::$templates[$model->template])) {
                        return PageItem::$templates[$model->template];
                    }
                }
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