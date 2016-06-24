<?php

class Site_model extends CI_Model 
{
	public function get_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = ucwords(strtolower($page[0]));
		
		$home = '';
		$contact = '';
		$about = '';
		$request = '';
		$news = '';
		$properties = '';
		$development = '';
		
		if($name == 'Home')
		{
			$home = 'active';
		}
		
		if($name == 'About')
		{
			$about = 'active';
		}
		
		if($name == 'Contact')
		{
			$contact = 'active';
		}
		
		if($name == 'News')
		{
			$news = 'active';
		}
		
		if($name == 'Request')
		{
			$contact = 'active';
		}
		
		if($name == 'Properties')
		{
			$properties = 'active';
		}
		
		if($name == 'Development')
		{
			$development = 'active';
		}
		
		$navigation = 
		'
		  <li class="'.$home.'">
                    <a href="'.base_url().'home">Home</a>
                  
                </li>
                 <li class="'.$properties.'">
                    <a href="'.base_url().'properties">Properties</a>
                    <ul class="sub-menu">
                        <li><a href="'.base_url().'properties/for-sale">For Sale</a></li>
                        <li><a href="'.base_url().'properties/sold">Sold</a></li>
                    </ul>
                </li>
                <li class="'.$development.'">
                    <a href="'.base_url().'development">Development portfolio</a>
                </li>
                <li class="'.$about.'">
                    <a href="'.base_url().'about">About us</a>
                </li>
                <!--<li class="'.$news.'">
                    <a href="'.base_url().'news">News & trends</a>
                </li>-->
                 <li class="'.$contact.'">
                    <a href="'.base_url().'request">Request an appraisal</a>
                </li>
                <li class="'.$contact.'"><a href="'.base_url().'contact">Contact</a></li>
		';
		
		return $navigation;
	}

	public function get_slides()
	{
  		$table = "slideshow";
		$where = "slideshow_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function limit_text($text, $limit) 
	{
		$pieces = explode(" ", $text);
		$total_words = count($pieces);
		
		if ($total_words > $limit) 
		{
			$return = "<i>";
			$count = 0;
			for($r = 0; $r < $total_words; $r++)
			{
				$count++;
				if(($count%$limit) == 0)
				{
					$return .= $pieces[$r]."</i><br/><i>";
				}
				else{
					$return .= $pieces[$r]." ";
				}
			}
		}
		
		else{
			$return = "<i>".$text;
		}
		return $return.'</i><br/>';
    }
	/*
	*	Retrieve latest products
	*
	*/
	public function get_latest_properties()
	{
		$this->db->select('*')->from('property,rental_unit, location,property_type,bathroom,bedrooms,car_spaces')->where("bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id")->order_by("rental_unit.actual_date", 'DESC');
		$query = $this->db->get('',12);
		
		return $query;
	}
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
	public function get_properties($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('property.sale_status ASC, property.actual_date DESC');
		$query = $this->db->get('', 6);
		
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

	public function get_property_details($rental_unit_id)
	{
		//retrieve all users
		$this->db->select('*')->from('property, rental_unit, location,property_type,bathroom,bedrooms,car_spaces')->where("bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id AND rental_unit.rental_unit_id = ".$rental_unit_id)->order_by("rental_unit.actual_date", 'DESC');
		
		$query = $this->db->get();
		
		return $query;
	}
	/*
	*	Retrieve featured products
	*
	*/
	public function get_featured_properties()
	{
		$this->db->select('*')->from('property, rental_unit, location,property_type,bathroom,bedrooms,car_spaces')->where("bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id AND rental_unit.featured = 1")->order_by("rental_unit.actual_date", 'DESC');
		
		$this->db->order_by('rental_unit.created_on', 'DESC');
		
		$query = $this->db->get();
		
		return $query;
	}
	public function display_page_title()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$page_url = ucwords(strtolower($page[0]));
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.$sub_page[$r];
			}
			$page_url .= ' | '.ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$page_url .= ' | '.ucwords(strtolower($category_name));
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$page_url .= ' | '.ucwords(strtolower($brand_name));
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$page_url .= ' | '.ucwords(strtolower($product_name));
			}
		}
		
		return $page_url;
	}
	
	public function get_crumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$crumb[0]['name'] = ucwords(strtolower($page[0]));
		$crumb[0]['link'] = $page[0];
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.$sub_page[$r];
			}
			$crumb[1]['name'] = ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($category_name));
				$crumb[2]['link'] = 'products/category/'.$category_id;
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($brand_name));
				$crumb[2]['link'] = 'products/brand/'.$brand_id;
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($product_name));
				$crumb[2]['link'] = 'products/view-product/'.$product_id;
			}
			
			else
			{
				$crumb[1]['link'] = '#';
			}
		}
		
		return $crumb;
	}
	
	function generate_price_range()
	{
		$max_price = $this->products_model->get_max_product_price();
		//$min_price = $this->products_model->get_min_product_price();
		
		$interval = $max_price/5;
		
		$range = '';
		$start = 0;
		$end = 0;
		
		for($r = 0; $r < 5; $r++)
		{
			$end = $start + $interval;
			$value = 'KES '.number_format(($start+1), 0, '.', ',').' - KES '.number_format($end, 0, '.', ',');
			$range .= '<label> <input type="radio" name="agree" value="'.$start.'-'.$end.'"  /> '.$value.'</label> <br>';
			
			$start = $end;
		}
		
		return $range;
	}
	public function request_newsletter()
	{
		$data = array(
			'created_on'=>date('Y-m-d'),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'email_address'=>$this->input->post('email_address')
		);
		
		if($this->db->insert('newsletter_requests', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	public function send_message()
	{
		$data = array(
			'created_on'=>date('Y-m-d'),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'phone_number'=>$this->input->post('phone_number'),
			'message'=>$this->input->post('message'),
			'email_address'=>$this->input->post('email_address')
		);
		
		if($this->db->insert('clients_messages', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	public function send_appraisal()
	{
		$data = array(
			'created_on'=>date('Y-m-d'),
			'first_name'=>$this->input->post('app_first_name'),
			'last_name'=>$this->input->post('app_last_name'),
			'phone_number'=>$this->input->post('phone_number'),
			'address'=>$this->input->post('address'),
			'property_type_id'=>$this->input->post('property_type_id'),
			'bedroom_id'=>$this->input->post('bedroom_id'),
			'bathroom_id'=>$this->input->post('bathroom_id'),
			'car_space_id'=>$this->input->post('car_space_id'),
			'email_address'=>$this->input->post('email_address')
		);
		
		if($this->db->insert('appraisal_requests', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}

	}
	
	public function get_contacts()
	{
  		$table = "branch";
		
		$query = $this->db->get($table);
		$contacts = array();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$contacts['email'] = $row->branch_email;
			$contacts['phone'] = $row->branch_phone;
			$contacts['company_name'] = $row->branch_name;
			$contacts['logo'] = $row->branch_image_name;
			$contacts['address'] = $row->branch_address;
			$contacts['city'] = $row->branch_city;
			$contacts['post_code'] = $row->branch_post_code;
			$contacts['building'] = $row->branch_building;
			$contacts['floor'] = $row->branch_floor;
			$contacts['location'] = $row->branch_location;
			$contacts['working_weekend'] = $row->branch_working_weekend;
			$contacts['working_weekday'] = $row->branch_working_weekday;
		}
		return $contacts;
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", $field_name);
		
		return $web_name;
	}
	
	public function decode_web_name($web_name)
	{
		$field_name = str_replace("-", " ", $web_name);
		
		return $field_name;
	}
	
	public function image_display($base_path, $location, $image_name = NULL)
	{
		$default_image = 'http://placehold.it/300x300&text=Autospares';
		$file_path = $base_path.'/'.$image_name;
		//echo $file_path.'<br/>';
		
		//Check if image was passed
		if($image_name != NULL)
		{
			if(!empty($image_name))
			{
				if((file_exists($file_path)) && ($file_path != $base_path.'\\'))
				{
					return $location.$image_name;
				}
				
				else
				{
					return $default_image;
				}
			}
			
			else
			{
				return $default_image;
			}
		}
		
		else
		{
			return $default_image;
		}
	}
}

?>