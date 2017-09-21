<?php

namespace mrstroz\wavecms\page\models;

use himiklab\sortablegrid\SortableGridBehavior;
use mrstroz\wavecms\base\behaviors\CheckboxListBehavior;
use mrstroz\wavecms\base\behaviors\SubListBehavior;
use mrstroz\wavecms\base\behaviors\TranslateBehavior;
use Yii;
use yii\db\ActiveQuery;
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
                'route' => '/page/menu-children/sub-list',
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
            [['parent_id', 'publish', 'sort', 'page_id'], 'integer'],
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
            'id' => Yii::t('wavecms/base/main', 'ID'),
            'parent_id' => Yii::t('wavecms/base/main', 'Parent ID'),
            'type' => Yii::t('wavecms/base/main', 'Type'),
            'publish' => Yii::t('wavecms/base/main', 'Publish'),
            'sort' => Yii::t('wavecms/base/main', 'Sort'),
            'languages' => Yii::t('wavecms/base/main', 'Languages'),
            'page_id' => Yii::t('wavecms/base/main', 'Page'),
            'page_url' => Yii::t('wavecms/base/main', 'Url'),
            'title' => Yii::t('wavecms/base/main', 'Title'),
            'menuLangTitle' => Yii::t('wavecms/base/main', 'Title'),
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

    /**
     * Used in waveCMS grid column
     * @return ActiveQuery
     */
    public function getMenuLang()
    {
        $query = $this->hasOne(MenuLang::className(), ['menu_id' => 'id']);

        if (Yii::$app->id === 'app-backend') {
            $query->andWhere(['language' => Yii::$app->wavecms->editedLanguage]);
        } else {
            $query->andWhere(['language' => Yii::$app->language]);
        }

        return $query;
    }

    /**
     * Used in waveCMS grid column
     * @return bool|string
     */
    public function getMenuLangTitle()
    {
        if ($this->menuLang) {
            return $this->menuLang->title;
        }

        return false;
    }
}
