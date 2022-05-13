<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Einstellungen';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <br>
    <h2>Select the level</h2>
    <br>
    <row text-center>
        <? foreach ($countL as $key => $val) { ?>

            <a href="/setlevel?level=<?=$key?>"
               class="d-inline-block round bg-warning border-dark text-center col-3 border border-primary text-decoration-none m-3 p-4" style="border-radius: 50%; box-shadow: 10px 12px #343a40">
                <div class="level text-dark h4">Stufe <?= $key ?>
                </div>
                <div class="badge badge-secondary "><?= $val ?>
                </div>
            </a>

        <? } ?>
    </row>
</div>
