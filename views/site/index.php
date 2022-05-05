<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<? var_dump($_SESSION);?>
    <div class="site-index">
        <br>
        <div class="body-content text-center">
            <? $n = 1;
            for ($i = 0; $i < 5; $i++) {
                $k = $i + 1;
                $id_rand = count($words);
                $arr_eng[$i] = '<div id = ' . $n . ' class="btn btn-lg my_btn btn_act btn-defult border-dark col-5" data-id="' . $k . '"><span class="display">' . $words[$i]->word . '</span></div>';
                $n++;
                $arr_tr[$i] = '<div id = ' . $n . '  class="btn btn-lg my_btn btn_act btn-default border-dark col-5" data-id="' . $k . '"><span>' . $words[$i]->var1 . '</span></div>';
                $n++;
            }
            shuffle($arr_tr);
            ?>
            <div class="row">
                <div class="col"></div>
                <div class="col-4">Progress: <span id="ready"><?= $count_ready ?></span> of <?= $count_words_db ?></div>
            </div>
            <br>

            <?
            for ($i = 0; $i < 5; $i++) {
                ?>
                <div class="row">
                    <div class="col"></div>
                    <?= $arr_eng[$i] ?>
                    <div class="col"></div>
                    <?= $arr_tr[$i] ?>
                    <div class="col"></div>
                </div>
                <br>

            <? } ?>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="btn btn-lg btn-next btn-primary col-sm-4 disabled"><?=yii::t('app','Next');?></div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <style>

    </style>
<? $this->registerJsFile("@web/js/duo.js", ['depends' => [\yii\web\JqueryAsset::class]]); ?>