<?php

namespace mrstroz\wavecms\page\controllers;

use mrstroz\wavecms\base\db\ActiveRecord;
use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\web\Controller;
use mrstroz\wavecms\page\models\PageSearch;
use Yii;
use yii\data\ActiveDataProvider;

class TextController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['page/text'])) {
            $this->viewForm = $this->module->forms['page/text'];
        }

        /** @var ActiveRecord $modelPage */
        $modelPage = Yii::createObject($this->module->models['Page']);
        /** @var ActiveRecord $modelPageLang */
        $modelPageLang = Yii::createObject($this->module->models['PageLang']);

        $this->heading = Yii::t('wavecms/page/main', 'Text pages');
        $this->query = $modelPage::find()
            ->joinPageLang()
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


        $this->filterModel = new PageSearch();

        $this->columns = array(
            'id',
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'link',
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
                'class' => PublishColumn::className(),
            ],
            [
                'class' => ActionColumn::className(),
            ],
        );


        parent::init();
    }


}