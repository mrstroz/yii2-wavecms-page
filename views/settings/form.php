<?php

use dosamigos\switchinput\SwitchBox;
use mrstroz\wavecms\components\helpers\FormHelper;
use mrstroz\wavecms\components\helpers\WavecmsForm;
use mrstroz\wavecms\components\widgets\CKEditorWidget;
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

        </div>
    </div>
</div>
<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Footer')]); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'footer_copyright')->widget(CKEditorWidget::class, ['height' => 200]); ?>
    </div>
</div>

<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Javascript')]); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'top_javascript')->textarea(['rows' => 25])
            ->hint(Yii::t('wavecms_page/main', 'Without &lt;script&gt; tag')); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'btm_javascript')->textarea(['rows' => 25])
            ->hint(Yii::t('wavecms_page/main', 'Without &lt;script&gt; tag')); ?>
    </div>
</div>

<?php TabWidget::end(); ?>

<?php TabWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Settings')]); ?>
<div class="row">

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-3">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Menu')]); ?>
                <?php echo $form->field($model, 'is_top_submenu')
                    ->widget(SwitchBox::className(), [
                        'options' => [
                            'label' => false
                        ],
                        'clientOptions' => [
                            'onColor' => 'success',
                        ]
                    ]); ?>
                <?php echo $form->field($model, 'is_bottom_submenu')
                    ->widget(SwitchBox::className(), [
                        'options' => [
                            'label' => false
                        ],
                        'clientOptions' => [
                            'onColor' => 'success',
                        ]
                    ]); ?>
                <?php PanelWidget::end(); ?>
            </div>
            <div class="col-md-3">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Home page')]); ?>
                <?php echo $form->field($model, 'is_home_slider')->widget(SwitchBox::className(), [
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'onColor' => 'success',
                    ]
                ]); ?>

                <?php echo $form->field($model, 'is_home_grid')->widget(SwitchBox::className(), [
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'onColor' => 'success',
                    ]
                ]); ?>

                <?php echo $form->field($model, 'is_home_sections')->widget(SwitchBox::className(), [
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'onColor' => 'success',
                    ]
                ]); ?>
                <?php PanelWidget::end(); ?>
            </div>
            <div class="col-md-3">
                <?php PanelWidget::begin(['heading' => Yii::t('wavecms_page/main', 'Text pages')]); ?>

                <?php echo $form->field($model, 'is_page_grid')->widget(SwitchBox::className(), [
                    'options' => [
                        'label' => false
                    ],
                    'clientOptions' => [
                        'onColor' => 'success',
                    ]
                ]); ?>

                <?php echo $form->field($model, 'is_page_sections')->widget(SwitchBox::className(), [
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
