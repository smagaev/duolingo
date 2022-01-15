<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
<br>
<br>
    <div class="body-content text-center">
        <? for ($i = 0; $i < 5; $i++) { ?>
            <? $id_rand = count($words); ?>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="btn my_btn btn-defult border-dark col-sm-4" id="<?= $i ?>"><span class="display"><?= $words[$i]->word ?></span>
                </div>
                <div class="col-sm-1"></div>
                <div class="btn my_btn btn-default border-dark col-sm-4" id="tr_<?= $i ?>"><span><?= $words[$i]->var1 ?></span></div>
                <div class="col-sm-1"></div>
            </div>
            <br>
        <? } ?>

    </div>
</div>
