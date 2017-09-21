<?php

namespace mrstroz\wavecms\page\models;

use Yii;

/**
 * This is the model class for table "page_item_lang".
 *
 * @property string $id
 * @property string $page_item_id
 * @property string $language
 * @property string $title
 * @property string $text
 * @property string $link_page_url
 */
class PageItemLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_item_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_item_id'], 'integer'],
            [['language'], 'string', 'max' => 10],
            [['text'], 'string'],
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
            'page_item_id' => Yii::t('wavecms/base/main', 'Page Item ID'),
            'language' => Yii::t('wavecms/base/main', 'Language'),
            'title' => Yii::t('wavecms/base/main', 'Title'),
            'text' => Yii::t('wavecms/base/main', 'Text'),
            'link_page_url' => Yii::t('wavecms/base/main', 'Url'),
        ];
    }

    /**
     * @inheritdoc
     * @return PageItemLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageItemLangQuery(get_called_class());
    }
}
