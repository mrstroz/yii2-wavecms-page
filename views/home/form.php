<?php

use mrstroz\wavecms\base\helpers\FormHelper;
use mrstroz\wavecms\base\helpers\WavecmsForm;
use mrstroz\wavecms\base\widgets\CKEditorWidget;
use mrstroz\wavecms\base\widgets\MetaTagsWidget;
use mrstroz\wavecms\base\widgets\SubListWidget;
use mrstroz\wavecms\base\widgets\TabsWidget;
use mrstroz\wavecms\base\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>
<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'home']); ?>
<?php echo Html::activeHiddenInput($model, 'publish', ['value' => 1]); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>
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

<?php TabWidget::begin(['heading' => Yii::t('wavecms/page/main', 'Slider')]); ?>

<?php echo SubListWidget::widget([
    'listId' => 'home_slider',
    'model' => $model
]); ?>

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
