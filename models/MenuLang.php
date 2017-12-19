<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\page\models\query\MenuLangQuery;
use Yii;

/**
 * This is the model class for table "menu_lang".
 *
 * @property string $id
 * @property string $menu_id
 * @property string $language
 * @property string $title
 * @property string $page_url
 */
class MenuLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
            [['title', 'page_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'menu_id' => Yii::t('wavecms_page/main', 'Menu ID'),
            'language' => Yii::t('wavecms_page/main', 'Language'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'page_url' => Yii::t('wavecms_page/main', 'Url'),
        ];
    }

    /**
     * @inheritdoc
     * @return MenuLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuLangQuery(get_called_class());
    }
}
