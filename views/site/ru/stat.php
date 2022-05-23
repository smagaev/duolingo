<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Кол-во пройденных слов за все время: <span class="text-success font-weight-bold h3"><?=$countStadied?></span>
    </p>

</div>
