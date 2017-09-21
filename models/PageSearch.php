<?php

namespace mrstroz\wavecms\page\models;

use Yii;
use yii\data\ActiveDataProvider;

class PageSearch extends Page
{

    public $title;
    public $link;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'link'], 'safe'],
        ];
    }

    /**
     * @param $dataProvider ActiveDataProvider
     * @return mixed
     */
    public function search($dataProvider)
    {
        $params = Yii::$app->request->get();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $dataProvider->query->andFilterWhere(['or',
            [self::tableName() . '.id' => $this->id],
            ['like', PageLang::tableName() . '.title', $this->title],
            ['like', PageLang::tableName() . '.link', $this->link]
        ]);

        return $dataProvider;
    }


}
