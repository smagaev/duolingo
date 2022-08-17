<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Verbs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbs-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'form1:ntext',
            'form2:ntext',
            'form3:ntext',
            'meaning:ntext',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Verbs $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
        ],
    ]); ?>


</div>
