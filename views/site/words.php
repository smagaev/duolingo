<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Words;

$model = new Words();

/* @var $this yii\web\View */
/* @var $model app\models\Words */
/* @var $form ActiveForm */
?>
<h2>Here You can insert english words to data base...</h2>
<ul class="list-unstyled small"><strong>Example:</strong>
<li> english word   :  translation </li>
<li> english word   :  translation </li>
<li> english word   :  translation </li>
</ul>
<div class="words">

    <?php $form = ActiveForm::begin(['method'=>'POST']); ?>

    <?= $form->field($model, 'words')->textarea(['rows'=>'20'])?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- words -->
