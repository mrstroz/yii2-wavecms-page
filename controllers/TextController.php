<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\CheckboxColumn;
use mrstroz\wavecms\components\grid\LanguagesColumn;
use mrstroz\wavecms\components\grid\PublishColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use mrstroz\wavecms\page\models\search\PageSearch;
use Yii;
use yii\data\ActiveDataProvider;

class TextController extends Controller
{

    public function init()
    {
        /** @var Page $modelPage */
        $modelPage = Yii::createObject(Page::class);
        /** @var PageLang $modelPageLang */
        $modelPageLang = Yii::createObject(PageLang::class);

        $this->heading = Yii::t('wavecms_page/main', 'Text pages');
        $this->query = $modelPage::find()
            ->joinLang()
            ->andWhere(['type' => 'text']);
        $this->scenario = $modelPage::SCENARIO_TEXT;

        $this->dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);

        $this->dataProvider->sort->attributes['title'] = [
            'asc' => [$modelPageLang::tableName() . '.title' => SORT_ASC],
            'desc' => [$modelPageLang::tableName() . '.title' => SORT_DESC],
        ];

        $this->dataProvider->sort->attributes['link'] = [
            'asc' => [$modelPageLang::tableName() . '.link' => SORT_ASC],
            'desc' => [$modelPageLang::tableName() . '.link' => SORT_DESC],
        ];

        $this->filterModel = Yii::createObject(PageSearch::class);

        $this->columns = array(
            [
                'class' => CheckboxColumn::className()
            ],
            'id',
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'link',
            ],
            [
                'attribute' => 'template',
                'content' => function ($model, $key, $index, $column) {
                    /** @var Page $model */
                    if ($model->template && isset(Page::$templates[$model->template])) {
                        return '<span class="label label-default">' . Page::$templates[$model->template] . '</span>';
                    }
                    return false;
                },
            ],
            [
                'class' => LanguagesColumn::className(),
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