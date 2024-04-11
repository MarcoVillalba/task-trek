<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/') ?>bootstrap.css">
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap-icons/font/') ?>bootstrap-icons.css">
	<!-- jquery-confirm -->
	<link rel="stylesheet" href="<?= base_url('vendor/jquery-confirm/') ?>jquery-confirm.min.css">
	<!-- custom site styles -->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>styles.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url() ?>">
			<img src="<?= base_url() ?>assets/img/logo.jpg" alt="Logo" width="50" height="50">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>tasks">Todas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>tasks/completed">Completas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>tasks/overdue">Vencidas</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- Navbar -->
<!-- backdrop -->
<div id="backdrop" class="backdrop position-fixed z-1 top-0 start-0 w-100 h-100 bg-dark opacity-50">
</div>
<!-- backdrop -->
<!-- spinner -->
<div class="d-flex justify-content-center z-3 position-fixed top-50 start-50 translate-middle">
	<div id="spinner" class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
		<span class="visually-hidden">Loading...</span>
	</div>
</div>
<!-- spinner -->

<!-- Modal Details -->
<div class="modal fade" id="taskDetailsModal" aria-labelledby="taskDetailsModalLabel" aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="taskDetailsModalLabel">Detalles de la tarea</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="taskId" id="taskId" value="">
				<div class="row mb-3">
					<div class="col-12">
						<div class="">
							<label for="titleDetails" class="form-label">Título de la tarea</label>
							<input type="text" class="form-control" id="titleDetails" name="titleDetails" disabled>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12">
						<div class="">
							<label for="descriptionDetails" class="form-label">Descripción</label>
							<textarea class="form-control" id="descriptionDetails" name="descriptionDetails" disabled style="height: 100px"></textarea>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12">
						<div class="col-12">
							<label for="duedateDetails" class="form-label">Fecha de Vencimiento</label>
							<input type="text" class="form-control" id="duedateDetails" name="duedateDetails" disabled>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12">
						<div class="col-12">
							<label for="createDateDetails" class="form-label">Fecha de Creación</label>
							<input type="text" class="form-control" id="createDateDetails" name="createDateDetails" disabled>
						</div>
						<div class="col-12">
							<label for="updateDateDetails" class="form-label">Fecha de Actualización</label>
							<input type="text" class="form-control" id="updateDateDetails" name="updateDateDetails" disabled>
						</div>
						<div class="col-12">
							<label for="completedAtDateDetails" class="form-label">Completada</label>
							<input type="text" class="form-control" id="completedAtDateDetails" name="completedAtDateDetails" disabled>
						</div>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-12">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" role="switch" id="completedDetails" name="completedDetails" disabled>
							<label class="form-check-label" for="completedDetails" >Tarea completada</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Details -->
