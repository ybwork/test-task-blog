<?php require_once(ROOT . '/views/layouts/header.php'); ?>
	<main class="main-content">
		<section class="section">
			<div class="grid-body">
				<div id="auctionCards" class="grid-content">
					<?php // if (count($auctions) > 0): ?>
						<?php // foreach($auctions as $auction): ?>
	
						<?php // endforeach; ?>
						<div class="grid-body pagination-center">
                    		<div class="pagination-block"> 
								<?php // if($total > 3): ?>
		                            <?php // print $this->paginator->get(); ?>
		                        <?php // endif; ?>
		                    </div>
		                </div>
					<?php // endif; ?>
				</div>
			</div>
		</section>
	</main>
<?php require_once(ROOT . '/views/layouts/footer.php'); ?>
