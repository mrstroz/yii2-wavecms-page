<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\page\models\query\PageItemLangQuery;
use Yii;

/**
 * This is the model class for table "page_item_lang".
 *
 * @property string $id
 * @property string $page_item_id
 * @property string $language
 * @property string $title
 * @property string $text
 * @property string $link_title
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
            [['title', 'link_title', 'link_page_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'page_item_id' => Yii::t('wavecms_page/main', 'Page Item ID'),
            'language' => Yii::t('wavecms_page/main', 'Language'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'text' => Yii::t('wavecms_page/main', 'Text'),
            'link_title' => Yii::t('wavecms_page/main', 'Link title'),
            'link_page_url' => Yii::t('wavecms_page/main', 'Url'),
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
