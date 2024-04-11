<!-- toast -->
<div aria-live="polite" aria-atomic="true" class="position-relative">
	<div class="toast-container top-0 end-0 p-3">
		<div id="notifyToast" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body">
					...
				</div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
	</div>
</div>
<!-- toast -->
<!-- container -->
<div class="container">
	<div class="row my-4">
		<!-- App Title -->
		<div class="col-12 text-center">
			<h1>Bienvenido a <?= $title ?>!</h1>
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
						<button id="btnOpenTaskModal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
							<i class="bi bi-plus-circle-dotted"></i>
							Agregar
						</button>
					</div>
				</div>
			<!--	Recorre los datos recibidos para armar las cards -->
			<?php else: ?>
				<div class="row text-center">
					<div class="col-12 my-3">
						<button id="btnOpenTaskModalNew" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
							<i class="bi bi-plus-circle-dotted"></i>
							Nueva Tarea
						</button>
					</div>
				</div>
				<?php foreach ($tasks as $t) : ?>
					<!--	Si esta completada muestra en otro color para diferenciar -->
					<div class="card text-bg-<?= $t->completed !== 'S' ? 'dark' : 'success' ?> mb-3">
						<?php if ($t->completed !== 'S' && $t->duedate !== null) : ?>
							<div class="card-header text-center">
								<!--	En las task completadas no mostrar la fecha de vto ni el badge (porque ya esta lista la task) -->
									<span>Vencimiento: </span> <?= $t->formated_duedate ?>
									<h5 class="badge text-bg-<?= $t->status === 'a-tiempo' ? 'success' : ($t->status === 'vencida' ? 'danger' : 'warning') ?> ">
										<?= $t->status ?>
									</h5>
							</div>
						<?php endif; ?>
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
							<?php if ($t->updated_at != '' ) : ?>
								<div class="row text-left my-2">
									<div class="col-12">
										<span>Actualizada: </span><small ><?= $t->updated_at ?></small>
									</div>
								</div>
							<?php endif; ?>
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
							<!--	En las task completadas tampoco permite editar si ya se completo -->
							<?php if ($t->completed !== 'S') : ?>
								<button type="button" id="btnEditTask_<?= $t->id ?>" class="edit-task btn btn-outline-primary rounded-pill mx-2"
										onclick="editTask(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
									<i class="bi bi-pencil mx-1"></i>
								</button>
								<button type="button" id="btnMarkAsComplete_<?= $t->id ?>" class="complete-task btn btn-outline-success rounded-pill mx-2"
										onclick="markAsComplete(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Marcar como completa">
									<i class="bi bi-check2-circle mx-1"></i>
								</button>
								<button type="button" id="btnDeleteTask_<?= $t->id ?>" class="delete-task btn btn-outline-danger rounded-pill mx-2"
										onclick="deleteTask(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
									<i class="bi bi-trash3 mx-1"></i>
								</button>
							<?php else: ?>
							<button type="button" id="btnViewTask_<?= $t->id ?>" class="view-task btn btn-outline-light rounded-pill mx-2"
									onclick="viewDetails(<?= $t->id ?>)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver detalles">
								<i class="bi bi-folder2-open mx-1"></i>
							</button>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="taskModal" aria-labelledby="taskModalLabel" aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="taskModalLabel">Agregar nuevo pendiente</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" id="tasks-form" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="taskId" id="taskId" value="">
					<div class="row mb-3">
						<div class="col-12">
							<div class="">
								<label for="title" class="form-label">Título de la tarea</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Ingresá un título">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<div class="">
								<label for="description" class="form-label">Descripción</label>
								<textarea class="form-control" placeholder="Ingresar una descripción" id="description" name="description" style="height: 100px"></textarea>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<div class="">
								<label for="duedate" class="form-label">Fecha de Vencimiento</label>
								<input type="date" class="form-control" id="duedate" placeholder="date"  name="duedate" data-vto="">
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" role="switch" id="completed" name="completed" disabled>
								<label class="form-check-label" for="completed">Marcar como completada</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="btnModalConfirm" type="button" class="btn btn-primary">
					<i class="bi bi-check-circle"></i> Guardar
				</button>
				<button id="btnModalCancel" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					<i class="bi bi-x-circle-fill"></i> Cancelar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- container -->
