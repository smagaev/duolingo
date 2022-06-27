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
        <?= $form->field($model, 'timer0')->label(false)->hiddenInput() ?>
        <?= $form->field($model, 'timer1')->label(Yii::t('app', 'timer') . 1)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <?= $form->field($model, 'timer2')->label(Yii::t('app', 'timer') . 2)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <?= $form->field($model, 'timer3')->label(Yii::t('app', 'timer') . 3)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <?= $form->field($model, 'timer4')->label(Yii::t('app', 'timer') . 4)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <?= $form->field($model, 'timer5')->label(Yii::t('app', 'timer') . 5)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <?= $form->field($model, 'timer6')->label(Yii::t('app', 'timer') . 6)->textInput(['class' => ['text-center'], 'style' => ['margin-left' => '20px'], 'size' => '8', 'placeholder' => '0']) ?>
        <div class="form-group form-vertical">
            <?= Html::resetButton(yii::t('app', 'btn_reset'), ['class' => 'btn btn-secondary btn-sm']) ?>
            <?= Html::Button(yii::t('app', 'btn_default'), ['class' => 'btn btn-dark btn-sm', 'id' =>'default_value']) ?>
        </div>
        <div class="div" style="height: 1px ; border: 1px solid #999; margin: 20px 0"></div>

        <?= $form->field($model, 'sourceWords')->checkbox([]) ?>

        <div class="form-group form-vertical">
            <?= Html::submitButton(yii::t('app', 'btn_send'), ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
        <em><?= yii::t('app', 'msec') ?></em>
        <?php ActiveForm::end(); ?>


    </div><!-- options -->

<?php $this->registerJs("
$('#default_falue').click(function(){
var inputs = document.getElementById('my-form').elements;

for (i = 0; i < inputs.length; i++) {
  if (inputs[i].nodeName === 'INPUT' && inputs[i].type === 'text') {
    inputs[i].value = '21'
  }
}

})", 4);
