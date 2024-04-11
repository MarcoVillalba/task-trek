<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TasksController extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load model
		$this->load->model('Tasks');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index() {
		$title = 'Task Trek';

		$tasks = $this->Tasks->getAll();

		$this->viewdata['title'] = $title;
		$this->viewdata['tasks'] = $tasks;
		$this->load->view('layouts/header', $this->viewdata);
		$this->load->view('apps/all-tasks', $this->viewdata);
		$this->load->view('layouts/footer');
	}

	/**
	 * view completed task.
	 */
	public function viewCompleted() {
		$title = 'Task Trek | Tareas Completas';

		$tasks = $this->Tasks->getAll(true);

		$this->viewdata['title'] = $title;
		$this->viewdata['tasks'] = $tasks;
		$this->load->view('layouts/header', $this->viewdata);
		$this->load->view('apps/completed', $this->viewdata);
		$this->load->view('layouts/footer');
	}

	/**
	 * view all overdue task.
	 */
	public function viewOverdue() {
		$title = 'Task Trek | Tareas Vencidas';

		$tasks = $this->Tasks->getAll(false, true);

		$this->viewdata['title'] = $title;
		$this->viewdata['tasks'] = $tasks;
		$this->load->view('layouts/header', $this->viewdata);
		$this->load->view('apps/overdue', $this->viewdata);
		$this->load->view('layouts/footer');
	}

	/**
	 * Process create form.
	 *
	 */
	public function processCreate() {

		$response = new stdClass();

		$this->load->helper(array('form', 'url'));

		// Validations
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('duedate', 'Fecha de Vencimiento', 'required');

		$data = $this->input->post();

		// clean value before insert
		$data['duedate'] = $data['duedate'] === '' ? null : $data['duedate'];

		// Filter allowed fields
		$fields = ['title', 'description', 'duedate', 'completed'];
		$data = array_filter(
			$data,
			function ($key) use ($fields) {
				return in_array($key, $fields);
			},
			ARRAY_FILTER_USE_KEY
		);

		if (!$this->form_validation->run()) {
			$response->action = false;
			$response->message = validation_errors();
			$this->setAjaxResponse($response);
		} else {
			$inserted = $this->Tasks->add($data);

			if ($inserted) {
				$response->action = true;
				$response->message = 'Tarea cargada con éxito';
			} else {
				$response->action = false;
				$response->message = 'Ocurrió un error al intentar insertar en la base de datos';
				$this->db->trans_rollback();
			}
		}
		$this->setAjaxResponse($response);
	}

	/**
	 * Process edit form.
	 *
	 * @return void
	 */
	public function processEdit() {

		$response = new stdClass();

		$this->load->helper(array('form', 'url'));

		$id = $this->input->post('id');

		// Validations
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('duedate', 'Fecha de Vencimiento', 'required');

		$data = $this->input->post();

		// puede marcar como completada al editar
		if($data['completed'] === 'S') {
			//remove due date
			$data['duedate'] = null;

			// add completed date
			$data['completed_at'] = date('Y-m-d H:i:s');
		} else
			// clean value before insert
			$data['duedate'] = $data['duedate'] === '' ? null : $data['duedate'];

		// Filter allowed fields
		$fields = ['title', 'description', 'duedate', 'completed'];
		$data = array_filter(
			$data,
			function ($key) use ($fields) {
				return in_array($key, $fields);
			},
			ARRAY_FILTER_USE_KEY
		);

		if (!$this->form_validation->run()) {
			$response->action = false;
			$response->message = validation_errors();
			$this->setAjaxResponse($response);
		} else {
			$task = $this->Tasks->getById($id);

			if (!$id || !$task) {
				$response->action = false;
				$response->message = 'Error recuperando la tarea';
			} else {
				$updated = $this->Tasks->update($id, $data);

				if ($updated) {
					$response->action = true;
					$response->message = 'Tarea actualizada con éxito';
				} else {
					$response->action = false;
					$response->message = 'Ocurrió un error al intentar actualizar la base de datos';
					$this->db->trans_rollback();
				}
			}

		}
		$this->setAjaxResponse($response);
	}

	/**
	 * Mark task as complete.
	 *
	 * @return void
	 */
	public function markAsComplete() {

		$response = new stdClass();

		$id = $this->input->post('id');

		$task = $this->Tasks->getById($id);

		if (!$id || !$task) {
			$response->action = false;
			$response->message = 'Error recuperando la tarea';
		} else {
			// mark as complete
			$data['completed'] = 'S';

			//remove due date
			$data['duedate'] = null;

			// add completed date
			$data['completed_at'] = date('Y-m-d H:i:s');

			$updated = $this->Tasks->markAsCompleted($id, $data);

			if ($updated) {
				$response->action = true;
				$response->message = 'Tarea actualizada con éxito';
			} else {
				$response->action = false;
				$response->message = 'Ocurrió un error al intentar actualizar la base de datos';
				$this->db->trans_rollback();
			}
		}
		$this->setAjaxResponse($response);
	}

	/**
	 * Mark task as deleted.
	 *
	 * @return void
	 */
	public function markAsDelete() {

		$response = new stdClass();

		$id = $this->input->post('id');

		$task = $this->Tasks->getById($id);

		if (!$id || !$task) {
			$response->action = false;
			$response->message = 'Error recuperando la tarea';
		} else {
			// mark as deleted
			$data['deleted'] = 'S';

			$updated = $this->Tasks->markAsDeleted($id, $data);

			if ($updated) {
				$response->action = true;
				$response->message = 'Tarea eliminada con éxito';
			} else {
				$response->action = false;
				$response->message = 'Ocurrió un error al intentar actualizar la base de datos';
				$this->db->trans_rollback();
			}
		}
		$this->setAjaxResponse($response);
	}

	/**
	 * load task details .
	 *
	 * @return void
	 */
	public function getDetails() {

		$response = new stdClass();

		$id = $this->input->post('id');
		$isEditing = $this->input->post('isEditing');

		$task = $this->Tasks->getById($id, $isEditing);

		if (!$id || !$task) {
			$response->action = false;
			$response->message = 'Error recuperando la tarea';
		} else {
			$response->action = true;
			$response->title = $task->title;
			$response->description = $task->description;
			$response->completed = $task->completed;
			$response->duedate =  $task->duedate;
			$response->completed_at = $task->completed_at;
			$response->created_at = $task->created_at;
			$response->updated_at = $task->updated_at;
		}
		$this->setAjaxResponse($response);
	}

	private function setAjaxResponse ($v) {
		$this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode($v))
			->_display();
		die;
	}
}
