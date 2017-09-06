<?php

namespace mrstroz\wavecms\page\controllers;

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

        $modelPage = Yii::createObject($this->module->models['Page']);
        $modelPageLang = Yii::createObject($this->module->models['PageLang']);

        $this->heading = Yii::t('wavecms/page/main', 'Text pages');
        $this->query = $modelPage::find()->joinWith('pageLang')->andWhere(['type' => 'text']);
        $this->scenario = $modelPage::SCENARIO_TEXT;

        $this->dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);
        $this->dataProvider->sort->attributes['pageLangTitle'] = [
            'asc' => [$modelPageLang::tableName() . '.title' => SORT_ASC],
            'desc' => [$modelPageLang::tableName() . '.title' => SORT_DESC],
        ];
        $this->dataProvider->sort->attributes['pageLangLink'] = [
            'asc' => [$modelPageLang::tableName() . '.link' => SORT_ASC],
            'desc' => [$modelPageLang::tableName() . '.link' => SORT_DESC],
        ];


        $this->filterModel = new PageSearch();

        $this->columns = array(
            'id',
            [
                'attribute' => 'pageLangTitle',
            ],
            [
                'attribute' => 'pageLangLink',
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