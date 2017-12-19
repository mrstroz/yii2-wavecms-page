<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sortablegrid\SortableGridBehavior;
use mrstroz\wavecms\components\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\components\behaviors\ImageBehavior;
use mrstroz\wavecms\components\behaviors\TranslateBehavior;
use mrstroz\wavecms\page\models\query\PageItemQuery;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "page_item".
 *
 * @property string $id
 * @property string $page_id
 * @property integer $publish
 * @property string $sort
 * @property string $type
 * @property string $languages
 * @property string $image
 * @property string $link_page_id
 * @property string $link_page_blank
 */
class PageItem extends \yii\db\ActiveRecord
{

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
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'title', 'text', 'link_page_url'
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
            [['type', 'image'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['languages', 'title'], 'required'],
            [['title', 'link_page_url'], 'string', 'max' => 255],
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
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'languages' => Yii::t('wavecms_page/main', 'Languages'),
            'image' => Yii::t('wavecms_page/main', 'Image'),
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
     * @return ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PageItemLang::className(), ['page_item_id' => 'id']);
    }

    /**
     * Page relation
     * @return ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }


}
