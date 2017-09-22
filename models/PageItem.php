<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sortablegrid\SortableGridBehavior;
use mrstroz\wavecms\base\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\base\behaviors\ImageBehavior;
use mrstroz\wavecms\base\behaviors\TranslateBehavior;
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
            [['page_id', 'publish', 'sort', 'link_page_id'], 'integer'],
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
            'id' => Yii::t('wavecms/base/main', 'ID'),
            'page_id' => Yii::t('wavecms/base/main', 'Page'),
            'publish' => Yii::t('wavecms/base/main', 'Publish'),
            'sort' => Yii::t('wavecms/base/main', 'Sort'),
            'type' => Yii::t('wavecms/base/main', 'Type'),
            'title' => Yii::t('wavecms/base/main', 'Title'),
            'languages' => Yii::t('wavecms/base/main', 'Languages'),
            'image' => Yii::t('wavecms/base/main', 'Image'),
            'link_page_id' => Yii::t('wavecms/base/main', 'Page'),
            'link_page_url' => Yii::t('wavecms/base/main', 'Url'),
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

    public function getTranslations()
    {
        return $this->hasMany(PageItemLang::className(), ['page_item_id' => 'id']);
    }

}
