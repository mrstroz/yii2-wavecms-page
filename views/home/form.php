<?php

use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
use mrstroz\wavecms\components\widgets\SubListWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use mrstroz\wavecms\metatags\components\widgets\MetaTagsWidget;
use mrstroz\wavecms\metatags\components\widgets\OgTagsWidget;
use mrstroz\wavecms\page\models\PageSettings;
use yii\bootstrap\Html;

/** @var \mrstroz\wavecms\page\models\Page $model */

?>

<?php $form = WavecmsForm::begin(); ?>
<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'home']); ?>
<?php echo Html::activeHiddenInput($model, 'publish', ['value' => 1]); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'General')]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <?php echo $form->field($model, 'title'); ?>
                <?php echo $form->field($model, 'text')->widget(CKEditorWidget::className()) ?>
            </div>
        </div>
    </div>
</div>
<?php TabWidget::end(); ?>

<?php
$settingsModel = Yii::createObject(PageSettings::class);
if (Yii::$app->settings->get($settingsModel->formName(), 'is_home_slider') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Slider')]);

    echo SubListWidget::widget([
        'listId' => 'slider',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php
if (Yii::$app->settings->get($settingsModel->formName(), 'is_home_grid') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Grid')]);

    echo SubListWidget::widget([
        'listId' => 'grid',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php
if (Yii::$app->settings->get($settingsModel->formName(), 'is_home_sections') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Sections')]);

    echo SubListWidget::widget([
        'listId' => 'section',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Meta tags')]); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo MetaTagsWidget::widget(['model' => $model->metaTags, 'form' => $form]); ?>
        <?php echo OgTagsWidget::widget(['model' => $model->metaTags, 'form' => $form]); ?>
    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
