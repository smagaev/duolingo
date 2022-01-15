<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <br>
    <br>
    <div class="body-content text-center">
        <? for ($i = 0; $i < 5; $i++) {
            $id_rand = count($words);
            $arr_eng[$i] = '<div class="btn my_btn btn-defult border-dark col-sm-4" id="<?= $i ?>"><span class="display">' .  $words[$i]->word .'</span></div>';
            $arr_tr[$i] = '<div class="btn my_btn btn-default border-dark col-sm-4" id="tr_<?= $i ?>"><span>'. $words[$i]->var1 .'</span></div>';
        }
        shuffle($arr_tr);

        for ($i = 0; $i < 5; $i++) {
            ?>
            <div class="row">
                <div class="col-sm-1"></div>
                <?= $arr_eng[$i] ?>
                <div class="col-sm-1"></div>
                <?= $arr_tr[$i] ?>
                <div class="col-sm-1"></div>
            </div>
            <br>

        <? } ?>

    </div>
</div>
