<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sortablegrid\SortableGridBehavior;
use mrstroz\wavecms\components\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\components\behaviors\SubListBehavior;
use mrstroz\wavecms\components\behaviors\TranslateBehavior;
use mrstroz\wavecms\page\models\query\MenuQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $type
 * @property integer $publish
 * @property string $sort
 * @property string $languages
 * @property string $page_id
 * @property string $page_blank
 */
class Menu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort'
            ],
            'submenu' => [
                'class' => SubListBehavior::className(),
                'listId' => 'submenu',
                'route' => '/wavecms-page/menu-children/sub-list',
                'parentField' => 'parent_id'
            ],
            'checkbox_list' => [
                'class' => CheckboxListBehavior::className(),
                'fields' => ['languages']
            ],
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'title', 'page_url'
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
            [['parent_id', 'publish', 'sort', 'page_id', 'page_blank'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['title', 'page_url'], 'string', 'max' => 255],
            [['languages', 'title'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'parent_id' => Yii::t('wavecms_page/main', 'Parent ID'),
            'type' => Yii::t('wavecms_page/main', 'Type'),
            'publish' => Yii::t('wavecms_page/main', 'Publish'),
            'sort' => Yii::t('wavecms_page/main', 'Sort'),
            'languages' => Yii::t('wavecms_page/main', 'Languages'),
            'page_id' => Yii::t('wavecms_page/main', 'Page'),
            'page_url' => Yii::t('wavecms_page/main', 'Url'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'page_blank' => Yii::t('wavecms_page/main', 'New tab'),
        ];
    }

    /**
     * @inheritdoc
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    public function getTranslations()
    {
        return $this->hasMany(MenuLang::className(), ['menu_id' => 'id']);
    }

}
