<?php

namespace mrstroz\wavecms\page\controllers\backend;

use mrstroz\wavecms\base\grid\ActionColumn;
use mrstroz\wavecms\base\grid\PublishColumn;
use mrstroz\wavecms\base\web\Controller;
use mrstroz\wavecms\page\models\Page;
use mrstroz\wavecms\page\models\PageLang;
use mrstroz\wavecms\page\models\PageSearch;
use Yii;
use yii\data\ActiveDataProvider;

class TextController extends Controller
{

    public function init()
    {
        $this->viewPath = '@wavecms_page/views/backend/text';

        $this->heading = Yii::t('wavecms/page/main', 'Text pages');
        $this->query = Page::find()->leftJoin(PageLang::tableName(), PageLang::tableName() . '.page_id = ' . Page::tableName() . '.id')->andWhere(['type' => 'text']);
        $this->scenario = Page::SCENARIO_TEXT;

        $this->dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);
        $this->dataProvider->sort->attributes['pageLangTitle'] = [
            'asc' => [PageLang::tableName() . '.title' => SORT_ASC],
            'desc' => [PageLang::tableName() . '.title' => SORT_DESC],
        ];
        $this->dataProvider->sort->attributes['pageLangLink'] = [
            'asc' => [PageLang::tableName() . '.link' => SORT_ASC],
            'desc' => [PageLang::tableName() . '.link' => SORT_DESC],
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