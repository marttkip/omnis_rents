<?php

class Rental_unit_model extends CI_Model 
{	
	public function get_all_rental_units($table, $where, $per_page, $page)
	{
		//retrieve all rental_unit
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('rental_unit.rental_unit_id,rental_unit.rental_unit_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Delete an existing rental_unit
	*	@param int $rental_unit_id
	*
	*/
	public function delete_rental_unit($rental_unit_id)
	{
		if($this->db->delete('rental_unit', array('rental_unit_id' => $rental_unit_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function add_rental_unit($property_id, $file_name,$thumb_name, $floor_plan)
	{
		$data = array(
				'rental_unit_name'=>ucwords(strtolower($this->input->post('rental_unit_name'))),
				'rental_unit_status'=>$this->input->post('rental_unit_status'),
				'rental_unit_description'=>$this->input->post('rental_unit_description'),
				'rental_unit_video_id'=>$this->input->post('rental_unit_video_id'),
				'rental_unit_bathrooms'=>$this->input->post('bathroom_id'),
				'created_on'=>date("Y-m-d H:i:s"),
				'bedrooms'=>$this->input->post('bedroom_id'),
				'rental_unit_price'=>$this->input->post('rental_unit_price'),
				'rental_unit_size'=>$this->input->post('rental_unit_size'),
				'last_modified_by'=>$this->session->userdata('user_id'),
				'actual_date'=>$this->input->post('date_posted'),
				'rental_unit_price_type'=>$this->input->post('rental_unit_price_type'),
				'rental_unit_inspection_time'=>$this->input->post('rental_unit_inspection_time'),
				'lease_type_id'=>$this->input->post('lease_type_id'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
				'car_space_id'=>$this->input->post('car_space_id'),
				'rental_unit_thumb'=>$thumb_name,
				'rental_unit_image'=>$file_name,
				'property_id'=>$property_id,
				'floor_plan'=>$floor_plan
			);
			
		if($this->db->insert('rental_unit', $data))
		{
			$this->session->unset_userdata('property_file_name');
			$this->session->unset_userdata('property_thumb_name');
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	
	public function update_rental_unit($file_name, $thumb_name, $rental_unit_id, $floor_plan)
	{
		$data = array(
				'rental_unit_name'=>ucwords(strtolower($this->input->post('rental_unit_name'))),
				'rental_unit_status'=>$this->input->post('rental_unit_status'),
				'rental_unit_description'=>$this->input->post('rental_unit_description'),
				'rental_unit_video_id'=>$this->input->post('rental_unit_video_id'),
				'rental_unit_bathrooms'=>$this->input->post('bathroom_id'),
				'created_on'=>date("Y-m-d H:i:s"),
				'bedrooms'=>$this->input->post('bedroom_id'),
				'rental_unit_price'=>$this->input->post('rental_unit_price'),
				'rental_unit_size'=>$this->input->post('rental_unit_size'),
				'last_modified_by'=>$this->session->userdata('user_id'),
				'actual_date'=>$this->input->post('date_posted'),
				'rental_unit_price_type'=>$this->input->post('rental_unit_price_type'),
				'rental_unit_inspection_time'=>$this->input->post('rental_unit_inspection_time'),
				'lease_type_id'=>$this->input->post('lease_type_id'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
				'car_space_id'=>$this->input->post('car_space_id'),
				'rental_unit_thumb'=>$thumb_name,
				'rental_unit_image'=>$file_name,
				'floor_plan'=>$floor_plan
			);
		$this->db->where('rental_unit_id', $rental_unit_id);
		if($this->db->update('rental_unit', $data))
		{
			$this->session->unset_userdata('property_file_name');
			$this->session->unset_userdata('property_thumb_name');
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	/*
	*	Activate a deactivated rental_unit
	*	@param int $rental_unit_id
	*
	*/
	public function activate_rental_unit($rental_unit_id)
	{
		$data = array(
				'rental_unit_status' => 1
			);
		$this->db->where('rental_unit_id', $rental_unit_id);
		
		if($this->db->update('rental_unit', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated rental_unit
	*	@param int $rental_unit_id
	*
	*/
	public function deactivate_rental_unit($rental_unit_id)
	{
		$data = array(
				'rental_unit_status' => 0
			);
		$this->db->where('rental_unit_id', $rental_unit_id);
		
		if($this->db->update('rental_unit', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_active_rental_unit()
	{
  		$table = "rental_unit";
		$where = "rental_unit_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}

	public function get_tenancy_details($rental_unit_id)
	{
		$table = "tenant_unit";
		$where = "rental_unit_id = ".$rental_unit_id." AND tenant_unit_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_rental_unit_name($rental_unit_id)
	{
		$table = "rental_unit";
		$where = "rental_unit_id = ".$rental_unit_id;
		
		$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$rental_unit_name =$key->rental_unit_name;
			}
			return $rental_unit_name;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_rental_unit($rental_unit_id)
	{
		$table = "rental_unit";
		$where = "rental_unit_id = ".$rental_unit_id;
		
		$this->db->where($where);
		return $this->db->get($table);
	}
	
	public function upload_rental_unit_image($rental_unit_path, $rental_unit_base)
	{
		//upload product's gallery images
		$resize['width'] = 800;
		$resize['height'] = 500;
		
		if(isset($_FILES['post_image']['tmp_name']))
		{
			if(file_exists($_FILES['post_image']['tmp_name']) || is_uploaded_file($_FILES['post_image']['tmp_name']))
			{
				$file_name = $this->session->userdata('rental_unit_file_name');
				if(!empty($file_name))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($rental_unit_path."\\".$this->session->userdata('rental_unit_file_name'),$rental_unit_base);
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($rental_unit_path."\\thumbnail_".$this->session->userdata('rental_unit_file_name'),$rental_unit_base);
				}
				//Upload image
				$response = $this->file_model->upload_file($rental_unit_path, 'post_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
					
					//crop file to 1920 by 1010
					$response_crop = $this->file_model->crop_file($rental_unit_path."\\".$file_name, $resize['width'], $resize['height']);
					
					if(!$response_crop)
					{
						$this->session->set_userdata('rental_unit_error_message', $response_crop);
					
						return FALSE;
					}
					
					else
					{	
						//Set sessions for the image details
						$this->session->set_userdata('rental_unit_file_name', $file_name);
						$this->session->set_userdata('rental_unit_thumb_name', $thumb_name);
					
						return TRUE;
					}
				}
			
				else
				{
					$this->session->set_userdata('rental_unit_error_message', $response['error']);
					
					return FALSE;
				}
			}
		}
		
		else
		{
			$this->session->set_userdata('rental_unit_error_message', '');
			return FALSE;
		}
	}
	
	public function upload_rental_unit_floor_plan($floor_plan_path, $floor_plan_location)
	{
		if(isset($_FILES['post_image']['tmp_name']))
		{
			if(file_exists($_FILES['floor_plan']['tmp_name']) || is_uploaded_file($_FILES['floor_plan']['tmp_name']))
			{
				$file_name = $this->session->userdata('floor_plan_name');
				if(!empty($file_name))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($floor_plan_path."\\".$this->session->userdata('floor_plan_name'), $floor_plan_location);
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($floor_plan_path."\\thumbnail_".$this->session->userdata('floor_plan_name'), $floor_plan_location);
				}
				//Upload image
				$response = $this->file_model->upload_file($floor_plan_path, 'floor_plan', NULL);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					
					//Set sessions for the image details
					$this->session->set_userdata('floor_plan_name', $file_name);
				
					return TRUE;
				}
			
				else
				{
					$this->session->set_userdata('rental_unit_error_message', $response['error']);
					
					return FALSE;
				}
			}
		}
		
		else
		{
			$this->session->set_userdata('rental_unit_error_message', '');
			return FALSE;
		}
	}
	public function get_all_active_bedrooms()
	{
		$this->db->where('bedrooms_id <> 0');
		$this->db->order_by('bedrooms_id');
		$query = $this->db->get('bedrooms');
		
		return $query;
	}
	public function get_all_active_bathroom()
	{
		$this->db->where('bathroom_id <> 0');
		$this->db->order_by('bathroom_id');
		$query = $this->db->get('bathroom');
		
		return $query;
	}
	public function get_all_min_active_prices()
	{
		$this->db->where('price_id <> 0');
		$this->db->order_by('price_id');
		$query = $this->db->get('prices');
		
		return $query;
	}
	public function get_all_max_active_prices()
	{
		$this->db->where('price_id <> 0');
		$this->db->order_by('price desc');
		$query = $this->db->get('prices');
		
		return $query;
	}
	public function get_all_active_prices2()
	{
		$this->db->where('price_id <> 0');
		$this->db->order_by('price', 'DESC');
		$query = $this->db->get('prices');
		
		return $query;
	}
	public function get_all_active_car_spaces()
	{
		$this->db->where('car_space_id <> 0');
		$this->db->order_by('car_space_id');
		$query = $this->db->get('car_spaces');
		
		return $query;
	}
	public function get_gallery_images($property_id)
	{

		//retrieve all users
		$this->db->from('property_image');
		$this->db->select('*');
		$this->db->where('property_id = '.$property_id);
		$query = $this->db->get();
		
		return $query;

	}
	public function save_gallery_file($rental_unit_id, $file_name, $thumb)
	{
		$data = array(
				'property_id'=>$rental_unit_id,
				'property_image_thumb'=>$file_name,
				'property_image'=>$thumb
			);
			
		if($this->db->insert('property_image', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
