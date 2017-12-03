<?php require_once(ROOT . '/views/layouts/header.php'); ?>
	<?php if ($auction): ?>
		<main class="main-content">
			<section class="section">
				<div class="grid-body">
					<div class="grid-content">
						<div class="grid-1-2">
							<div id="auctionId" style="display: none;">
								<?php print $auction['id']; ?>
							</div>

							<div id="nowStart" style="display: none;">
								<?php print time(); ?>
							</div>

							<div class="auction-card__full">
								<div class="auction-card__full-header">
									<div class="auction-card__full-img">
										<img src="/public/image/icon/lots/barrel.svg">
									</div>
									<div class="auction-card__full-title">
										<div class="auction-card__full-title-text">
											<?php print $auction['name']; ?>
										</div>
										<div class="auction-card__full-info">
											<div class="auction-card__full-info-user">
												<!-- 5 участников -->
											</div>
										</div>
										<div class="auction-card__full-info">
											<div class="auction-card__full-info-user">
												<!-- 5 участников -->
											</div>
										</div>
									</div>
								</div>

								<div class="auction-card__full-timer">
									<div id="timeStartText" class="auction-card__full-timer-name"></div>
									<div class="auction-card__full-timer-count">
										<div id="startTimer"></div>
										<div id="timer" class="active"></div>
										<div data-link="https://auction/lot/<?php print $auction['id']; ?>" style="display: none;"></div>
										<div class="auction-card__full-timer-finish">
											<?php 
												$datetime = explode(' ', $auction['stop']);
												$parts_stop_date = explode('-', $datetime[0]);
												$date = $parts_stop_date[2] . '.' . $parts_stop_date[1] . '.' . $parts_stop_date[0];
												$time =  substr($datetime[1], 0, 5);
											?>
											до <?php print $time . ' ' . $date; ?>
										</div>
									</div>
								</div>

								<div class="auction-card__full-price">
									<div class="auction-card__full-price-name">Стартовая цена</div>
									<div id="startPrice" style="display: none;">
										<?php print $auction['price']; ?>
									</div>
									<div id="startPriceSum" class="auction-card__full-price-value"></div>
									<span class="value-type">руб.</span>
								</div>

								<div class="auction-card__full-bet bet__hide">
									<div class="auction-card__full-bet-value">
										<div class="auction-card__full-bet-value-change">
											<div class="remove">-</div>
											<div id="lastBet" style="display: none">
												<?php 
													$last_bet = reset($bets);

													if ($last_bet) {
														print $last_bet['bet'];
													} else {
														print $auction['price'];
													}
												?>
											</div>
											<div class="betCount"></div>
											<input class="bet-sum" type="hidden" step="<?php print $auction['step_bet']; ?>">
											<div class="add">+</div>
										</div>
									</div>
									<div class="auction-card__full-bet-button">
										<form class="bet" action="/bet/create" method="POST">
									    	<input type="hidden" name="auction_id" value="<?php print $auction['id'] ?>">
									    	<input type="hidden" name="auction_status" value="<?php print $auction['status'] ?>">
									        <input type="hidden" name="user_id" value="<?php print $_SESSION['id']; ?>">
									        <input type="hidden" name="user_login" value="<?php print $_SESSION['login']; ?>">
									        <input type="hidden" name="date_bet" value="<?php print date('d.m.Y H:i'); ?>">
									        <input type="hidden" name="previous_bet">
									        <input type="hidden" name="bet" value="<?php print $auction['price']; ?>">
									        <input type="hidden" name="start_bet" value="<?php print $auction['price']; ?>">
									        <?php if ($auction['status'] == 1): ?>
												<button type="submit" class="button button-color button-round">Сделать ставку</button>
											<?php endif; ?>
									    </form>
									</div>
								</div>
								<div class="auction-card__full-bet-value-error">
									<p class="error-bet"></p>
								</div>
							</div>

							<div id="userId" style="display: none"><?php print $_SESSION['id']; ?></div>
							<div id="userName" style="display: none"><?php print $_SESSION['login']; ?></div>

							<div id="yearStartAuction" style="display: none;"><?php print $date_time_start_stop_auction['year_start']; ?></div>
							<div id="mounthStartAuction" style="display: none;"><?php print $date_time_start_stop_auction['mounth_start']; ?></div>
							<div id="dayStartAuction" style="display: none;"><?php print $date_time_start_stop_auction['day_start']; ?></div>
							<div id="timeStartAuction" style="display: none;"><?php print $date_time_start_stop_auction['time_start']; ?></div>
							<div id="yearStopAuction" style="display: none;"><?php print $date_time_start_stop_auction['year_stop']; ?></div>
							<div id="mounthStopAuction" style="display: none;"><?php print $date_time_start_stop_auction['mounth_stop']; ?></div>
							<div id="dayStopAuction" style="display: none;"><?php print $date_time_start_stop_auction['day_stop']; ?></div>
							<div id="timeStopAuction" style="display: none;"><?php print $date_time_start_stop_auction['time_stop']; ?></div>

							<ul class="characteristics-list">
								<li class="characteristics-list--item--title">
									<h3 class="characteristics-list--item--title-text">Характеристики товара</h3>
									<ul class="characteristics-list--item-content">
										<?php print $auction['description']; ?>
									</ul>
								</li>
							</ul>
						</div>
						<div class="grid-1-2">
							<div class="section-title">Cтавки</div>
							<table class="table">
								<thead class="table-header">
									<th class="table-align-left">Участник</th>
									<th class="table-align-right">Ставка</th>
								</thead>
								<tbody id="history-bets">
									<?php if (count($bets) > 0): ?>
										<?php foreach ($bets as $bet): ?>
											<tr class="bet table-item user-bet-item" data-user-login="<?php print $bet['user_login']; ?>" data-user-id="<?php print $bet['user_id']; ?>">
												<td class="table-align-left"><?php print $bet['user_login']; ?></td>
												<td class="table-align-right">
													<div class="user-bet-value" style="display: none;"><?php print $bet['bet']; ?></div>
													<div class="user-bet"></div> руб.
													<span class="user-bet-count"></span>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</main>
	<?php else: ?>
		<p>Страница не найдена</p>
	<?php endif; ?>
<?php require_once(ROOT . '/views/layouts/footer.php'); ?>
