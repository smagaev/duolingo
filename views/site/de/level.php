<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Level';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <br>
    <h2>Ebene level</h2>
    <br>
    <row text-center>
        <? foreach ($countL as $key => $val) { ?>

            <a href="/setlevel?level=<?=$key?>&language=en"
               class="d-inline-block round bg-warning border-dark text-center col-4 col-md-3 border border-primary text-decoration-none m-3 p-4" style="border-radius: 50%; box-shadow: 10px 12px #343a40"
               data-toggle="tooltip" data-placement="top" title="<?=Yii::t('app', 'level'.$key)?>">
                <div class="level text-dark h6"><?=Yii::t('app', 'level'.$key)?>
                </div>
                <div class="badge badge-secondary "><?= $val ?>
                </div>
            </a>

        <? } ?>
    </row>
</div>
<?php
$this->registerJs(<<<JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
JS
);
?>
