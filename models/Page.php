<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\base\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\base\behaviors\SubListBehavior;
use mrstroz\wavecms\base\behaviors\TranslateBehavior;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property integer $publish
 * @property string $type
 * @property string $languages
 */
class Page extends \yii\db\ActiveRecord
{

    const SCENARIO_HOME = 'home';
    const SCENARIO_TEXT = 'text';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_TEXT] = $scenarios[self::SCENARIO_DEFAULT];
        $scenarios[self::SCENARIO_HOME] = [
            'publish',
            'type',
            'title',
            'text',
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];
        return $scenarios;
    }

    public function behaviors()
    {
        return [
            'checkbox_list' => [
                'class' => CheckboxListBehavior::className(),
                'fields' => ['languages']
            ],
            'home_slider' => [
                'class' => SubListBehavior::className(),
                'listId' => 'home_slider',
                'route' => '/page/home-slider/sub-list',
                'parentField' => 'page_id'
            ],
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'title', 'link', 'text', 'meta_title', 'meta_description', 'meta_keywords'
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['languages', 'title', 'link'], 'required'],
            [['publish'], 'integer'],
            [['link'], 'validateUniqueLink'],
            [['type'], 'string', 'max' => 255],
            [['text', 'meta_title', 'meta_description', 'meta_keywords'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms/page/main', 'ID'),
            'publish' => Yii::t('wavecms/base/main', 'Publish'),
            'type' => Yii::t('wavecms/base/main', 'Type'),
            'title' => Yii::t('wavecms/base/main', 'Title'),
            'link' => Yii::t('wavecms/base/main', 'Link'),
            'text' => Yii::t('wavecms/base/main', 'Text'),
            'languages' => Yii::t('wavecms/base/main', 'Languages'),
            'pageLangTitle' => Yii::t('wavecms/base/main', 'Title'),
            'pageLangLink' => Yii::t('wavecms/base/main', 'Link'),
            'meta_title' => Yii::t('wavecms/base/main', 'Meta title'),
            'meta_description' => Yii::t('wavecms/base/main', 'Meta description'),
            'meta_keywords' => Yii::t('wavecms/base/main', 'Meta keywords'),
        ];
    }

    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    /**
     * Required for Translate behaviour
     * @return ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PageLang::className(), ['page_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPageLang()
    {
        $query = $this->hasOne(PageLang::className(), ['page_id' => 'id']);

        if (Yii::$app->id === 'app-backend') {
            $query->andWhere(['language' => Yii::$app->wavecms->editedLanguage]);
        } else {
            $query->andWhere(['language' => Yii::$app->language]);
        }
        return $query;
    }

    /**
     * @return bool|ActiveQuery
     */
    public function getPageLangTitle()
    {
        if ($this->pageLang) {
            return $this->pageLang->title;
        }

        return false;
    }

    /**
     * @return bool|ActiveQuery
     */
    public function getPageLangLink()
    {
        if ($this->pageLang) {
            return $this->pageLang->link;
        }

        return false;
    }

    public function validateUniqueLink($attribute)
    {

        $params = Yii::$app->request->get();
        $query = PageLang::find()->joinWith('page')->andWhere([PageLang::tableName() . '.language' => Yii::$app->wavecms->editedLanguage, PageLang::tableName() . '.link' => $this->link]);

        if (isset($params['id'])) {
            $query->andWhere(['!=', Page::tableName() . '.id', $params['id']]);
        }

        if ($query->count() !== '0') {
            $this->addError($attribute, Yii::t('app', Yii::t('wavecms/page/main', 'Link should be unique.')));
        }
    }

}
