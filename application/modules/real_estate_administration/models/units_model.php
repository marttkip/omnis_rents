<?php

class Units_model extends CI_Model 
{	
	/*
	*	Retrieve all units
	*
	*/
	public function all_units()
	{
		$this->db->where('units_status = 1');
		$query = $this->db->get('units');
		
		return $query;
	}
	/*
	*	Retrieve latest units
	*
	*/
	public function latest_units()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('units');
		
		return $query;
	}
	/*
	*	Retrieve all parent units
	*
	*/
	public function all_parent_units()
	{
		$this->db->where('units_status = 1 AND units_parent = 0');
		$this->db->order_by('units_name', 'ASC');
		$query = $this->db->get('units');
		
		return $query;
	}
	/*
	*	Retrieve all children units
	*
	*/
	public function all_child_units()
	{
		$this->db->where('units_status = 1 AND units_parent > 0');
		$this->db->order_by('units_name', 'ASC');
		$query = $this->db->get('units');
		
		return $query;
	}
	
	/*
	*	Retrieve all units
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_units($table, $where, $per_page, $page, $order = 'units_name', $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new units
	*	@param string $image_name
	*
	*/
	public function add_units($rental_unit_id)
	{
		$data = array(
				'units_name'=>$this->input->post('units_name'),
				'rental_unit_id'=>$rental_unit_id,
				'units_status'=>$this->input->post('units_status'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('units', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing units
	*	@param string $image_name
	*	@param int $units_id
	*
	*/
	public function update_units($units_id)
	{
		$data = array(
				'units_name'=>$this->input->post('units_name'),
				'units_status'=>$this->input->post('units_status'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('units_id', $units_id);
		if($this->db->update('units', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single units's children
	*	@param int $units_id
	*
	*/
	public function get_sub_units($units_id)
	{
		//retrieve all users
		$this->db->from('units');
		$this->db->select('*');
		$this->db->where('units_parent = '.$units_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single units's details
	*	@param int $units_id
	*
	*/
	public function get_units($units_id)
	{
		//retrieve all users
		$this->db->from('units');
		$this->db->select('*');
		$this->db->where('units_id = '.$units_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing units
	*	@param int $units_id
	*
	*/
	public function delete_units($units_id)
	{
		if($this->db->delete('units', array('units_id' => $units_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated units
	*	@param int $units_id
	*
	*/
	public function activate_units($units_id)
	{
		$data = array(
				'units_status' => 1
			);
		$this->db->where('units_id', $units_id);
		

		if($this->db->update('units', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated units
	*	@param int $units_id
	*
	*/
	public function deactivate_units($units_id)
	{
		$data = array(
				'units_status' => 0
			);
		$this->db->where('units_id', $units_id);
		
		if($this->db->update('units', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>