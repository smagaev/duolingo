<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Английский с нами - легко!';
$this->registerMetaTag(['name'=>"description", "content"=>"Вау! Этот сайт поможет вам быстро изучить английский, немецкий и другие языки"]);

$this->params['breadcrumbs'][] = "О нас";
?>
<div class="site-about">
    <p>&nbsp;</p>
    <h1><?= Html::encode($this->title) ?></h1>
   <p>&nbsp;</p>

    <p>
        При самостоятельном изучении английского языка
        на просторах интернета мне попался сайт <a href="https://duolingo.com">duolingo.com</a>, который ну очень мне понравился!
        На этом сайте я занимаюсь уже год и почти прошел весь курс английского языка. Все здесь хорошо, но, очень уж долго.
        Согласно рекомендациям, желательно выписывать изучаемые слова, для лучшего их усвоения. Что я и делал!
        Однако! Повторять их, как показала практика, не очень удобно, да и бесмысленно. Постоянно попадаются уже изученные слова, другие,
        не изученные, попадаются редко. Было бы неплохо изученный материал отсеивать!
        Поэтому, что бы упростить запоминание слов и ускорить повторение пройденного материала я и написал небольшую бесплатную программку,
        которую и хочу представить вашему вниманию.
    </p>
    <p>
        Сайт позволяет не только изучать слова собранные мной, но и слова, которые вы добавите сами!
        Добавляемые языки могут быть не только на английском и русском языках, но и на любых других.
        Правда, интерфейс сайта представлен только на русском, немецком и английском языках.
    </p>
    <p>
        Для добаления своих слов, просмотра статистики, и исключения изученных слов из процесса обчучения нужно зарегистрироваться
        на сайте.
    </p>
    <p>
        Если возникнут какие то вопросы или пожелания, вы можете оставить сообщение на странице <a href="/contact/">Контакты</a>
    </p>
</div>
