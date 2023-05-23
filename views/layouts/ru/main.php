<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\components\languageSwitcher;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <? include_once(__DIR__ . '/../counts/yandex.php'); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => "DUO",
        'brandUrl' => ['/site/index', 'language' => 'ru'],
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-info fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'О нас', 'url' => ['/site/about', 'language'=>'ru']],
            ['label' => 'Контакты', 'url' => ['/site/contact', 'language'=>'ru']],
            ['label' => 'Уровень', 'url' => ['/site/level', 'language'=>'ru']],
            ['label' => 'Слова', 'url' => ['/site/words', 'language'=>'ru']],
            ['label' => 'Правила', 'url' => ['/site/rules', 'language'=>'ru']],
            Yii::$app->user->isGuest ? (''):( ['label' => 'Настройки', 'url' => ['/site/options','language'=>'ru']]),
            Yii::$app->user->isGuest ? (''):( ['label' => 'Статистика', 'url' => ['/site/stat','language'=>'ru']]),
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login', 'language'=>'ru']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    echo languageSwitcher::Widget();
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?=yii::t("app","My Company")?> <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
