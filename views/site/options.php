<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Options */
/* @var $form ActiveForm */
$this->title = yii::t('app', 'options');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="options">
    <br>
    <?php $form = ActiveForm::begin([

        'options' => [
            'id' => 'my-form',
            'class' => '',
            'style' => [
                'margin' => '0 auto',
                'border' => '1px solid #444',
                'padding' => '40px 40px',
                'box-shadow' => '5px 20px #555'
            ]
        ]
    ]); ?>

    <div class="h2"><?= yii::t('app', "options") ?>:</div>

    <?= $form->field($model, 'user_id')->label(false)->hiddenInput() ?>
    <?= $form->field($model, 'timer1')->label(Yii::t('app', 'timer') . 1)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer2')->label(Yii::t('app', 'timer') . 2)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer3')->label(Yii::t('app', 'timer') . 3)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer4')->label(Yii::t('app', 'timer') . 4)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer5')->label(Yii::t('app', 'timer') . 5)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer6')->label(Yii::t('app', 'timer') . 6)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer7')->label(Yii::t('app', 'timer') . 7)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer8')->label(Yii::t('app', 'timer') . 8)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer9')->label(Yii::t('app', 'timer') . 9)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <div class="form-group form-vertical">
        <?= Html::resetButton(yii::t('app', 'btn_reset'), ['class' => 'btn btn-secondary btn-sm']) ?>
        <?= Html::Button(yii::t('app', 'btn_default'), ['class' => 'btn btn-dark btn-sm', 'id' => 'default_value']) ?>
    </div>
    <div class="div" style="height: 1px ; border: 1px solid #999; margin: 20px 0"></div>

    <?= $form->field($model, 'sourceWords')->checkbox([]) ?>
    <?= $form->field($model, 'show_btn_next')->checkbox([]) ?>
    <?= $form->field($model, 'mixed_mode')->checkbox([]) ?>
    <?= $form->field($model, 'mode_of_studies')->checkbox([]) ?>

    <div class="form-group form-vertical">
        <?= Html::submitButton(yii::t('app', 'btn_send'), ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div><!-- options -->
<?
$t1 = YII::$app->params['timer1'];
$t2 = YII::$app->params['timer2'];
$t3 = YII::$app->params['timer3'];
$t4 = YII::$app->params['timer4'];
$t5 = YII::$app->params['timer5'];
$t6 = YII::$app->params['timer6'];
$t7 = YII::$app->params['timer7'];
$t8 = YII::$app->params['timer8'];
$t9 = YII::$app->params['timer9'];
$show_btn_next = YII::$app->params['show_btn_next'];
//$mixed_mode = YII::$app->params['mixed_mode'];
//$mode_of_studies = YII::$app->params['mode_of_studies'];

$this->registerJs("
$('#default_value').click(function(){

    document.forms['my-form'].elements['options-timer1'].value = $t1;
    document.forms['my-form'].elements['options-timer2'].value = $t2;
    document.forms['my-form'].elements['options-timer3'].value = $t3;
    document.forms['my-form'].elements['options-timer4'].value = $t4;
    document.forms['my-form'].elements['options-timer5'].value = $t5;
    document.forms['my-form'].elements['options-timer6'].value = $t6;
    document.forms['my-form'].elements['options-timer6'].value = $t7;
    document.forms['my-form'].elements['options-timer6'].value = $t8;
    document.forms['my-form'].elements['options-timer6'].value = $t9;


})", 4);
?>
