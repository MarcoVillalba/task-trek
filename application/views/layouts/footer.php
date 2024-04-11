</body>
<div class="container">
	<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
		<div class="col-md-4 d-flex align-items-center">
			<a href="<?= base_url() ?>" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
				<i class="bi bi-terminal mx-2"></i>
			</a>
			© 2024 Copyright: Marco Villalba
		</div>
	</footer>
</div>

<script>
	const base_url = "<?= base_url() ?>/tasks/";
</script>

<!-- jQuery -->
<script src="<?= base_url('vendor/jquery/dist/') ?>jquery.js"></script>
<!-- jQuery-confirm -->
<script src="<?= base_url('vendor/jquery-confirm/') ?>jquery-confirm.min.js"></script>
<!-- jQuery-validation -->
<script src="<?= base_url('vendor/jquery-validation/') ?>jquery.validate.min.js"></script>
<script src="<?= base_url('vendor/jquery-validation/') ?>additional-methods.min.js"></script>
<!-- bootstrap -->
<script src="<?= base_url('vendor/twbs/bootstrap/dist/js/') ?>bootstrap.bundle.min.js"></script>

<!-- custom app functions -->
<script src="<?= base_url('assets/js/') ?>app.js"></script>
</html>
