		<script type="text/javascript" src="/public/js/jquery-3.2.1.min.js"></script>
		<script src="/public/plugins/jquery-form-validator/jquery-form-validator.min.js"></script>

		<!-- Select 2 -->
		<script type="text/javascript" src="/public/plugins/select2/dist/js/select2.min.js"></script>
		<script type="text/javascript">
			$(".js-example-basic-multiple").select2({
				allowClear: true
			});
		</script>

		<!-- Calendar -->
		<script src="/public/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
		<script src="/public/plugins/accounting/accounting.min.js"></script>
		<script type="text/javascript" src="/public/js/app.js?<?php print filemtime(ROOT . '/public/js/app.js'); ?>"></script>
	</body>
</html>