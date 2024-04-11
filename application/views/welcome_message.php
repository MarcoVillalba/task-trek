<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/') ?>bootstrap.css">
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap-icons/font/') ?>bootstrap-icons.css">
	<!-- custom site styles -->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>styles.css">
</head>
<body class="container bg-dark-subtle">
<div id="content">
	<h3 class="text-center my-4">Bienvenido a Task Trek!</h3>
	<div class="text-center my-2">
		<a class="btn btn-outline-dark" href="<?= base_url() ?>tasks">
			Administrar Tareas
			<i class="bi bi-terminal mx-2"></i>
		</a>
	</div>
	<div class="bg-image" style="background-image: url('assets/img/logo.jpg');">
	</div>
</div>

</body>
</html>
