<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Words;

$model = new Words();

/* @var $this yii\web\View */
/* @var $model app\models\Words */
/* @var $form ActiveForm */
?>
<h2>Here you can insert english words to data base...</h2>

<ul class="list-unstyled small"><strong>Format Example:</strong>
    <li> english word : translation</li>
    <li> english word : translation</li>
    <li> english word : translation</li>
</ul>
<div class="wait" style="display:none;">Please wait ...</div>
<div class="words">

    <?php $form = ActiveForm::begin([
        'method' => 'POST',
        'options' => [
            'onsubmit' => 'document.querySelector(\'.wait\').style.display = \'block\''
        ]

    ]);
    ?>
    <?= $form->field($model, 'words')->textarea(['rows' => '20']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', [
            'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::Button('Сache leeren', [
            'class' => 'btn btn-secondary',
            'onClick' => 'window.location.href="'. Url::toRoute(['site/clear']) . '"'

        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- words -->
