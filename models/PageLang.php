<?php

namespace mrstroz\wavecms\page\models;

use Yii;

/**
 * This is the model class for table "page_lang".
 *
 * @property string $id
 * @property string $page_id
 * @property string $language
 * @property string $title
 * @property string $link
 * @property string $text
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 */
class PageLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['text', 'language'], 'string'],
            [['title', 'link', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms/page/main', 'ID'),
            'page_id' => Yii::t('wavecms/base/main', 'Page ID'),
            'language' => Yii::t('wavecms/base/main', 'Language'),
            'title' => Yii::t('wavecms/base/main', 'Title'),
            'link' => Yii::t('wavecms/base/main', 'Link'),
            'text' => Yii::t('wavecms/base/main', 'Text'),
            'meta_title' => Yii::t('wavecms/base/main', 'Meta title'),
            'meta_description' => Yii::t('wavecms/base/main', 'Meta description'),
            'meta_keywords' => Yii::t('wavecms/page/base', 'Meta keywords'),
        ];
    }

    /**
     * @inheritdoc
     * @return PageLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageLangQuery(get_called_class());
    }

    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
