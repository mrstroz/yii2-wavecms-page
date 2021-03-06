<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sortablegrid\SortableGridBehavior;
use mrstroz\wavecms\components\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\components\behaviors\ImageBehavior;
use mrstroz\wavecms\components\behaviors\TranslateBehavior;
use mrstroz\wavecms\page\models\query\PageItemLangQuery;
use mrstroz\wavecms\page\models\query\PageItemQuery;
use mrstroz\wavecms\page\models\query\PageQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_item".
 *
 * Attributes form PageItem
 * @property string $id
 * @property string $page_id
 * @property integer $publish
 * @property string $sort
 * @property string $type
 * @property string $template
 * @property string $languages
 * @property string $image
 * @property string $image_mobile
 * @property string $link_rel
 * @property string $link_page_id
 * @property string $link_page_blank
 *
 * Attributes form PageItemLang
 * @property string $title
 * @property string $text
 * @property string $link_title
 * @property string $link_page_url
 *
 * Relations
 * @property PageItemLang[] $translations
 * @property Page $page
 *
 */
class PageItem extends ActiveRecord
{

    static public $templates = [
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_item';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort'
            ],
            'checkbox_list' => [
                'class' => CheckboxListBehavior::className(),
                'fields' => ['languages']
            ],
            'image' => [
                'class' => ImageBehavior::className(),
                'attribute' => 'image',
            ],
            'image_mobile' => [
                'class' => ImageBehavior::className(),
                'attribute' => 'image_mobile',
            ],
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'title', 'text', 'link_title', 'link_page_url'
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
            [['page_id', 'publish', 'sort', 'link_page_id', 'link_page_blank'], 'integer'],
            [['type', 'template'], 'string', 'max' => 255],
            [['image', 'image_mobile'], 'image'],
            [['languages', 'title'], 'required'],
            [['title', 'link_title', 'link_rel', 'link_page_url'], 'string', 'max' => 255],
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'page_id' => Yii::t('wavecms_page/main', 'Page'),
            'publish' => Yii::t('wavecms_page/main', 'Publish'),
            'sort' => Yii::t('wavecms_page/main', 'Sort'),
            'type' => Yii::t('wavecms_page/main', 'Type'),
            'template' => Yii::t('wavecms_page/main', 'Template'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'text' => Yii::t('wavecms_page/main', 'Text'),
            'languages' => Yii::t('wavecms_page/main', 'Languages'),
            'image' => Yii::t('wavecms_page/main', 'Image'),
            'image_mobile' => Yii::t('wavecms_page/main', 'Image mobile'),
            'link_title' => Yii::t('wavecms_page/main', 'Link title'),
            'link_rel' => Yii::t('wavecms_page/main', 'Link rel'),
            'link_page_id' => Yii::t('wavecms_page/main', 'Page'),
            'link_page_url' => Yii::t('wavecms_page/main', 'Url'),
            'link_page_blank' => Yii::t('wavecms_page/main', 'New tab')
        ];
    }

    /**
     * @inheritdoc
     * @return PageItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageItemQuery(get_called_class());
    }

    /**
     * Required for Translate behaviour
     * @return ActiveQuery|PageItemLangQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PageItemLang::class, ['page_item_id' => 'id']);
    }

    /**
     * Page relation
     * @return ActiveQuery|PageQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }


}
