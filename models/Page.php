<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use mrstroz\wavecms\components\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\components\behaviors\SubListBehavior;
use mrstroz\wavecms\components\behaviors\TranslateBehavior;
use mrstroz\wavecms\page\models\query\PageQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property integer $publish
 * @property string $type
 * @property string $template
 * @property string $languages
 */
class Page extends ActiveRecord
{

    const SCENARIO_HOME = 'home';
    const SCENARIO_TEXT = 'text';

    static public $templates = [
    ];

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
            'text'
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
                'route' => '/wavecms-page/home-slider/sub-list',
                'parentField' => 'page_id'
            ],
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'title', 'link', 'text'
                ]
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ],
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var PageQuery $model */
                    $model->byAllCriteria()->byType(['text']);
                },
                'dataClosure' => function ($model) {
                    return [
                        'loc' => Url::to(['/' . $model->link], true),
                        'lastmod' => $model->updated_at,
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
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
            [['type', 'template'], 'string', 'max' => 255],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'publish' => Yii::t('wavecms_page/main', 'Publish'),
            'type' => Yii::t('wavecms_page/main', 'Type'),
            'template' => Yii::t('wavecms_page/main', 'Template'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'link' => Yii::t('wavecms_page/main', 'Link'),
            'text' => Yii::t('wavecms_page/main', 'Text'),
            'languages' => Yii::t('wavecms_page/main', 'Languages'),
            'pageLangTitle' => Yii::t('wavecms_page/main', 'Title'),
            'pageLangLink' => Yii::t('wavecms_page/main', 'Link')
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
     * PageItem relation
     * @return ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(PageItem::className(), ['page_id' => 'id']);
    }

    /**
     * Validator for unique link per language
     * @param $attribute
     * @return void
     */
    public function validateUniqueLink($attribute)
    {

        $params = Yii::$app->request->get();
        $query = PageLang::find()->joinWith('page')->andWhere([PageLang::tableName() . '.language' => Yii::$app->wavecms->editedLanguage, PageLang::tableName() . '.link' => $this->link]);

        if (isset($params['id'])) {
            $query->andWhere(['!=', Page::tableName() . '.id', $params['id']]);
        }

        if ($query->count() !== '0') {
            $this->addError($attribute, Yii::t('app', Yii::t('wavecms_page/main', 'Link should be unique.')));
        }
    }

}
