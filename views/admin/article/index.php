<?php require ROOT . '/views/layouts/header.php'; ?>
    <div class="container">
        <form class="common-ajax-form article-form" action="/admin/lot/create" method="POST">
          <div class="form-group">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input type="email" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Текст</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

    <?php if (count($articles) > 0): ?>
        <?php foreach($articles as $article): ?>
            <h1><?php print $article['title']?></h1>
        <?php endforeach; ?>
    <?php endif; ?>
<?php require ROOT . '/views/layouts/footer.php'; ?>