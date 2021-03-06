<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Words;
use app\widgets\Alert;

$model = new Words();

/* @var $this yii\web\View */
/* @var $model app\models\Words */
/* @var $form ActiveForm */
?>


<h2>Здесь вы можете добавить изучаемые слова в базу ...</h2>

<ul class="list-unstyled small"><strong>Формат добавляемых слов:</strong>
    <li> иностранное слово : перевод</li>
    <li> иностранное слово : перевод</li>
    <li> иностранное слово : перевод</li>
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
        <?= Html::submitButton('Добавить слова', [
            'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::Button('Очистить кеш', [
            'class' => 'btn btn-secondary',
            'onClick' => 'window.location.href="'. Url::toRoute(['site/clear']) . '"'

        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?= Html::Button ( 'Удалить мои слова из базы', [
            'class' => 'btn btn-danger',
            'onClick'=> 'removeWords()',
        ]
    
    )?>

</div><!-- words -->


<?  $myJS = <<< JS
        function removeWords(){
            var res = window.confirm ("Вы хорошо подумали?");
            if (res == true){
                window.location.href = "/delete-words"
            }
        }
        JS;
$this->registerJS($myJS, \yii\web\View::POS_HEAD);
?>