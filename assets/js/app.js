/**
 * app Functions
 * ------------------
 */
$(document).ready(function() {
	init();

	showLoading(false);

	//add validaciones
	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});

	const validator = $( "#tasks-form" ).validate({
		rules: {
			title: "required",
			duedate: {
				required: true,
				date: true
			}
		},
		messages: {
			title: "Este campo es obligatorio",
			duedate: {
				required: "Este campo es obligatorio",
				date: "Ingrese un formato de fecha válido"
			}
		}
	});

	//limpiar el modal antes de abrirlo
	$('#taskModal').on('hide.bs.modal', function() {
		$('#tasks-form')[0].reset();
		$('#tasks-form').validate().resetForm();
	});

	//guardar task
	$('#btnModalConfirm').click(function(){
		let valid = validator.form();
		if(valid){
			let endpoint = $('#taskId').val() !== '' ? 'edit' : 'create';
			let title = $('#title').val();
			let description = $('#description').val();
			let duedate = $('#duedate').val() !== '' ? $('#duedate').val() : null ;
			let completed = $('#completed').is(':checked') ? 'S':'N';

			showLoading(true);

			$.ajax({
				type: "POST",
				url: base_url+endpoint,
				data: {
					"id": $('#taskId').val(),
					"title": title,
					"description": description,
					"duedate": duedate,
					"completed": completed
				},
				dataType: "json",
				success: function(result){
					showLoading(false);

					handleResponse (result);

					//oculta el modal
					if(result.action)
						$('#taskModal').modal('hide');
				}
			});
		}
	});
});

const viewDetails = (id) => {
	// Select the toast-body element
	let toastBody = $("#notifyToast .toast-body");

	showLoading(true);
	$.ajax({
		type: "POST",
		url: base_url+'task-details',
		data: {
			"id": id,
			"isEditing": false
		},
		dataType: "json",
		success: function(result){
			showLoading(false);
			if(result.action){
				//carga los inputs con el resultado
				taskId = id;
				$('#titleDetails').val(result.title);
				$('#descriptionDetails').val(result.description);
				$('#duedateDetails').val(result.duedate);
				$('#createDateDetails').val(result.created_at);
				$('#updateDateDetails').val(result.updated_at);
				$('#completedAtDateDetails').val(result.completed_at);

				$('#completedDetails').prop('checked', (result.completed === 'S'));

				//mustra el modal
				$('#taskDetailsModal').modal('show');
			} else {
				//muestra el mensaje de error
				toastBody.text(result.message);

				$("#notifyToast").removeClass("text-bg-primary").addClass("text-bg-danger");

				$("#notifyToast").toast("show");
			}
		}
	});
}

const init = () => {
	// inicializa los tooltips de bs
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}

// recupera los datos de la task y vuelve a mostrar el modal para editarla
const editTask = (id) => {
	// Select the toast-body element
	let toastBody = $("#notifyToast .toast-body");

	showLoading(true);
	$.ajax({
		type: "POST",
		url: base_url+'task-details',
		data: {
			"id": id,
			"isEditing": true
		},
		dataType: "json",
		success: function(result){
			showLoading(false);

			if(result.action){
				//carga los inputs con el resultado
				$('#taskId').val(id);
				$('#title').val(result.title);
				$('#description').val(result.description);
				$('#duedate').val(result.duedate);
				$("#duedate").data("vto", result.duedate);

				$('#completed').attr('disabled', false);
				$('#completed').prop('checked', (result.completed === 'S'));

				//mustra el modal
				$('#taskModal').modal('show');
			} else {
				//muestra el mensaje de error
				toastBody.text(result.message);

				$("#notifyToast").removeClass("text-bg-primary").addClass("text-bg-danger");

				$("#notifyToast").toast("show");
			}
		}
	});
}

const markAsComplete = (id) => {
	let endpoint= 'mark-as-complete';

	showLoading(true);
	$.ajax({
		type: "POST",
		url: base_url+endpoint,
		data: {
			"id": id
		},
		dataType: "json",
		success: function(result){
			showLoading(false);

			handleResponse (result);
		}
	});
}

const deleteTask = (id) => {
	$.confirm({
		title: 'Eliminar Tarea',
		content: '¿Confirma eliminar el registro?',
		theme: 'modern',
		type: 'red',
		typeAnimated: true,
		escapeKey: 'cancel',
		closeIcon: true,
		draggable: false,
		closeAnimation: 'opacity',
		backgroundDismiss: true,
		buttons: {
			confirm: {
				text: 'Confirmar',
				btnClass: 'btn btn-danger',
				action: function () {
					confirmDeleteTask(id);
				}
			},
			cancel: {
				text: 'Cancelar',
				action: function () {}
			}
		}
	});
}

const confirmDeleteTask = (id) => {
	let endpoint= 'delete';

	showLoading(true);
	$.ajax({
		type: "POST",
		url: base_url+endpoint,
		data: {
			"id": id
		},
		dataType: "json",
		success: function(result){
			showLoading(false);

			handleResponse (result);
		}
	});
}

const toTop = () =>{
	window.scrollTo({
		top: 0,
		behavior: 'smooth'
	});
}

const handleResponse = (result) => {
	// Select the toast-body element
	let toastBody = $("#notifyToast .toast-body");

	if(result.action){
		//muestra el mensaje de exito
		toastBody.text(result.message);

		$("#notifyToast").removeClass("text-bg-danger").addClass("text-bg-success");

		toTop();
		$("#notifyToast").toast("show");

		setTimeout(function () {
			//recarga la página para actualizar los datos
			location.reload();
		}, 1500);

	} else {
		//muestra el mensaje de error
		toastBody.text(result.message);

		$("#notifyToast").removeClass("text-bg-success").addClass("text-bg-danger");

		toTop();
		$("#notifyToast").toast("show");
	}
}

const showLoading = (show) => {
	if(show){
		$('#spinner').show();
		$('#backdrop').show();
	} else {
		$('#spinner').hide();
		$('#backdrop').hide();
	}
}
