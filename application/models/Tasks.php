<?php
class Tasks extends CI_Model {

	private $table = 'tasks';

	public function __construct() {
		$this->load->dbutil();
	}

	/**
	 * Get all from database.
	 *
	 * @return array
	 */
	public function getAll($onlyCompleted = false, $onlyOverdue = false) {
		$this->db->select("t.id, t.title, t.description, t.completed, t.deleted, DATE_FORMAT(duedate, '%d/%m/%Y') AS formated_duedate, duedate, 
			DATE_FORMAT(created_at, '%d/%m/%Y %H:%i:%s') AS created_at,  DATE_FORMAT(updated_at, '%d/%m/%Y %H:%i:%s') AS updated_at, 
			DATE_FORMAT(completed_at, '%d/%m/%Y %H:%i:%s') AS completed_at, 
			case when t.duedate < CURDATE() then 'vencida' 
				when t.duedate > CURDATE() then 'a-tiempo' 
			 	when t.duedate = CURDATE() then 'por-vencer' 
			 	else '' end  as status")
			// Siempre recupera las que no fueron borradas
			->where('t.deleted', 'N');

		if ($onlyCompleted)
			$this->db->where('t.completed', 'S');

		if ($onlyOverdue){
			$where = " t.duedate < CURDATE() ";
			$this->db->where($where);
		}

		// como las completadas no tienen fecha de vencimiento se ordenan por fecha de completitud
		if ($onlyCompleted)
			$this->db->order_by('completed_at desc');
		else
			$this->db->order_by('duedate desc');

		$query = $this->db->get($this->table . ' t');
		$results = $query->result();

		return count($results) > 0 ? $results : false;
	}

	/**
	 * Get task from database by ID.
	 *
	 * @param int $id
	 * @return bool|object
	 */
	public function getById($id, $isEditing = false) {
		$select = "t.id, t.title, t.description, t.completed, t.deleted, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i:%s') AS created_at,
			DATE_FORMAT(updated_at, '%d/%m/%Y %H:%i:%s') AS updated_at, DATE_FORMAT(completed_at, '%d/%m/%Y %H:%i:%s') AS completed_at, ";

		if($isEditing)
			$select .= " DATE_FORMAT(duedate, '%Y-%m-%d') AS duedate ";
		else
			$select .= " DATE_FORMAT(duedate, '%d/%m/%Y') AS duedate ";

		$this->db->select($select);

		$query = $this->db->where('t.id', $id)->get($this->table . ' t');
		return count($query->result()) == 1 ? $query->row() : false;
	}

//------ Esta app no tiene borrado físico pero se deja de ejemplo
	/**
	 * Remove tasks from database.
	 *
	 * @param int $id
	 * @return bool
	 */
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows() == 1;
	}
//----------

	/**
	 * mark task as deleted.
	 *
	 * @param integer $id
	 * @param array $data
	 * @return bool
	 */
	public function markAsDeleted($id, $data) {
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}

	/**
	 * Update & mark as completed .
	 *
	 * @param integer $id
	 * @param array $data
	 * @return bool
	 */
	public function markAsCompleted($id, $data) {
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}

	/**
	 * Update task.
	 *
	 * @param integer $id
	 * @param array $data
	 * @return bool
	 */
	public function update($id, $data) {
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return true;
	}

	/**
	 * Insert task in database.
	 *
	 * @param array $data
	 * @return bool
	 */
	public function add($data) {
		$data['created_at'] = date('Y-m-d H:i:s');

		$query = $this->db->insert($this->table, $data);
		return $query ? $this->db->insert_id() : false;
	}
}
?>
