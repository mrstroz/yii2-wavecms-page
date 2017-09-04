<?php

use modernkernel\slugify\Slugify;
use mrstroz\wavecms\base\helpers\FormHelper;
use mrstroz\wavecms\base\helpers\WavecmsForm;
use mrstroz\wavecms\base\widgets\CKEditorWidget;
use mrstroz\wavecms\base\widgets\MetaTagsWidget;
use mrstroz\wavecms\base\widgets\PanelWidget;
use mrstroz\wavecms\base\widgets\TabsWidget;
use mrstroz\wavecms\base\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'text']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <?php echo $form->field($model, 'title'); ?>
                <?php echo $form->field($model, 'link')->widget(Slugify::className(), ['source' => '#page-title']) ?>
            </div>

            <div class="col-md-4 col-lg-3">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms/page/main', 'Languages')]); ?>
                <?php echo Yii::t('wavecms/page/main', 'Page will be displayed in following languages:'); ?>
                <?php echo $form->field($model, 'languages')->checkboxList([
                    'pl' => 'PL',
                    'en' => 'EN',
                ])->label(false);
                ?>
                <?php PanelWidget::end(); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'text')->widget(CKEditorWidget::className())->label(false) ?>
            </div>
        </div>
    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'Meta tags')]); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo MetaTagsWidget::widget(['model' => $model, 'form' => $form]); ?>
    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
