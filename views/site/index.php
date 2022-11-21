<?php

/* @var $this yii\web\View */

$this->title = yii::t('app', 'home_title');
$this->registerMetaTag(['name' => 'description', 'content' => yii::t('app', 'home_description')]);
$quantity = count($words);
?>
    <!--    <div class="site-index">
        <br>
        <div class="body-content text-center">
            <? /* $n = 1;
            for ($i = 0; $i < count($words); $i++) {
                $k = $i + 1;
                $id_rand = count($words);
                if ($level < 7) {
                    $arr_eng[$i] = '<div id = ' . $n . ' class="btn btn-lg my_btn btn_act btn-default border-dark" style="width:45%" data-i="' . $words[$i]->id . '" data-id="' . $k . '"><span class="display" style="word-wrap:break-word">' . $words[$i]->word . '</span></div>';
                } else {
                    $arr_eng[$i] = '<div id = ' . $n . ' class="btn btn-lg my_btn btn_act btn-default border-dark" style="width:45%" data-i="' . $words[$i]->id . '" data-id="' . $k . '"><span class="display" style="word-wrap:break-word">' . $words[$i]->meaning . '</span></div>';
                }
                $n++;
                if ($level < 7) {
                    $arr_tr[$i] = '<div id = ' . $n . '  class="btn btn-lg my_btn btn_act btn-default border-dark" style="width:45%" data-i="' . $words[$i]->id . '" data-id="' . $k . '"><span style="word-wrap:break-word">' . $words[$i]->var1 . '</span></div>';
                } else {
                    $arr_tr[$i] = '<div id = ' . $n . '  class="btn btn-lg my_btn btn_act btn-default border-dark" style="width:45%" data-i="' . $words[$i]->id . '" data-id="' . $k . '"><span style="word-wrap:break-word">' . $words[$i]->form1 . '</span></div>';
                }
                $n++;
            }
            if(isset($arr_tr)) shuffle($arr_tr);
            */ ?>
            <div class="row">
                <div class="col"></div>
                <div class="col-4"><? /*=yii::t('app', 'Progress')*/ ?>: <span id="ready"><? /*= $count_ready */ ?></span> of <? /*= $count_words_db */ ?></div>
            </div>
            <br>

            <? /*
            for ($i = 0; $i < count($words); $i++) {
                */ ?>
                <div class="row">
                    <div style="width:2%"></div>
                    <? /*= $arr_eng[$i] */ ?>
                    <div style="width:6%"></div>
                    <? /*= $arr_tr[$i] */ ?>
                    <div style="width:2%"></div>

                </div>
                <br>

            <? /* } */ ?>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="btn btn-lg btn-next btn-primary col-sm-4 disabled <? /*= $show_btn_next?'':'d-none'*/ ?> data-quantity="<? /*= $quantity */ ?>"><? /*= yii::t('app', 'Next'); */ ?></div>
            <div class="col-sm-4"></div>
        </div>
    </div>-->

<?php //var_dump($words); ?>
    <h3 class="text-center text-info">Введите перевод:</h3>
    <br>
<?php for ($i = 0; $i < $quantity; $i++) { ?>
    <h4 id="<?= $i ?>" class="text-center"><? echo $words[$i]['word']; ?></h4>
    <div class="text-center">
        <input id="t_<?= $i ?>" class="input_z text-center border-0"
               style="text-decoration:underline; width:100%; padding:10px 0; outline: none" type="text" name="translate"
               value="<?= $words[$i]['var1'] ?>"/>
    </div>
    <br>
<? } ?>

    <div class="text-center">
        <?= \yii\helpers\Html::button( yii::t('app', 'Next'), ['class' => 'btn btn-lg btn_check btn-primary disabled', 'style' => 'margin:0 auto', 'name' => 'check']); ?>
    </div>

    <style>
        input:hover, input:focus, {
            box-shadow: none;
            outline: 0!important;
            outline-offset:0;
        }
    </style>
<?  $this->registerJsFile("@web/js/duo.js", ['depends' => [\yii\web\JqueryAsset::class]]); ?>




