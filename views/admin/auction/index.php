<?php require ROOT . '/views/layouts/header.php'; ?>
    <main class="main-content">
        <section class="section">
            <div class="grid-body grid-bg">
                <div class="grid-content grid-content__column">
                    <div class="grid-fix-medium">
                        <form class="common-ajax-form nice-form form-add" action="/admin/auction/create" method="POST">
                            <div class="admin-form-input">
                                <label>Лот:</label>
                                <select name="lot_id" class="admin-select">
                                    <?php if (count($lots) > 0): ?>
                                        <?php foreach ($lots as $lot): ?>
                                            <option value="<?php print $lot['id']; ?>">
                                                <?php print $lot['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="admin-form-input">
                                <label>Шаг ставки:</label>
                                <input type="number" name="step_bet" value="">
                            </div>
                            <div class="admin-form-input">
                                <label>Начало:</label>
                                <input type="text" name="start" class="datetimepicker"></input>
                            </div>
                            <div class="admin-form-input">
                                <label>Конец:</label>
                                <input type="text" name="stop" value="" class="datetimepicker">
                            </div>
                            <div class="admin-form-input">
                                <label>Статус:</label>
                                <select name="status" class="admin-select">
                                    <option value="1">Запустить</option>
                                    <option value="2">Остановить</option>
                                </select>
                            </div>
                            <button class="button button-color button-round admin-button create_lot" type="submit">Создать</button>
                        </form>
                    </div>
                        <div class="grid-expand">
                            <div class="user-list table-dynamic">
                                <?php if (count($auctions) > 0): ?>
                                    <table class="table table-user">
                                        <thead class="table-header">
                                            <th>Лот</th>
                                            <th>Шаг ставки</th>
                                            <th>Начало</th>
                                            <th>Конец</th>
                                            <th>Статус</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($auctions as $auction): ?>
                                                <tr data-id="<?php print $auction['id']; ?>" data-action="/admin/auction/update" id="<?php print $auction['id']?>" class="table-item user-item">
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $auction['name']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <select name="lot_id" class="admin-select">
                                                                    <?php if (count($lots) > 0): ?>
                                                                        <?php foreach ($lots as $lot): ?>
                                                                            <option <?php $auction['name'] == $lot['name'] ? print 'selected="selected"' : '' ?> value="<?php print $lot['id']; ?>">
                                                                                <?php print $lot['name'] ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $auction['step_bet']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input type="number" name="step_bet" value="<?php print $auction['step_bet']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $auction['start']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input class="datetimepicker" type="text" name="start" value="<?php print $auction['start']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span><?php print $auction['stop']?></span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <input class="datetimepicker" type="text" name="stop" value="<?php print $auction['stop']; ?>">
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="editable">
                                                        <div class="relative">
                                                            <span>
                                                                <?php
                                                                    if($auction['status'] == 1) {
                                                                        print "Запустить";
                                                                    } else {
                                                                        print "Остановить";
                                                                    }
                                                                ?>
                                                            </span>
                                                            <form class="common-ajax-form form-update" action="" method="POST">
                                                                <select name="status" class="admin-select">
                                                                    <option <?php $auction['status'] == 1 ? print 'selected="selected"' : '' ?> value="1">Запустить</option>
                                                                    <option <?php $auction['status'] == 2 ? print 'selected="selected"' : '' ?> value="2">Остановить</option>
                                                                </select>
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
                                                            <form class="common-ajax-form form-delete" action="/admin/auction/delete" method="POST">
                                                                <input type="hidden" name="id" value="<?php print $auction['id']; ?>">
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