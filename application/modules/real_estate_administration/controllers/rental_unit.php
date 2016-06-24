<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Rental_unit extends admin {
	var $rental_unit_path;
	var $rental_unit_location;
	
	var $posts_path;
	var $posts_location;

	var $property_path;
	var $property_location;

	var $property_brochure_path;
	var $property_brochure_location;

	var $property_sale_contract_path;
	var $property_sale_contract_location;

	var $floor_plan_path;
	var $floor_plan_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('property_model');
		$this->load->model('admin/admin_model');
		$this->load->model('rental_unit_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->posts_path = realpath(APPPATH . '../assets/images/posts');
		$this->posts_location = base_url().'assets/images/posts';

		$this->property_path = realpath(APPPATH . '../assets/images/property');
		$this->property_location = base_url().'assets/images/property';

		$this->property_brochure_path = realpath(APPPATH . '../assets/brochures');
		$this->property_brochure_location = base_url().'assets/brochures/';

		$this->property_sale_contract_path = realpath(APPPATH . '../assets/images/sale_contracts');
		$this->property_sale_contract_location = base_url().'assets/images/sale_contracts/';

		$this->floor_plan_path = realpath(APPPATH . '../assets/images/floor_plan');
		$this->floor_plan_location = base_url().'assets/images/floor_plan/';
		
		$this->rental_unit_path = realpath(APPPATH . '../assets/rental_unit');
		$this->rental_unit_location = base_url().'assets/rental_unit/';
	}
    
	/*
	*
	*	Default action is to show all the registered rental_unit
	*
	*/
	public function index($property_id = NULL) 
	{
		$where = 'bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND rental_unit.property_id = property.property_id';
		$table = 'rental_unit, bedrooms, bathroom, car_spaces, property';
		
		if($property_id != NULL)
		{
			$where .= ' AND rental_unit.property_id = '.$property_id;
		}
		
		$rental_unit_search = $this->session->userdata('all_rental_unit_search');
		
		if(!empty($rental_unit_search))
		{
			$where .= $rental_unit_search;	
		}
		
		$segment = 4;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'rental-management/rental-units';
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
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->rental_unit_model->get_all_rental_units($table, $where, $config["per_page"], $page);
		$property_name = $this->property_model->get_property_name($property_id);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['property_id'] = $property_id;
		$v_data['rental_unit_location'] = $this->rental_unit_location;
		$v_data['title'] = $property_name.'\'s rental units';
			
		$data['content'] = $this->load->view('rental_unit/all_rental_units', $v_data, true);
		
		$data['title'] = 'All rental unit';
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function search_rental_units()
	{
		$unit_name = $this->input->post('unit_name');
				

		if(!empty($unit_name))
		{
			$unit_name = ' AND rental_unit.rental_unit_name  LIKE \'%'.$unit_name.'%\'';
		}
		else
		{
			$unit_name = '';
		}

		$search = $unit_name;

		$rental_unit_search = $this->session->userdata('all_rental_unit_search');
		
		
		$this->session->set_userdata('all_rental_unit_search', $search);
		$this->rental_units();
	}
	public function close_tenants_search()
	{
		$this->session->unset_userdata('all_rental_unit_search');		
		
		redirect('rental-management/rental-units');
	}
	
	public function add_rental_unit($property_id)
	{
		$this->session->unset_userdata('error_message');
		
		//upload image if it has been selected
		$response = $this->rental_unit_model->upload_rental_unit_image($this->property_path, $this->property_location);
		if($response)
		{
			//$v_data['blog_image_location'] = $this->post_location.$this->session->userdata('blog_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['rental_unit_image_error'] = $this->session->userdata('error_message');
		}
		
		//upload floor plan
		$response = $this->rental_unit_model->upload_rental_unit_floor_plan($this->floor_plan_path, $this->floor_plan_location);
		if($response)
		{
			//$v_data['blog_image_location'] = $this->post_location.$this->session->userdata('blog_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['rental_unit_image_error'] = $this->session->userdata('error_message');
		}
		$this->form_validation->set_rules('rental_unit_name', 'Rental Unit Name', 'required|xss_clean');
		$this->form_validation->set_rules('rental_unit_status', 'Rental Unit Status', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_video_id', 'Rental Unit Video ID', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_price', 'Rental Unit Price', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_price_type', 'Type', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_size', 'Rental Unit Size', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_land_size', 'Rental Unit Land Size', 'xss_clean');
		$this->form_validation->set_rules('lease_type_id', 'Lease Type', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_description', 'Rental Unit Description', 'trim|xss_clean');
		$this->form_validation->set_rules('bathroom_id', 'Rental Unit Bathrooms', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('bedroom_id', 'Rental Unit Bedroom', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_inspection_time', 'Inspection time', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_price_type', 'Rental Unit Price Type', 'xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'xss_clean');
		$this->form_validation->set_rules('lognitude', 'Longitude', 'xss_clean');
		$this->form_validation->set_rules('date_posted', 'Available Date', 'xss_clean');
		$this->form_validation->set_rules('car_space_id', 'Car Spaces', 'required|xss_clean');

		if ($this->form_validation->run())
		{	
			$file_name = $this->session->userdata('rental_unit_file_name');
			$floor_plan = $this->session->userdata('floor_plan_name');
			if(!empty($file_name))
			{
				$thumb_name = $this->session->userdata('rental_unit_thumb_name');
			}
			$rental_unit_id = $this->rental_unit_model->add_rental_unit($property_id, $file_name,$thumb_name, $floor_plan);
			if($rental_unit_id > 0)
			{
				$resize['width'] = 1170;
				$resize['height'] = 423;
				
				//upload brochure
				/*if(is_uploaded_file($_FILES['rental_unit_brochure']['tmp_name']))
				{
					$response2 = $this->upload_file('rental_unit_brochure', $this->rental_unit_brochure_path);
					if($response2['check'])
					{
						$this->db->where('rental_unit_id', $rental_unit_id);
						$this->db->update('rental_unit', array('rental_unit_brochure' => $response2['file_name']));
					}
					
					else
					{var_dump($response2['error']);die();
						$this->session->set_userdata('error_message', $response2['error']);
					}
				}*/
				
				//upload sale contract
				if(is_uploaded_file($_FILES['rental_unit_sale_contract']['tmp_name']))
				{
					$response3 = $this->upload_file('rental_unit_sale_contract', $this->property_sale_contract_path);
					if($response3['check'])
					{
						$this->db->where('rental_unit_id', $rental_unit_id);
						$this->db->update('rental_unit', array('rental_unit_sale_contract' => $response3['file_name']));
					}
					
					else
					{
						$this->session->set_userdata('error_message', $response3['error']);
					}
				}
				
				$response = $this->file_model->upload_gallery($rental_unit_id, $this->property_path, $resize);
				
				if($response)
				{
					$this->session->set_userdata('success_message', 'Property added successfully');
					redirect('rental-units/'.$property_id);
				}
				
				else
				{
					if(isset($response['upload']))
					{
						$this->session->set_userdata('error_message', $error['upload'][0]);
					}
					else if(isset($response['resize']))
					{
						$this->session->set_userdata('error_message', $error['resize'][0]);
					}
					redirect('rental-units/'.$property_id);
				}
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add the property type. Please try again');
			}
		}
		else
		{
			$this->session->set_userdata('error_message', validation_errors());
		}
		
		$bedrooms_query = $this->rental_unit_model->get_all_active_bedrooms();
		if($bedrooms_query->num_rows > 0)
		{
			$bedrooms_no = '<select class="form-control" name="bedroom_id">';
			
			foreach($bedrooms_query->result() as $res)
			{
				$bedrooms_no .= '<option value="'.$res->bedrooms_id.'">'.$res->bedrooms_no.'</option>';
			}
			$bedrooms_no .= '</select>';
			
			
		}
		
		else
		{
			$bedrooms_no = '<select class="form-control" name="bedroom_id">';
			
				$bedrooms_no .= '<option value="0">No bedrooms</option>';
			
			$bedrooms_no .= '</select>';
		}
		
		$bathrooms_query = $this->rental_unit_model->get_all_active_bathroom();
		if($bathrooms_query->num_rows > 0)
		{
			$bathroom_no = '<select class="form-control" name="bathroom_id">';
			
			foreach($bathrooms_query->result() as $res)
			{
				$bathroom_no .= '<option value="'.$res->bathroom_id.'">'.$res->bathroom_no.'</option>';
			}
			$bathroom_no .= '</select>';
		}
		
		else
		{
			$bathroom_no = '<select class="form-control" name="bathroom_id">';
			
				$bathroom_no .= '<option value="0">No bedrooms</option>';
			
			$bathroom_no .= '</select>';
		}
		$v_data['property_id'] = $property_id;
		$v_data['bathrooms'] = $bathroom_no;
		$v_data['bedrooms'] = $bedrooms_no;
		$data['title'] = $v_data['title'] = 'Add rental unit';
		$data['content'] = $this->load->view("rental_unit/add_rental_unit", $v_data, TRUE);
		$this->load->view('admin/templates/general_page', $data);
	}

	function edit_rental_unit($rental_unit_id, $property_id)
	{
		$this->session->unset_userdata('rental_unit_error_message');
		
		//upload image if it has been selected
		$this->session->unset_userdata('rental_unit_error_message');
		
		//upload image if it has been selected

		$this->session->unset_userdata('rental_unit_error_message');
		
		//upload image if it has been selected
		$response = $this->rental_unit_model->upload_rental_unit_image($this->property_path, $this->property_location);
		if($response)
		{
			//$v_data['blog_image_location'] = $this->post_location.$this->session->userdata('blog_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['rental_unit_image_error'] = $this->session->userdata('error_message');
		}
		
		//upload floor plan
		$response = $this->rental_unit_model->upload_rental_unit_floor_plan($this->floor_plan_path, $this->floor_plan_location);
		if($response)
		{
			//$v_data['blog_image_location'] = $this->post_location.$this->session->userdata('blog_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['rental_unit_image_error'] = $this->session->userdata('rental_unit_error_message');
		}
		
		$rental_unit_error = $this->session->userdata('rental_unit_error_message');//var_dump($rental_unit_error); die();
		
		$this->form_validation->set_rules('rental_unit_name', 'Rental Unit Name', 'required|xss_clean');
		$this->form_validation->set_rules('rental_unit_status', 'Rental Unit Status', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_video_id', 'Rental Unit Video ID', 'trim|xss_clean');
		$this->form_validation->set_rules('location_id', 'Location', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_type_id', 'Rental Unit Type', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_price', 'Rental Unit Price', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_price_type', 'Type', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_size', 'Rental Unit Size', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_land_size', 'Rental Unit Land Size', 'xss_clean');
		$this->form_validation->set_rules('lease_type_id', 'Lease Type', 'trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_description', 'Rental Unit Description', 'trim|xss_clean');
		$this->form_validation->set_rules('bathroom_id', 'Rental Unit Bathrooms', 'numeric|trim|xss_clean');
		$this->form_validation->set_rules('bedroom_id', 'Rental Unit Bedroom', 'numeric|trim|xss_clean');
		$this->form_validation->set_rules('rental_unit_inspection_time', 'Inspection time', 'xss_clean');
		$this->form_validation->set_rules('rental_unit_price_type', 'Rental Unit Price Type', 'xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'xss_clean');
		$this->form_validation->set_rules('lognitude', 'Longitude', 'xss_clean');
		$this->form_validation->set_rules('date_posted', 'Available Date', 'xss_clean');
		$this->form_validation->set_rules('car_space_id', 'Car Spaces', 'xss_clean');

		if ($this->form_validation->run())
		{	
		
			$floor_plan = $this->session->userdata('floor_plan_name');
			$file_name = $this->session->userdata('rental_unit_file_name');
			if(!empty($file_name))
			{
				$thumb_name = $this->session->userdata('rental_unit_thumb_name');
			}
			
			else{
				$file_name = $this->input->post('current_image');
				$thumb_name = 'thumbnail_'.$this->input->post('current_image');
			}
			if(empty($floor_plan))
			{
				$floor_plan = $this->input->post('current_floor_plan');
			}
			
			$this->rental_unit_model->update_rental_unit($file_name,$thumb_name,$rental_unit_id, $floor_plan);
			if($rental_unit_id > 0)
			{
				$resize['width'] = 1170;
				$resize['height'] = 423;
				
				//upload brochure
				/*if(is_uploaded_file($_FILES['rental_unit_brochure']['tmp_name']))
				{
					$response2 = $this->upload_file('rental_unit_brochure', $this->rental_unit_brochure_path);
					if($response2['check'])
					{
						$this->db->where('rental_unit_id', $rental_unit_id);
						$this->db->update('rental_unit', array('rental_unit_brochure' => $response2['file_name']));
					}
					
					else
					{
						$this->session->set_userdata('error_message', $response2['error']);
					}
				}*/
				
				//upload sale contract
				if(is_uploaded_file($_FILES['rental_unit_sale_contract']['tmp_name']))
				{
					$response3 = $this->upload_file('rental_unit_sale_contract', $this->property_sale_contract_path);//var_dump($response3);die();
					if($response3['check'])
					{
						$this->db->where('rental_unit_id', $rental_unit_id);
						$this->db->update('rental_unit', array('rental_unit_sale_contract' => $response3['file_name']));
					}
					
					else
					{
						$this->session->set_userdata('error_message', $response3['error']);
					}
				}
				
				$response = $this->file_model->upload_gallery($rental_unit_id, $this->property_path, $resize);
									
				if($response)
				{
					$this->session->set_userdata('success_message', 'Property updated successfully');
					redirect('rental-units/'.$property_id);
				}
				
				else
				{
					if(isset($response['upload']))
					{
						$this->session->set_userdata('error_message', $error['upload'][0]);
					}
					else if(isset($response['resize']))
					{
						$this->session->set_userdata('error_message', $error['resize'][0]);
					}
				}
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add the rental_unit type. Please try again');
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', validation_errors());
		}
		
		//open the add new post
		$data['title'] = $v_data['title'] = 'Edit Rental Unit';

		$query = $this->rental_unit_model->get_rental_unit($rental_unit_id);
		
		$v_data['rental_unit'] = $query->result();
		
		$v_data['property_id'] = $property_id;
		
		$v_data['property_brochure_location'] = $this->property_brochure_location;
		$v_data['property_sale_contract_location'] = $this->property_sale_contract_location;
		$v_data['gallery_images'] = $this->rental_unit_model->get_gallery_images($rental_unit_id);
		
		$data['content'] = $this->load->view("rental_unit/edit_rental_unit", $v_data, TRUE);
		$data['title'] = 'Edit Rental Unit';
		
		$this->load->view('admin/templates/general_page', $data);
	}
	
	function add_sub_units($rental_unit_id, $page)
	{
		//get rental_unit data
		$table = "rental_unit,property";
		$where = "property.property_id = rental_unit.property_id AND rental_unit.rental_unit_id = ".$rental_unit_id;
		
		$this->db->where($where);
		$rental_unit_query = $this->db->get($table);
		$v_data['query'] = $rental_unit_query;		
		
		$this->form_validation->set_rules('rental_unit_id', 'Rental Unit', 'required|trim|xss_clean');
		$this->form_validation->set_rules('units_name', 'Sub Unit Name', 'required|trim|xss_clean');

		if ($this->form_validation->run())
		{	
			$data2 = array(
				'units_name'=>$this->input->post("units_name"),
				'units_status'=>1,
				'rental_unit_id'=>$rental_unit_id
			);
			
			$table = "units";
			if($this->db->insert('units', $data2))
			{
				$this->session->set_userdata('success_message', 'Sub unit has been added');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Sub unit could not be added');
			}
			
			redirect('rental-management/rental-units/'.$page);
		}
		
		
		
		$data['content'] = $this->load->view("rental_unit/edit_rental_unit", $v_data, TRUE);
		$data['title'] = 'Edit rental_unit';
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing rental_unit
	*	@param int $rental_unit_id
	*
	*/
	function delete_rental_unit($rental_unit_id, $page)
	{
		//get rental_unit data
		$table = "rental_unit";
		$where = "rental_unit_id = ".$rental_unit_id;
		
		$this->db->where($where);
		$rental_unit_query = $this->db->get($table);
		$rental_unit_row = $rental_unit_query->row();
		$rental_unit_path = $this->rental_unit_path;
		
		$image_name = $rental_unit_row->rental_unit_image_name;
		
		//delete any other uploaded image
		$this->file_model->delete_file($rental_unit_path."\\".$image_name);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($rental_unit_path."\\thumbnail_".$image_name);
		
		if($this->rental_unit_model->delete_rental_unit($rental_unit_id))
		{
			$this->session->set_userdata('success_message', 'rental_unit has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'rental_unit could not be deleted');
		}
		redirect('real-estate-administration/rental-units/'.$page);
	}
    
	/*
	*
	*	Activate an existing rental_unit
	*	@param int $rental_unit_id
	*
	*/
	public function activate_rental_unit($rental_unit_id, $page = NULL)
	{
		if($this->rental_unit_model->activate_rental_unit($rental_unit_id))
		{
			$this->session->set_userdata('success_message', 'rental_unit has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'rental_unit could not be activated');
		}
		redirect('rental-management/rental-units/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing rental_unit
	*	@param int $rental_unit_id
	*
	*/
	public function deactivate_rental_unit($rental_unit_id, $page = NULL) 
	{
		if($this->rental_unit_model->deactivate_rental_unit($rental_unit_id))
		{
			$this->session->set_userdata('success_message', 'rental_unit has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'rental_unit could not be disabled');
		}
			redirect('rental-management/rental-units/'.$page);
	}

	function upload_file($file_name, $path)
	{
		//upload brochure
		if(isset($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]['tmp_name']))
		{
			$response = $this->file_model->upload_downloadable_file($path, $file_name);
			
			return $response;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function delete_gallery_image($image, $thumb, $image_id, $rental_unit_id, $property_id)
	{
		$property_path = $this->property_path;	
		$property_location = $this->property_location;	
		//delete any other uploaded image
		$this->file_model->delete_file($property_path."\\".$image, $property_location);
		
		//delete any other uploaded thumbnail
		$this->file_model->delete_file($property_path."\\".$thumb, $property_location);
		
		//delete from db
		$this->db->where('image_id', $image_id);
		if($this->db->delete('property_image'))
		{
			$this->session->set_userdata('success_message', 'Image deleted successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete image. Please try again');
		}
		
		redirect('edit-rental-unit/'.$rental_unit_id.'/'.$property_id);
	}
	
	public function delete_sale_contract($rental_unit_id, $property_id, $property_sale_contract)
	{
		$property_path = $this->property_brochure_path;	
		$property_brochure_location = $this->property_brochure_location;	
		//delete any other uploaded image
		$this->file_model->delete_file($property_path."\\".$property_sale_contract, $property_brochure_location);
		
		//delete from db
		$this->db->where('rental_unit_id', $rental_unit_id);
		if($this->db->update('rental_unit', array('rental_unit_sale_contract' => NULL)))
		{
			$this->session->set_userdata('success_message', 'Sale contract deleted successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to delete sale contact. Please try again');
		}
		
		redirect('edit-rental-unit/'.$rental_unit_id.'/'.$property_id);
	}
}
?>