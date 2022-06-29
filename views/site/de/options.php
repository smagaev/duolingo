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
    <?= $form->field($model, 'timer0')->label(false)->hiddenInput() ?>
    <?= $form->field($model, 'timer1')->label(Yii::t('app', 'timer') . 1)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer2')->label(Yii::t('app', 'timer') . 2)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer3')->label(Yii::t('app', 'timer') . 3)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer4')->label(Yii::t('app', 'timer') . 4)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer5')->label(Yii::t('app', 'timer') . 5)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <?= $form->field($model, 'timer6')->label(Yii::t('app', 'timer') . 6)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
    <div class="form-group form-vertical">
        <?= Html::resetButton(yii::t('app', 'btn_reset'), ['class' => 'btn btn-secondary btn-sm']) ?>
    </div>
    <div class="div" style="height: 1px ; border: 1px solid #999; margin: 20px 0"></div>

    <?= $form->field($model, 'sourceWords')->checkbox([]) ?>

    <div class="form-group form-vertical">
        <?= Html::submitButton(yii::t('app', 'btn_send'), ['class' => 'btn btn-primary btn-lg']) ?>
    </div>
    <em><?= yii::t('app', 'msec') ?></em>
    <?php ActiveForm::end(); ?>


</div><!-- options -->
<?=
$t1 = YII::$app->params['timer1'];
$t2 = YII::$app->params['timer2'];
$t3 = YII::$app->params['timer3'];
$t4 = YII::$app->params['timer4'];
$t5 = YII::$app->params['timer5'];
$t6 = YII::$app->params['timer6'];

$this->registerJs("
$('#default_value').click(function(){

    document.forms['my-form'].elements['options-timer1'].value = $t1;
    document.forms['my-form'].elements['options-timer2'].value = $t2;
    document.forms['my-form'].elements['options-timer3'].value = $t3;
    document.forms['my-form'].elements['options-timer4'].value = $t4;
    document.forms['my-form'].elements['options-timer5'].value = $t5;
    document.forms['my-form'].elements['options-timer6'].value = $t6;


})", 4);
?>