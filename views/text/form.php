<?php

use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
use mrstroz\wavecms\components\widgets\LanguagesWidget;
use mrstroz\wavecms\components\widgets\SubListWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use mrstroz\wavecms\metatags\components\widgets\MetaTagsWidget;
use mrstroz\wavecms\metatags\components\widgets\OgTagsWidget;
use mrstroz\wavecms\page\models\PageSettings;
use powerkernel\slugify\Slugify;
use yii\bootstrap\Html;

/** @var \mrstroz\wavecms\page\models\Page $model */

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'text']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <?php echo $form->field($model, 'title'); ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php echo $form->field($model, 'link')->widget(Slugify::className(), ['source' => '#page-title']) ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->field($model, 'template')->dropDownList(
                            array_merge(['' => Yii::t('wavecms_page/main', 'Text page')], $model::$templates)
                        ); ?>
                    </div>
                </div>

            </div>

            <div class="col-md-4 col-lg-3">
                <?php echo LanguagesWidget::widget([
                    'form' => $form,
                    'model' => $model
                ]); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'text')->widget(CKEditorWidget::className()) ?>
            </div>
        </div>
    </div>
</div>
<?php TabWidget::end(); ?>


<?php
$settingsModel = Yii::createObject(PageSettings::class);
if (Yii::$app->settings->get($settingsModel->formName(), 'is_page_slider') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Slider')]);

    echo SubListWidget::widget([
        'listId' => 'slider',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php
if (Yii::$app->settings->get($settingsModel->formName(), 'is_page_grid') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Grid')]);

    echo SubListWidget::widget([
        'listId' => 'grid',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php
if (Yii::$app->settings->get($settingsModel->formName(), 'is_page_sections') === '1') {

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
