<?php require ROOT . '/views/layouts/header.php'; ?>
    <main class="main-content">
        <section class="section">
            <?php if (count($archive_auctions) > 0): ?>
                <div class="grid-body grid-bg">
                    <div class="grid-content grid-content__column">
                        <div class="grid-expand">
                            <div class="user-list">
                                <table class="table table-user">
                                    <thead class="table-header">
                                        <th>Аукцион</th>
                                        <th>Описание</th>
                                        <th>Время проведения</th>
                                        <th>Победитель</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($archive_auctions as $archive_auction): ?>
                                            <tr id="<?php print $archive_auction['id']?>" class="table-item user-item">
                                                <td class="table-align-center">№<?php print $archive_auction['id']; ?></td>
                                                <td class="table-align-center"><?php print $archive_auction['name'] . ' - ' . $archive_auction['description']; ?></td>
                                                <?php
                                                    $date_time_stop = explode(' ', $archive_auction['stop']);
                                                    $parts_stop_date = explode('-', $date_time_stop[0]);
                                                    $date_stop = $parts_stop_date[2] . '.' . $parts_stop_date[1] . '.' . $parts_stop_date[0];

                                                    $date_time_start = explode(' ', $archive_auction['start']);
                                                    $parts_start_date = explode('-', $date_time_start[0]);
                                                    $date_start = $parts_start_date[2] . '.' . $parts_start_date[1] . '.' . $parts_start_date[0];
                                                ?>
                                                <td class="table-align-center"><?php print $date_start . ' - ' . $date_stop; ?></td>
                                                <td class="table-align-center">
                                                    <?php 
                                                        if ($archive_auction['winner']) {
                                                            print $archive_auction['winner']; 
                                                        } else {
                                                            print '-';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-body">
                    <div class="pagination-block"> 
                        <?php if($total > 2): ?>
                            <?php print $this->paginator->get(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <p class="archive-notice">Пока нет аукционов в архиве</p>
            <?php endif; ?>
        </section>
    </main>
<?php require ROOT . '/views/layouts/footer.php'; ?>