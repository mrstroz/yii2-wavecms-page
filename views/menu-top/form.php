<?php

use mrstroz\wavecms\base\helpers\FormHelper;
use mrstroz\wavecms\base\helpers\WavecmsForm;
use mrstroz\wavecms\base\widgets\LanguagesWidget;
use mrstroz\wavecms\base\widgets\PageLinkWidget;
use mrstroz\wavecms\base\widgets\SubListWidget;
use mrstroz\wavecms\base\widgets\TabsWidget;
use mrstroz\wavecms\base\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'top']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <?php echo $form->field($model, 'title'); ?>

                <?php echo PageLinkWidget::widget([
                    'form' => $form,
                    'model' => $model
                ]); ?>

            </div>

            <div class="col-md-4 col-lg-3">
                <?php echo LanguagesWidget::widget([
                    'form' => $form,
                    'model' => $model
                ]); ?>
            </div>
        </div>

    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/page/main', 'Submenu')]); ?>

<?php echo SubListWidget::widget([
    'list_id' => 'submenu',
    'model' => $model
]); ?>

<?php TabWidget::end(); ?>

<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
