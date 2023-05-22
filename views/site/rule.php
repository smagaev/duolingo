<?php

/* @var $this yii\web\View */

//$this->title = yii::t('app', 'home_title');
//$this->registerMetaTag(['name' => 'description', 'content' => yii::t('app', 'home_description')]);
?>

<h1 class="text-center"><?=$model->rulename;?></h1>
<br>
<p class="text-center"><img src="<?=$model->ruleImage;?>"></p>
<p><?=$model->ruleText;?></p>
<br>
<?php

foreach($model->youtubeLinks as $link){?>
    <p>
        <a href="<?=$link?>">Посмотреть урок на Youtube</a>
    </p>
<?}?>









