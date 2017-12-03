		<script type="text/javascript" src="/public/js/jquery-3.2.1.min.js"></script>
		<script src="/public/plugins/jquery-form-validator/jquery-form-validator.min.js"></script>

		<!-- Select 2 -->
		<script type="text/javascript" src="/public/plugins/select2/dist/js/select2.min.js"></script>
		<script type="text/javascript">
			$(".js-example-basic-multiple").select2({
				allowClear: true
			});
		</script>

		<!-- Main -->
		<?php if ($_SERVER['REQUEST_URI'] == '/login'): ?>
			<script type="text/javascript" src="/public/js/login.js"></script>
		<?php else: ?>
			<!-- Calendar -->
			<script src="/public/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
			<script src="/public/plugins/accounting/accounting.min.js"></script>
			<script type="text/javascript" src="/public/js/app.js?<?php print filemtime(ROOT . '/public/js/app.js'); ?>"></script>
			
	        <!-- Socket.io -->
	        <script type="text/javascript" src="/libs/socket.io-client/dist/socket.io.js"></script>

	        <!-- Socket client -->
	        <script type="text/javascript" src="/public/js/socket-client.js?<?php print filemtime(ROOT . '/public/js/socket-client.js'); ?>"></script>
		<?php endif; ?>
	</body>
</html>