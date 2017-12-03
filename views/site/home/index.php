<?php require_once(ROOT . '/views/layouts/header.php'); ?>
	<main class="main-content">
		<section class="section">
			<div class="grid-body">
				<div id="auctionCards" class="grid-content">
					<?php if (count($auctions) > 0): ?>
						<?php foreach($auctions as $auction): ?>
							<div class="grid-1-4">
								<div class="auction-card" data-auction-id="<?php print $auction['id']; ?>">
									<div class="auction-card-img">
										<img src="/public/image/icon/lots/barrel.svg">
									</div>
									<div class="auction-card-title padding-15"><?php print $auction['name']; ?></div>
									<div class="auction-card-price padding-15">
										<span class="price-text">Стартовая цена</span>
										<div class="card-price">
											<span class="start-lot-price" style="display: none;"><?php print $auction['price']; ?></span>
											<span class="card-lot-cost"></span>
											<span>руб.</span>
										</div>
									</div>

									<div class="auction-card-price padding-15">
										<span class="price-text current-price">Текущая цена</span>
										<div class="card-price current-card-price">
											<span class="current-card-price" style="display: none;" data-current-price>
												<?php 
													$all_bets_this_lot = array_column($transformed_bets, $auction['id']);
													$last_bet = reset($all_bets_this_lot);

													if ($last_bet) {
														print $last_bet['bet'];
													} else {
														print $auction['price'];
													}
												?>
											</span>
											<span class="card-lot-cost"></span>
											<span>руб.</span>
										</div>
									</div>

									<div class="auction-card-winner-info">
										<div class="auction-card-winner"></div>
										<div class="auction-card-timer padding-10">
											<div class="auction_id" style="display: none;"><?php print $auction['id']; ?></div>
											<div class="sys-lot-status" data-auction-status="<?php print $auction['status']; ?>" style="display: none;"></div>
											<div class="sys-user-id" data-user-id="<?php print $last_bet['user_id']; ?>" style="display: none;"></div>
											<div class="sys-link" data-link="https://auction/auction/<?php print $auction['id']; ?>" style="display: none;"></div>

											<?php $date_time_start_stop_auction = $this->helper->transform_date_time($auction['start'], $auction['stop']); ?>
											
											<div class="year-start-auction" style="display: none;"><?php print $date_time_start_stop_auction['year_start']; ?></div>
											<div class="mounth-start-auction" style="display: none;"><?php print $date_time_start_stop_auction['mounth_start']; ?></div>
											<div class="day-start-auction" style="display: none;"><?php print $date_time_start_stop_auction['day_start']; ?></div>
											<div class="time-start-auction" style="display: none;"><?php print $date_time_start_stop_auction['time_start']; ?></div>
											<div class="year-stop-auction" style="display: none;"><?php print $date_time_start_stop_auction['year_stop']; ?></div>
											<div class="mounth-stop-auction" style="display: none;"><?php print $date_time_start_stop_auction['mounth_stop']; ?></div>
											<div class="day-stop-auction" style="display: none;"><?php print $date_time_start_stop_auction['day_stop']; ?></div>
											<div class="time-stop-auction" style="display: none;"><?php print $date_time_start_stop_auction['time_stop']; ?></div>

											<div class="auction-card-timer-text"></div>
											<div class="auction-card-timer-start active"></div>
											<div class="auction-card-timer-stop"></div>
										</div>
										<div class="auction-card-link">
											<a href="/auction/<?php print $auction['id']; ?>" class="button button-color button-round">Принять участие</a>
										</div>
										<?php
											$datetime = explode(' ', $auction['stop']);
											$date = preg_replace('/-/', '.', $datetime[0]);
											$time =  substr($datetime[1], 0, 5);
										?>
										<div class="auction-card-date">до <?php print $time . ' ' . $date; ?></div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="grid-body pagination-center">
                    		<div class="pagination-block"> 
								<?php if($total > 3): ?>
		                            <?php print $this->paginator->get(); ?>
		                        <?php endif; ?>
		                    </div>
		                </div>
					<?php else: ?>
						<p>Пока нет аукционов</p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</main>
<?php require_once(ROOT . '/views/layouts/footer.php'); ?>
