<?php require ROOT . '/views/layouts/header.php'; ?>
    <main class="main-content">
        <section class="section">
            <div class="grid-body grid-bg">
                <div class="grid-content grid-content__column">
                    <div class="grid-fix-medium">
                        <form class="common-ajax-form nice-form form-add" action="/admin/lot/create" method="POST">
                            <div class="admin-form-input">
                                <label>Имя:</label>
                                <input type="text" name="name" value="" data-validation="length" data-validation-length="max250">
                            </div>
                            <div class="admin-form-input">
                                <label>Описание:</label>
                                <textarea type="text" name="description"></textarea>
                            </div>
                            <div class="admin-form-input">
                                <label>Цена:</label>
                                <input type="number" name="price" value="">
                            </div>
                            <p class="error-message"></p>
                            <button class="button button-color button-round admin-button create_lot" type="submit">Создать</button>
                        </form>
                    </div>

                    
                        <div class="grid-expand">
                            <div class="user-list table-dynamic">
                                <?php if (count($lots) > 0): ?>
                                    <table class="table table-user">
                                        <thead class="table-header">
                                            <th>Имя</th>
                                            <th>Описание</th>
                                            <th>Цена</th>
                                            <th>Действие</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($lots as $lot): ?>
                                                <tr data-id="<?php print $lot['id']; ?>" data-action="/admin/lot/update" id="<?php print $lot['id']?>" class="table-item user-item">
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $lot['name']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input type="text" name="name" value="<?php print $lot['name']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $lot['description']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <textarea name="description"><?php print $lot['description']; ?></textarea>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $lot['price']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input type="number" name="price" value="<?php print $lot['price']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>

                                                    <td class="actions">
                                                        <div class="col">
                                                            <button class="btn-icon btn-action gray form-edit" type="button">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </button>
                                                            <button class="btn-icon btn-action hidden green form-save">
                                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <form class="common-ajax-form form-delete" action="/admin/lot/delete" method="POST">
                                                                <input type="hidden" name="id" value="<?php print $lot['id']; ?>">
                                                                <button class="btn-icon gray" type="submit">
                                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php 
                        // Раскомментировать, когда появиться js для пагинации
                        // if ($total > 20) {
                        //  print $this->paginator->get();
                        // }
                    ?>
                </div>
            </div>
        </section>
    </main>
<?php require ROOT . '/views/layouts/footer.php'; ?>