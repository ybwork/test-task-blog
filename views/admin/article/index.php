<?php require ROOT . '/views/layouts/header.php'; ?>
    <form class="common-ajax-form" action="/admin/lot/create" method="POST">
        <div>
            <label>Заголовок:</label>
            <input type="text" name="title" value="" data-validation="length" data-validation-length="max250">
        </div>
        <div>
            <label>Текст:</label>
            <textarea type="text" name="text"></textarea>
        </div>
        <button class="create_lot" type="submit">Создать</button>
    </form>

<!--     <?php if (count(0) > 0): ?>
        <?php foreach($lots as $lot): ?>
            <span><?php print $lot['name']?></span>
        <?php endforeach; ?>
    <?php endif; ?> -->

<!--     <?php
        if ($total > 4) {
            print $this->paginator->get();
        }
    ?> -->
<?php require ROOT . '/views/layouts/footer.php'; ?>