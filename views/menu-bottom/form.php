<?php

use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\LanguagesWidget;
use mrstroz\wavecms\components\widgets\SubListWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use mrstroz\wavecms\page\components\widgets\PageLinkWidget;
use mrstroz\wavecms\page\models\PageSettings;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'bottom']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'General')]); ?>
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


<?php
$settingsModel = Yii::createObject(PageSettings::class);
if (Yii::$app->settings->get($settingsModel->formName(), 'is_bottom_submenu') === '1') {

    TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Submenu')]);

    echo SubListWidget::widget([
        'listId' => 'submenu',
        'model' => $model
    ]);

    TabWidget::end();
}
?>

<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
