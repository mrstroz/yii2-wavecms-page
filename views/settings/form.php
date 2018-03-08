<?php

use dosamigos\switchinput\SwitchBox;
use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\ImageWidget;
use mrstroz\wavecms\components\widgets\PanelWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'text']); ?>


<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'General')]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Meta')]); ?>
                <?php echo $form->field($model, 'favicon')->widget(ImageWidget::className()); ?>
                <?php // echo $form->field($model, 'default_meta_title'); ?>
                <?php // echo $form->field($model, 'default_meta_description')->textarea(['rows' => 5]); ?>
                <?php // echo $form->field($model, 'default_meta_keywords')->textarea(['rows' => 5]); ?>
                <?php PanelWidget::end(); ?>
            </div>
            <div class="col-md-8">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Javascript')]); ?>
                <?php echo $form->field($model, 'top_javascript')->textarea(['rows' => 15])
                    ->hint(Yii::t('wavecms_page/main', 'Without &lt;script&gt; tag')); ?>
                <?php echo $form->field($model, 'btm_javascript')->textarea(['rows' => 15])
                    ->hint(Yii::t('wavecms_page/main', 'Without &lt;script&gt; tag')); ?>
                <?php PanelWidget::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php TabWidget::end(); ?>


<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Settings')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-6">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Menu')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'is_top_submenu')
                            ->widget(SwitchBox::className(), [
                                'options' => [
                                    'label' => false
                                ],
                                'clientOptions' => [
                                    'onColor' => 'success',
                                ]
                            ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'is_bottom_submenu')
                            ->widget(SwitchBox::className(), [
                                'options' => [
                                    'label' => false
                                ],
                                'clientOptions' => [
                                    'onColor' => 'success',
                                ]
                            ]); ?>
                    </div>
                </div>
                <?php PanelWidget::end(); ?>
            </div>
            <div class="col-md-6">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Pages')]); ?>
                <?php echo $form->field($model, 'is_home_slider')->widget(SwitchBox::className(), [
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'onColor' => 'success',
                    ]
                ]); ?>
                <?php PanelWidget::end(); ?>
            </div>
        </div>


    </div>
</div>
<?php TabWidget::end(); ?>


<?php TabsWidget::end(); ?>
<?php FormHelper::saveButton() ?>
<?php WavecmsForm::end(); ?>
