<h1 class="text-center">Правила грамматики</h1>

<ul>
    <? foreach ($rules as $rule) { ?>
        <li><a href="/rule?rule=<?= $rule ?>"><?= $rule ?></a></li>
    <? } ?>

</ul>