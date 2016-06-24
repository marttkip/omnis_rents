<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Sub_units extends admin 
{
	var $units_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('units_model');
		$this->load->model('rental_unit_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->units_path = realpath(APPPATH . '../assets/images/units');
	}
    
	/*
	*
	*	Default action is to show all the units
	*
	*/
	public function index($rental_unit_id, $order = 'units_name', $order_method = 'ASC') 
	{
		$where = 'units_id > 0';
		$table = 'units';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin/units/'.$order.'/'.$order_method;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->units_model->get_all_units($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'Sub Units';
		$v_data['title'] = $data['title'];
		$v_data['rental_unit_details'] = $this->rental_unit_model->get_rental_unit($rental_unit_id);
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['all_units'] = $this->units_model->all_units();
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('units/all_units', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new units
	*
	*/
	public function add_units($rental_unit_id, $property_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('units_name', 'Sub Unit Name', 'required|xss_clean');
		$this->form_validation->set_rules('units_status', 'Sub Unit Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->units_model->add_units($rental_unit_id))
			{
				$this->session->set_userdata('success_message', 'Sub Unit added successfully');
				redirect('sub-units/'.$rental_unit_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add units. Please try again');
			}
		}
		
		//open the add new units
		
		$data['title'] = 'Add units';
		$v_data['title'] = $data['title'];
		$v_data['rental_unit_id'] = $rental_unit_id;
		$data['content'] = $this->load->view('units/add_units', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing units
	*	@param int $units_id
	*
	*/
	public function edit_units($rental_unit_id, $units_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('units_name', 'Sub Unit Name', 'required|xss_clean');
		$this->form_validation->set_rules('units_status', 'Sub Unit Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->units_model->update_units($units_id))
			{
				$this->session->set_userdata('success_message', 'Sub Unit updated successfully');
				redirect('sub-units/'.$rental_unit_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update units. Please try again');
			}
		}
		
		//open the add new units
		$data['title'] = 'Edit sub unit';
		$v_data['title'] = $data['title'];
		
		//select the units from the database
		$query = $this->units_model->get_units($units_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['units'] = $query->result();
			$data['content'] = $this->load->view('units/edit_units', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Sub Unit does not exist';
		}
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing units
	*	@param int $units_id
	*
	*/
	public function delete_units($units_id, $rental_unit_id)
	{
		$this->units_model->delete_units($units_id);
		$this->session->set_userdata('success_message', 'Sub Unit has been deleted');
		redirect('sub-units/'.$rental_unit_id);
	}
    
	/*
	*
	*	Activate an existing units
	*	@param int $units_id
	*
	*/
	public function activate_units($units_id, $rental_unit_id)
	{
		$this->units_model->activate_units($units_id);
		$this->session->set_userdata('success_message', 'Sub Unit activated successfully');
		redirect('sub-units/'.$rental_unit_id);
	}
    
	/*
	*
	*	Deactivate an existing units
	*	@param int $units_id
	*
	*/
	public function deactivate_units($units_id, $rental_unit_id)
	{
		$this->units_model->deactivate_units($units_id);
		$this->session->set_userdata('success_message', 'Sub Unit disabled successfully');
		redirect('sub-units/'.$rental_unit_id);
	}
}
?>