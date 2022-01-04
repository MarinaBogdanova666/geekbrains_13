<h1>Категории новостей</h1>
<br>
<?php foreach ($category as $newsItem): ?>
    <div>
        <strong>
            <a href="<?=route('news.index')?>"><?=$newsItem['name']?></a>
        </strong>
        <hr>
    </div>
<?php endforeach; ?>
