<h1>Список новостей</h1>
<br>
<?php foreach ($news as $newsItem): ?>
    <div>
        <strong>
            <a href="<?=route('news.show', ['id' => $newsItem['id']])?>"><?=$newsItem['title']?></a>
        </strong>
        <p><?=$newsItem['description']?></p>
        <en>Автор: <?=$newsItem['author']?></en>
        <hr>
    </div>
<?php endforeach; ?>
