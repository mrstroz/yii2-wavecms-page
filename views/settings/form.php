<?php

use dosamigos\switchinput\SwitchBox;
use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\PanelWidget;
use mrstroz\wavecms\components\widgets\TabsWidget;
use mrstroz\wavecms\components\widgets\TabWidget;
use yii\bootstrap\Html;

?>

<?php $form = WavecmsForm::begin(); ?>

<?php TabsWidget::begin(); ?>

<?php echo Html::activeHiddenInput($model, 'type', ['value' => 'text']); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms/base/main', 'General')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-6">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms/base/main', 'Menu')]); ?>
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
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms/page/main', 'Pages')]); ?>
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
