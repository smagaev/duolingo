<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <? if ($countStadied !== null) { ?>
        <p>
            Кол-во пройденных слов за этот месяц: <span
                    class="text-success font-weight-bold h3"><?= $countStadied ?></span>
        </p>
    <? } else { ?>
        <p>
            К сожалению, у вас нет изученных слов.
        </p>
        <a href="/level?language=ru">Это легко исправить!</a>


    <? } ?>

    </div>

    <? if ($countStadied !== null) { ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages: ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Density", {role: "style"}],
                    //["Copper", 8.94, "#b87333"],
                    // ["Silver", 10.49, "silver"],
                    // ["Gold", 19.30, "gold"],
                    // ["Platinum", 21.45, "color: #e5e4e2"]
                    <?foreach ($grafic_data as $arr){?>
                    [<?=Yii::$app->formatter->asDate($arr['data'], 'd')?>, <?=$arr['quantity']?>, "primary"],
                    <?}?>
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2]);

                var options = {
                    title: "Всего пройдено слов",
                    width: 800,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: {position: "none"},
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
        </script>
        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    <? } ?>

