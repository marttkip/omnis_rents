<?php

class Property_model extends CI_Model 
{	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_property_type()
	{
		$this->db->where('property_type_status = 1');
		$this->db->order_by('property_type_name');
		$query = $this->db->get('property_type');
		
		return $query;

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
	public function get_all_active_locations()
	{
		$this->db->where('location_status = 1');
		$this->db->order_by('location_name');
		$query = $this->db->get('location');
		
		return $query;

	}
	
	/*
	*	Delete an existing location
	*	@param int $location_id
	*
	*/
	public function delete_location($location_id)
	{
		if($this->db->delete('location', array('location_id' => $location_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_all_post_categories($blog_category_id)
	{
		$this->db->where('blog_category.blog_category_id = '.$blog_category_id.' OR blog_category.blog_category_parent = '.$blog_category_id);
		$this->db->order_by('blog_category_parent, blog_category_name');
		$query = $this->db->get('blog_category');
		
		return $query;
	}
	
	/*
	*	Retrieve all active categories
	*
	*/
	public function get_all_active_category_parents()
	{
		$this->db->where('blog_category_status = 1 AND blog_category_parent = 0');
		$this->db->order_by('blog_category_name');
		$query = $this->db->get('blog_category');
		
		return $query;
	}
	
	/*
	*	Retrieve all active children
	*
	*/
	public function get_all_active_category_children($blog_category_id)
	{
		$this->db->where('blog_category_status = 1 AND blog_category_parent = '.$blog_category_id);
		$this->db->order_by('blog_category_name');
		$query = $this->db->get('blog_category');
		
		return $query;
	}
	/*
	*	Retrieve all active posts
	*
	*/
	public function all_active_posts()
	{
		$this->db->where('post_status = 1');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	/*
	*	Retrieve latest post
	*
	*/
	public function latest_post()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('post');
		
		return $query;
	}
	
	/*
	*	Retrieve all posts
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_properties($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('property.actual_date', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	public function get_all_newsletter_requests($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('first_name', 'ASC');
		$this->db->order_by('last_name', 'ASC');
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	function export_newsletter_requests()
	{
		$this->load->library('excel');
		
		$table = 'newsletter_requests';
		
		
		$this->db->order_by('first_name', 'ASC');
		$this->db->order_by('last_name', 'ASC');
		$this->db->order_by('created_on', 'DESC');
		
		$query = $this->db->get($table);
		
		$title = 'Newsletter requests '.date('jS M Y H:i:a',strtotime(date('Y-m-d H:i:a')));
		
		if($query->num_rows() > 0)
		{
			$count = 0;
			/*
				-----------------------------------------------------------------------------------------
				Document Header
				-----------------------------------------------------------------------------------------
			*/

			$row_count = 0;
			$report[$row_count][0] = '#';
			$report[$row_count][1] = 'First name';
			$report[$row_count][2] = 'Last name';
			$report[$row_count][3] = 'Email address';
			$report[$row_count][4] = 'Date created';
			
			foreach($query->result() as $row)
			{
				$row_count++;
				
				$first_name = $row->first_name;
				$last_name = $row->last_name;
				$email_address = $row->email_address;
				$created_on = date('jS M Y',strtotime($row->created_on));
				
				$count++;
				
				//display the patient data
				$report[$row_count][0] = $count;
				$report[$row_count][1] = $first_name;
				$report[$row_count][2] = $last_name;
				$report[$row_count][3] = $email_address;
				$report[$row_count][4] = $created_on;
			}
		}
		
		//create the excel document
		$this->excel->addArray ( $report );
		$this->excel->generateXML ($title);
	}
	
	public function get_all_appraisals($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('a.created_on', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

	public function get_all_properties_types($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new post
	*	@param string $image_name
	*
	*/
	public function add_property_type()
	{
		$data = array(
				'property_type_name'=>ucwords(strtolower($this->input->post('property_type_name'))),
				'property_type_status'=>$this->input->post('property_type_status'),
				'created_on'=>date("Y-m-d"),
				'created_by'=>$this->session->userdata('user_id'),
				'last_modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('property_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing post
	*	@param string $image_name
	*	@param int $post_id
	*
	*/
	public function update_property_type($property_type_id)
	{
		$data = array(
				'property_type_name'=>ucwords(strtolower($this->input->post('property_type_name'))),
				'property_type_status'=>$this->input->post('property_type_status'),
				'last_modified_on'=>date("Y-m-d"),
				'last_modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('property_type_id', $property_type_id);
		if($this->db->update('property_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	/*
	*	Activate a deactivated post
	*	@param int $post_id
	*
	*/
	public function activate_property_type($property_type_id)
	{
		$data = array(
				'property_type_status' => 1
			);
		$this->db->where('property_type_id', $property_type_id);
		
		if($this->db->update('property_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated property_type
	*	@param int $property_type_id
	*
	*/
	public function deactivate_property_type($property_type_id)
	{
		$data = array(
				'property_type_status' => 0
			);
		$this->db->where('property_type_id', $property_type_id);
		
		if($this->db->update('property_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}



	public function get_all_locations($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('created_on', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new post
	*	@param string $image_name
	*
	*/
	public function add_location()
	{
		$data = array(
				'location_name'=>ucwords(strtolower($this->input->post('location_name'))),
				'location_status'=>$this->input->post('location_status'),
				'created_on'=>date("Y-m-d"),
				'created_by'=>$this->session->userdata('user_id'),
				'last_modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('location', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing post
	*	@param string $image_name
	*	@param int $post_id
	*
	*/
	public function update_location($location_id)
	{
		$data = array(
				'location_name'=>ucwords(strtolower($this->input->post('location_name'))),
				'location_status'=>$this->input->post('location_status'),
				'last_modified_on'=>date("Y-m-d"),
				'last_modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('location_id', $location_id);
		if($this->db->update('location', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	/*
	*	Activate a deactivated post
	*	@param int $post_id
	*
	*/
	public function activate_location($location_id)
	{
		$data = array(
				'location_status' => 1
			);
		$this->db->where('location_id', $location_id);
		
		if($this->db->update('location', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated location
	*	@param int $location_id
	*
	*/
	public function deactivate_location($location_id)
	{
		$data = array(
				'location_status' => 0
			);
		$this->db->where('location_id', $location_id);
		
		if($this->db->update('location', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function get_location($location_id)
	{
		//retrieve all users
		$this->db->from('location');
		$this->db->select('*');
		$this->db->where('location_id = '.$location_id);
		$query = $this->db->get();
		
		return $query;
	}


	public function add_property($image_name,$thumb_namem, $floor_plan)
	{
		$data = array(
				'property_name'=>ucwords(strtolower($this->input->post('property_name'))),
				'property_status'=>$this->input->post('property_status'),
				'property_description'=>$this->input->post('property_description'),
				'property_type_id'=>$this->input->post('property_type_id'),
				'location_id'=>$this->input->post('location_id'),
				'lease_type_id'=>$this->input->post('lease_type_id'),
				'property_video_id'=>$this->input->post('property_video_id'),
				'property_bathrooms'=>$this->input->post('bathroom_id'),
				'created_on'=>date("Y-m-d H:i:s"),
				'bedrooms'=>$this->input->post('bedroom_id'),
				'land_size'=>$this->input->post('property_land_size'),
				'property_price'=>$this->input->post('property_price'),
				'property_size'=>$this->input->post('property_size'),
				'last_modified_by'=>$this->session->userdata('user_id'),
				'actual_date'=>$this->input->post('date_posted'),
				'property_price_type'=>$this->input->post('property_price_type'),
				'property_inspection_time'=>$this->input->post('property_inspection_time'),
				
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
				
				'car_space_id'=>$this->input->post('car_space_id'),
				'property_thumb'=>$thumb_name,
				'property_image'=>$image_name,
				'floor_plan'=>$floor_plan
			);
			
		if($this->db->insert('property', $data))
		{
			$this->session->unset_userdata('property_file_name');
			$this->session->unset_userdata('property_thumb_name');
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}

	public function update_property($image_name,$thumb_name,$property_id, $floor_plan)
	{
		$data = array(
				'property_name'=>ucwords(strtolower($this->input->post('property_name'))),
				'property_status'=>$this->input->post('property_status'),
				'property_description'=>$this->input->post('property_description'),
				'property_type_id'=>$this->input->post('property_type_id'),
				'location_id'=>$this->input->post('location_id'),
				'lease_type_id'=>$this->input->post('lease_type_id'),
				'property_video_id'=>$this->input->post('property_video_id'),
				'property_bathrooms'=>$this->input->post('property_bathrooms'),
				'sale_status'=>$this->input->post('sold_status'),
				'bedrooms'=>$this->input->post('bedrooms'),
				'bedrooms'=>$this->input->post('bedrooms'),
				'land_size'=>$this->input->post('property_land_size'),
				'property_price'=>$this->input->post('property_price'),
				'property_size'=>$this->input->post('property_size'),
				'last_modified_by'=>$this->session->userdata('user_id'),
				'actual_date'=>$this->input->post('date_posted'),
				'property_inspection_time'=>$this->input->post('property_inspection_time'),
				'property_price_type'=>$this->input->post('property_price_type'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
				
				'car_space_id'=>$this->input->post('car_space_id'),
				'property_thumb'=>$thumb_name,
				'property_image'=>$image_name,
				'floor_plan'=>$floor_plan
			);
		$this->db->where('property_id', $property_id);
		if($this->db->update('property', $data))
		{
			$this->session->unset_userdata('property_file_name');
			$this->session->unset_userdata('property_thumb_name');
			return $property_id;
		}
		else{
			return FALSE;
		}
	}
	public function save_gallery_file($property_id, $file_name, $thumb)
	{
		$data = array(
				'property_id'=>$property_id,
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
	public function get_property($property_id)
	{
		//retrieve all users
		$this->db->from('property');
		$this->db->select('*');
		$this->db->where('property_id = '.$property_id);
		$query = $this->db->get();
		
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
	/*
	*	Update an existing post
	*	@param string $image_name
	*	@param int $post_id
	*
	*/
	public function update_post($image_name, $thumb_name, $post_id)
	{
		$data = array(
				'post_title'=>ucwords(strtolower($this->input->post('post_title'))),
				'post_status'=>$this->input->post('post_status'),
				'post_content'=>$this->input->post('post_content'),
				'blog_category_id'=>$this->input->post('blog_category_id'),
				'created'=>$this->input->post('created'),
				'modified_by'=>$this->session->userdata('user_id'),
				'post_thumb'=>$thumb_name,
				'post_image'=>$image_name
			);
			
		$this->db->where('post_id', $post_id);
		if($this->db->update('post', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
	*	get a single post's details
	*	@param int $post_id
	*
	*/
	public function get_property_type($property_type_id)
	{
		//retrieve all users
		$this->db->from('property_type');
		$this->db->select('*');
		$this->db->where('property_type_id = '.$property_type_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single post's details
	*	@param int $post_id
	*
	*/
	public function get_post($post_id)
	{
		//retrieve all users
		$this->db->from('post');
		$this->db->select('*');
		$this->db->where('post_id = '.$post_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing post's comments
	*	@param int $post_id
	*
	*/
	public function delete_post_comments($post_id)
	{
		if($this->db->delete('post_comment', array('post_id' => $post_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing post
	*	@param int $post_id
	*
	*/
	public function delete_post($post_id)
	{
		if($this->db->delete('post', array('post_id' => $post_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated post
	*	@param int $post_id
	*
	*/
	public function activate_post($post_id)
	{
		$data = array(
				'post_status' => 1
			);
		$this->db->where('post_id', $post_id);
		
		if($this->db->update('post', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated post
	*	@param int $post_id
	*
	*/
	public function deactivate_post($post_id)
	{
		$data = array(
				'post_status' => 0
			);
		$this->db->where('post_id', $post_id);
		
		if($this->db->update('post', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve comments
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_comments($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('post.post_title, post.created, post.post_image, post_comment.*');
		$this->db->where($where);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new comment
	*	@param int $post_id
	*
	*/
	public function add_comment_admin($post_id)
	{
		$data = array(
				'post_comment_description'=>$this->input->post('post_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'post_comment_user'=>$this->session->userdata('first_name'),
				'post_comment_email'=>$this->session->userdata('email'),
				'post_id'=>$post_id
			);
			
		if($this->db->insert('post_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new comment
	*	@param int $post_id
	*
	*/
	public function add_comment_user($post_id)
	{
		$data = array(
				'post_comment_description'=>$this->input->post('post_comment_description'),
				'comment_created'=>date('Y-m-d H:i:s'),
				'post_comment_user'=>$this->input->post('name'),
				'post_comment_email'=>$this->input->post('email'),
				'post_comment_status'=>0,
				'post_id'=>$post_id
			);
			
		if($this->db->insert('post_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_comment_title($post_id)
	{
		if($post_id > 0)
		{
			$query = $this->get_post($post_id);
			
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$title = $row->post_title;
			}
			
			else
			{
				$title = '';
			}
		}
			
		else
		{
			$title = '';
		}
		
		return $title;	
	}
	
	/*
	*	Delete an existing comment
	*	@param int $post_comment_id
	*
	*/
	public function delete_comment($post_comment_id)
	{
		if($this->db->delete('post_comment', array('post_comment_id' => $post_comment_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated comment
	*	@param int $post_comment_id
	*
	*/
	public function activate_comment($post_comment_id)
	{
		$data = array(
				'post_comment_status' => 1
			);
		$this->db->where('post_comment_id', $post_comment_id);
		
		if($this->db->update('post_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated comment
	*	@param int $post_comment_id
	*
	*/
	public function deactivate_comment($post_comment_id)
	{
		$data = array(
				'post_comment_status' => 0
			);
		$this->db->where('post_comment_id', $post_comment_id);
		
		if($this->db->update('post_comment', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function update_views_count($post_id)
	{
		//get count of views
		$this->db->where('post_id', $post_id);
		$query = $this->db->get('post');
		$row = $query->row();
		$total = $row->post_views;
		
		//increment comments
		$total++;
		
		//update
		$data = array(
				'post_views' => $total
			);
		$this->db->where('post_id', $post_id);
		
		if($this->db->update('post', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve all categories
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_categories($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('blog_category_name', 'ASC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new category
	*	@param int $post_id
	*
	*/
	public function add_blog_category()
	{
		$data = array(
				'blog_category_name'=>ucwords(strtolower($this->input->post('blog_category_name'))),
				'blog_category_status'=>$this->input->post('blog_category_status'),
				'blog_category_parent'=>$this->input->post('blog_category_parent'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('blog_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing category
	*	@param int $blog_category_id
	*
	*/
	public function update_blog_category($blog_category_id)
	{
		$data = array(
				'blog_category_name'=>ucwords(strtolower($this->input->post('blog_category_name'))),
				'blog_category_status'=>$this->input->post('blog_category_status'),
				'blog_category_parent'=>$this->input->post('blog_category_parent'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('blog_category_id', $blog_category_id);
		if($this->db->update('blog_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single category's details
	*	@param int $blog_category_id
	*
	*/
	public function get_blog_category($blog_category_id)
	{
		//retrieve all users
		$this->db->from('blog_category');
		$this->db->select('*');
		$this->db->where('blog_category_id = '.$blog_category_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing post's comments by category id
	*	@param int $blog_category_id
	*
	*/
	public function delete_category_post_comments($blog_category_id)
	{
		$this->db->where(array('blog_category_id' => $blog_category_id));
		$this->db->select('post_id');
		$query = $this->db->get('post');
		$row = $query->row();
		$post_id = $row->post_id;
		
		if($this->db->delete('post_comment', array('post_id' => $post_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing post
	*	@param int $blog_category_id
	*
	*/
	public function delete_category_posts($blog_category_id)
	{
		if($this->db->delete('post', array('blog_category_id' => $blog_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing category
	*	@param int $blog_category_id
	*
	*/
	public function delete_blog_category($blog_category_id)
	{
		if($this->db->delete('blog_category', array('blog_category_id' => $blog_category_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated category
	*	@param int $blog_category_id
	*
	*/
	public function activate_blog_category($blog_category_id)
	{
		$data = array(
				'blog_category_status' => 1
			);
		$this->db->where('blog_category_id', $blog_category_id);
		
		if($this->db->update('blog_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated category
	*	@param int $blog_category_id
	*
	*/
	public function deactivate_blog_category($blog_category_id)
	{
		$data = array(
				'blog_category_status' => 0
			);
		$this->db->where('blog_category_id', $blog_category_id);
		
		if($this->db->update('blog_category', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve recent posts
	*
	*/
	public function get_recent_posts()
	{
		$this->db->from('post');
		$this->db->select('post.*');
		$this->db->where('post_status = 1');
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('', 3);
		
		return $query;
	}
	
	/*
	*	Retrieve popular posts
	*
	*/
	public function get_popular_posts()
	{
		$this->db->from('post');
		$this->db->select('post.*');
		$this->db->where('post_status = 1');
		$this->db->order_by('post_views', 'DESC');
		$query = $this->db->get('', 3);
		
		return $query;
	}
	
	/*
	*	Retrieve related posts
	*
	*/
	public function get_related_posts($blog_category_id, $post_id)
	{
		$this->db->from('post, blog_category');
		$this->db->select('post.*');
		$this->db->where('post.post_id <> '.$post_id.' AND post.post_status = 1 AND post.blog_category_id = blog_category.blog_category_id AND (blog_category.blog_category_id = '.$blog_category_id.' OR blog_category.blog_category_parent = '.$blog_category_id.')');
		$this->db->order_by('post.created', 'DESC');
		$query = $this->db->get('', 4);
		
		return $query;
	}
	
	/*
	*	Retrieve comments
	* 	@param int $post_id
	*
	*/
	public function get_post_comments($post_id)
	{
		//retrieve all users
		$this->db->from('post_comment');
		$this->db->select('post_comment.*');
		$this->db->where('post_comment_status = 1 AND post_id = '.$post_id);
		$this->db->order_by('comment_created', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function upload_property_image($property_path)
	{
		//upload product's gallery images
		$resize['width'] = 768;
		$resize['height'] = 534;
		
		if(isset($_FILES['post_image']['tmp_name']))
		{
			if(file_exists($_FILES['post_image']['tmp_name']) || is_uploaded_file($_FILES['post_image']['tmp_name']))
			{
				$file_name = $this->session->userdata('property_file_name');
				if(!empty($file_name))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($property_path."\\".$this->session->userdata('property_file_name'));
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($property_path."\\thumbnail_".$this->session->userdata('property_file_name'));
				}
				//Upload image
				$response = $this->file_model->upload_file($property_path, 'post_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
					
					//crop file to 1920 by 1010
					$response_crop = $this->file_model->crop_file($property_path."\\".$file_name, $resize['width'], $resize['height']);
					
					if(!$response_crop)
					{
						$this->session->set_userdata('property_error_message', $response_crop);
					
						return FALSE;
					}
					
					else
					{	
						//Set sessions for the image details
						$this->session->set_userdata('property_file_name', $file_name);
						$this->session->set_userdata('property_thumb_name', $thumb_name);
					
						return TRUE;
					}
				}
			
				else
				{
					$this->session->set_userdata('property_error_message', $response['error']);
					
					return FALSE;
				}
			}
		}
		
		else
		{
			$this->session->set_userdata('property_error_message', '');
			return FALSE;
		}
	}
	
	public function upload_property_floor_plan($floor_plan_path)
	{
		if(isset($_FILES['post_image']['tmp_name']))
		{
			if(file_exists($_FILES['floor_plan']['tmp_name']) || is_uploaded_file($_FILES['floor_plan']['tmp_name']))
			{
				$file_name = $this->session->userdata('floor_plan_name');
				if(!empty($file_name))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($floor_plan_path."\\".$this->session->userdata('floor_plan_name'));
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($floor_plan_path."\\thumbnail_".$this->session->userdata('floor_plan_name'));
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
					$this->session->set_userdata('property_error_message', $response['error']);
					
					return FALSE;
				}
			}
		}
		
		else
		{
			$this->session->set_userdata('property_error_message', '');
			return FALSE;
		}
	}
}
?>