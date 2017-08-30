<?php

use modernkernel\slugify\Slugify;
use mrstroz\wavecms\base\helpers\FormHelper;
use mrstroz\wavecms\base\helpers\WavecmsForm;
use mrstroz\wavecms\base\widgets\CKEditorWidget;
use mrstroz\wavecms\base\widgets\MetaTagsWidget;
use mrstroz\wavecms\base\widgets\PanelWidget;
use yii\bootstrap\Html;
use yii\bootstrap\Tabs;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'home']); ?>

<?php ob_start(); ?>
<div class="row">

    <div class="col-md-12">
        <?php PanelWidget::begin(['heading' => Yii::t('wavecms/base/main', 'Required'), 'panel_class' => 'panel-success']); ?>

        <div class="row">
            <div class="col-md-12">
                <?php echo $form->field($model, 'title'); ?>
            </div>
        </div>

        <?php PanelWidget::end(); ?>

        <?php PanelWidget::begin(['heading' => Yii::t('wavecms/base/main', 'Text')]); ?>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'text')->widget(CKEditorWidget::className())->label(false) ?>
            </div>
        </div>

        <?php PanelWidget::end(); ?>

    </div>


</div>


<?php
$tab1 = ob_get_contents();
ob_end_clean();
?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo MetaTagsWidget::widget(['model' => $model,'form' => $form]); ?>
    </div>
</div>

<?php
$tab2 = ob_get_contents();
ob_end_clean();
?>

<?php echo Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('wavecms/base/main', 'General'),
            'content' => $tab1,
            'active' => true
        ],
        [
            'label' => Yii::t('wavecms/base/main', 'Meta tags'),
            'content' => $tab2
        ]
    ]
]);

?>


<?php FormHelper::saveButton() ?>

<?php WavecmsForm::end(); ?>
