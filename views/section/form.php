<?php

use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
use mrstroz\wavecms\components\widgets\ImageWidget;
use mrstroz\wavecms\components\widgets\LanguagesWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use mrstroz\wavecms\page\components\widgets\PageLinkWidget;
use yii\bootstrap\Html;

/** @var \mrstroz\wavecms\page\models\PageItem $model */

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'section']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="col-md-9">
                        <?= $form->field($model, 'title'); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'template')->dropDownList($model::$templates) ?>
                    </div>
                </div>

                <?= $form->field($model, 'text')->widget(CKEditorWidget::className()) ?>
            </div>

            <div class="col-md-4 col-lg-3">
                <?= LanguagesWidget::widget([
                    'form' => $form,
                    'model' => $model
                ]); ?>

                <?= $form->field($model, 'image')->widget(ImageWidget::className()) ?>
                <?= $form->field($model, 'image_mobile')->widget(ImageWidget::className()) ?>

            </div>
        </div>

    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Link')]); ?>
<?php echo $form->field($model, 'link_title'); ?>
<?php echo PageLinkWidget::widget([
    'form' => $form,
    'model' => $model,
    'idAttribute' => 'link_page_id',
    'urlAttribute' => 'link_page_url',
    'blankAttribute' => 'link_page_blank',
]); ?>

<?php TabWidget::end(); ?>

<?php TabsWidget::end(); ?>

<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
