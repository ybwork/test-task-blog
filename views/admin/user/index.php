<?php require ROOT . '/views/layouts/header.php'; ?>
    <main class="main-content">
        <section class="section">
            <div class="grid-body grid-bg">
                <div class="grid-content grid-content__column">
                    <div class="grid-fix-medium">
                        <form class="common-ajax-form nice-form form-add" action="/admin/user/create" method="POST">
                            <div class="admin-form-input">
                                <label>Логин:</label>
                                <input type="text" name="login" value="">
                            </div>
                            <div class="admin-form-input">
                                <label>Пароль:</label>
                                <input type="password" name="password" value="">
                            </div>
                            <button class="button button-color button-round admin-button create_user" type="submit">Создать</button>
                        </form>
                    </div>
                        <div class="grid-expand">
                            <div class="user-list table-dynamic">
                                <?php if (count($users) > 0): ?>
                                    <table class="table table-user">
                                        <thead class="table-header">
                                            <th>Логин</th>
                                            <th>Пароль</th>
                                            <th>Действие</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($users as $user): ?>
                                                <tr data-id="<?php print $user['id']; ?>" data-action="/admin/user/update" id="<?php print $user['id']?>" class="table-item user-item">
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $user['login']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input type="text" name="login" value="<?php print $user['login']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input class="no-validate" type="password" name="password"">
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
                                                            <form class="common-ajax-form form-delete" action="/admin/user/delete" method="POST">
                                                                <input type="hidden" name="id" value="<?php print $user['id']; ?>">
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