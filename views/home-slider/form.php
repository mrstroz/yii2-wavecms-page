<?php

use mrstroz\wavecms\base\helpers\FormHelper;
use mrstroz\wavecms\base\helpers\WavecmsForm;
use mrstroz\wavecms\base\widgets\CKEditorWidget;
use mrstroz\wavecms\base\widgets\ImageWidget;
use mrstroz\wavecms\base\widgets\LanguagesWidget;
use mrstroz\wavecms\base\widgets\PageLinkWidget;
use mrstroz\wavecms\base\widgets\TabsWidget;
use mrstroz\wavecms\base\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'home-slider']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <?php echo $form->field($model, 'title'); ?>

                <?php echo PageLinkWidget::widget([
                    'form' => $form,
                    'model' => $model,
                    'idAttribute' => 'link_page_id',
                    'urlAttribute' => 'link_page_url'
                ]); ?>

                <?= $form->field($model, 'text')->widget(CKEditorWidget::className()) ?>

            </div>

            <div class="col-md-4 col-lg-3">
                <?php echo LanguagesWidget::widget([
                    'form' => $form,
                    'model' => $model
                ]); ?>

                <?= $form->field($model, 'image')->widget(ImageWidget::className()) ?>

            </div>
        </div>

    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabsWidget::end(); ?>

<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>