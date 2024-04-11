<!-- container -->
<div class="container">
	<div class="row my-4">
		<!-- App Title -->
		<div class="col-12 text-center">
			<h1><?= $title ?>!</h1>
		</div>
	</div>
	<div class="row justify-content-center">
		<!-- App content -->
		<div class="col-12 col-lg-6">
			<!--	Verifica si hay tasks para crear las tarjeas -->
			<?php if (!$tasks) : ?>
				<div class="card text-bg-secondary my-3 text-center">
					<div class="card-header">Mis pendientes</div>
					<div class="card-body">
						<h5 class="card-title">No hemos encontrado tareas cargadas aún</h5>
						<p class="card-text">¿Deseas agregar una nueva tarea?</p>
						<a class="btn btn-primary" href="<?= base_url() ?>tasks">
							<i class="bi bi-plus-circle-dotted"></i>
							Agregar
						</a>
					</div>
				</div>
				<!--	Recorre los datos recibidos para armar las cards -->
			<?php else: ?>
				<?php foreach ($tasks as $t) : ?>
					<div class="card text-bg-dark mb-3">
						<div class="card-header text-center">
							<?= $t->formated_duedate ?>
							<span class="badge text-bg-<?= $t->status === 'a-tiempo' ? 'success' : ($t->status === 'vencida' ? 'danger' : 'warning') ?> ">
								<?= $t->status ?>
							</span>
						</div>
						<div class="card-body">
							<div class="row text-center">
								<div class="col-12">
							<h5 class="card-title"><?= $t->title ?></h5>
								</div>
							</div>
							<div class="row text-left my-2">
								<div class="col-12">
									<p>Tarea Nro.: # <?= $t->id ?></p>
								</div>
							</div>
							<div class="row text-left my-2">
								<div class="col-12">
									<p>Descripción: <?= $t->description ?></p>
								</div>
							</div>
							<div class="row text-left my-2">
								<div class="col-12">
									<span>Creada: </span><small ><?= $t->created_at ?></small>
								</div>
							</div>
							<div class="row text-left my-2">
								<div class="col-12">
									<span>Actualizada: </span><small ><?= $t->updated_at ?></small>
								</div>
							</div>
							<?php if ($t->completed_at != '' ) : ?>
								<div class="row text-left my-2">
									<div class="col-12">
										<span>Completada: </span><small ><?= $t->completed_at ?></small>
									</div>
								</div>
							<?php endif; ?>
							<div class="row text-left my-2">
								<div class="col-12">
									<span>Estado: </span><small ><?= $t->completed === 'S' ? 'Completa' : 'Incompleta' ?></small>
								</div>
							</div>
						</div>
						<div class="card-footer text-body-secondary d-flex justify-content-center flex-wrap align-items-center">
							<button type="button" id="btnMarkAsComplete_<?= $t->id ?>" class="complete-task btn btn-outline-success rounded-pill mx-2"
									onclick="markAsComplete(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Marcar como completa">
								<i class="bi bi-check2-circle mx-1"></i>
							</button>
							<button type="button" id="btnDeleteTask_<?= $t->id ?>" class="delete-task btn btn-outline-danger rounded-pill mx-2"
									onclick="deleteTask(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
								<i class="bi bi-trash3 mx-1"></i>
							</button>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- container -->
