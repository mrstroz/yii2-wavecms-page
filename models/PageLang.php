<?php

namespace mrstroz\wavecms\page\models;

use mrstroz\wavecms\page\models\query\PageLangQuery;
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
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_page/main', 'ID'),
            'page_id' => Yii::t('wavecms_page/main', 'Page ID'),
            'language' => Yii::t('wavecms_page/main', 'Language'),
            'title' => Yii::t('wavecms_page/main', 'Title'),
            'link' => Yii::t('wavecms_page/main', 'Link'),
            'text' => Yii::t('wavecms_page/main', 'Text'),
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
