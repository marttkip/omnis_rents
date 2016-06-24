<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller {

	var $property_brochure_location;

	var $property_sale_contract_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site/site_model');
		//$this->load->model('login/login_model');
		$this->load->model('admin/users_model');
		$this->load->model('admin/blog_model');
		$this->load->model('property_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		//echo 'here';
		redirect('home');
	}
    
	/*
	*
	*	Home Page
	*
	*/
	public function home_page() 
	{
		//get page data
		$v_data['latest'] = $this->site_model->get_latest_properties();
		$v_data['featured'] = $this->site_model->get_featured_properties();
		$v_data['slides'] = $this->site_model->get_slides();
		$v_data['property_type_names'] = $this->site_model->get_property_types();
		// $v_data['brands'] = $this->brands_model->all_active_brands();
		// $v_data['all_children'] = $this->categories_model->all_child_categories();
		// $v_data['parent_categories'] = $this->categories_model->all_parent_categories();

		$property_type_query = $this->site_model->get_property_types();
		if($property_type_query->num_rows > 0)
		{
			$property_types = '';
			
			foreach($property_type_query->result() as $res)
			{
				$property_types .= '<li class="'.$res->property_type_name.'"><a href="#" data-filter=".'.$res->property_type_name.'">'.$res->property_type_name.'</a></li>';
			}
			$property_types .= '';
			
			
		}
		$v_data['property_types'] = $property_types;

		$data['content'] = $this->load->view('home/home', $v_data, true);
		
		//$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}

	public function service($service_id = NULL) 
	{
		$v_data['service_id'] = 1;
		$data['content'] = $this->load->view('service/properties', $v_data, true);
		
		//$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	public function property() 
	{
		$where = 'bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id';
		$table = 'property,rental_unit, location,property_type,bathroom,bedrooms,car_spaces';
		//pagination
		$this->load->library('pagination');
		$segment = 2;
		$config['base_url'] = base_url().'properties';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 6;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Older';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Newer';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_properties($table, $where, $config["per_page"], $page);
		$property_type_query = $this->site_model->get_property_types();
		if($property_type_query->num_rows > 0)
		{
			$property_types = '';
			
			foreach($property_type_query->result() as $res)
			{
				$property_types .= '<li class="'.$res->property_type_name.'"><a href="#" data-filter=".'.$res->property_type_name.'">'.$res->property_type_name.'</a></li>';
			}
			$property_types .= '';
			
			
		}
		$v_data['property_types'] = $property_types;
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'There are no properties';
		}
		$data['title'] = 'All properties';
		
		$this->load->view('templates/general_page', $data);

	}
	public function properties()
	{
		$where = 'bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id';
		$table = 'property,rental_unit, location,property_type,bathroom,bedrooms,car_spaces';
		$segment = 2;
		$search_property = $this->session->userdata('property_search');
		
		if(!empty($search_property))
		{
			$where .= $search_property;
		}
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'properties';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Newer';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Older';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_properties($table, $where, $config["per_page"], $page);
		$property_type_query = $this->site_model->get_property_types();
		if($property_type_query->num_rows > 0)
		{
			$property_types = '';
			
			foreach($property_type_query->result() as $res)
			{
				$property_types .= '<li class="'.$res->property_type_name.'"><a href="#" data-filter=".'.$res->property_type_name.'">'.$res->property_type_name.'</a></li>';
			}
			$property_types .= '';
			
			
		}
		$v_data['property_types'] = $property_types;
		$v_data['title'] = 'Properties found';

		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_onsale', $v_data, true);
		}
		
		else
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_onsale', $v_data, true);
		}
		
		$this->load->view('templates/general_page', $data);
	}


	public function property_onsale()
	{
		$where = 'bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id AND rental_unit.sale_status = 1';
		$table = 'property,rental_unit, location,property_type,bathroom,bedrooms,car_spaces';
		$segment = 3;
		
		$search = $this->session->userdata('property_sold_search');
		
		if(!empty($search))
		{
			$where .= $search;
		}
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'site/property_onsale';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Newer';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Older';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_all_properties($table, $where, $config["per_page"], $page);
		$property_type_query = $this->site_model->get_property_types();
		if($property_type_query->num_rows > 0)
		{
			$property_types = '';
			
			foreach($property_type_query->result() as $res)
			{
				$property_types .= '<li class="'.$res->property_type_name.'"><a href="#" data-filter=".'.$res->property_type_name.'">'.$res->property_type_name.'</a></li>';
			}
			$property_types .= '';
			
			
		}
		$v_data['property_types'] = $property_types;
		$v_data['title'] = 'Properties for sale';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_onsale', $v_data, true);
		}
		
		else
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_onsale', $v_data, true);
		}
	
		
		$this->load->view('templates/general_page', $data);
	}

	public function property_sold()
	{
		$where = 'bathroom.bathroom_id = rental_unit.rental_unit_bathrooms AND bedrooms.bedrooms_id = rental_unit.bedrooms AND car_spaces.car_space_id = rental_unit.car_space_id AND property.property_status = 1 AND rental_unit.rental_unit_status AND location.location_id = property.location_id AND property_type.property_type_id = property.property_type_id AND rental_unit.sale_status = 2';
		$table = 'property,rental_unit, location,property_type,bathroom,bedrooms,car_spaces';
		$segment = 3;
		
		$search = $this->session->userdata('property_search');
		
		if(!empty($search))
		{
			$where .= $search;
		}
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'site/property_sold';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Newer';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Older';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_all_properties($table, $where, $config["per_page"], $page);
		$property_type_query = $this->site_model->get_property_types();
		if($property_type_query->num_rows > 0)
		{
			$property_types = '';
			
			foreach($property_type_query->result() as $res)
			{
				$property_types .= '<li class="'.$res->property_type_name.'"><a href="#" data-filter=".'.$res->property_type_name.'">'.$res->property_type_name.'</a></li>';
			}
			$property_types .= '';
			
			
		}
		$v_data['property_types'] = $property_types;
		$v_data['title'] = 'Properties To Let';
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_sold', $v_data, true);
		}
		
		else
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('property/property_sold', $v_data, true);
		}
		
		
		$this->load->view('templates/general_page', $data);
	}
	
	public function blog() 
	{
		$where = 'post.blog_category_id = blog_category.blog_category_id AND post.post_status = 1';
		$segment = 3;
		$table = 'post, blog_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'news';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 2;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Newer';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Older';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->blog_model->get_all_posts($table, $where, $config["per_page"], $page);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('blog/blog', $v_data, true);
		
		
	
		$data['title'] = 'All posts';
		
		$this->load->view('templates/general_page', $data);

	}
	public function property_detail($property_id)
	{
		$query = $this->site_model->get_property_details($property_id);
		$v_data['property_brochure_location'] = $this->property_brochure_location;
		$v_data['property_sale_contract_location'] = $this->property_sale_contract_location;
		$v_data['property'] = $query;
		$v_data['gallery_images'] = $this->site_model->get_gallery_images($property_id);
		$data['content'] = $this->load->view('property/single_property', $v_data, true);
		$data['title'] = 'All posts';
		
		$this->load->view('templates/general_page', $data);
	}
	public function brochure($property_id)
	{
		$query = $this->site_model->get_property_details($property_id);
		$v_data['property_brochure_location'] = $this->property_brochure_location;
		$v_data['property_sale_contract_location'] = $this->property_sale_contract_location;
		$v_data['property'] = $query;
		$v_data['brochure'] = 1;
		$v_data['gallery_images'] = $this->site_model->get_gallery_images($property_id);
		$data['content'] = $this->load->view('property/brochure', $v_data, true);
		$data['title'] = 'Print brochure';
		
		$this->load->view('templates/brochure', $data);
	}
	public function blog_detail($post_id)
	{
		

		$this->blog_model->update_views_count($post_id);
		$query = $this->blog_model->get_post($post_id);
		$v_data['comments_query'] = $this->blog_model->get_post_comments($post_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['row'] = $query->row();
			$data['content'] = $this->load->view('blog/single_blog', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Post not found';
		}
		$data['title'] = 'Blog Posts';
		
		
		$this->load->view('templates/general_page', $data);
	}

	public function development()
	{
		
		$data['content'] = $this->load->view('portfolio/portfolio', '', true);
		
		
		$this->load->view('templates/general_page', $data);
	}

	public function contact()
	{
		
		$data['content'] = $this->load->view('contact/contact', '', true);
		
		
		$this->load->view('templates/general_page', $data);
	}

    public function about()
	{
		
		$data['content'] = $this->load->view('about/about', '', true);
		
		
		$this->load->view('templates/general_page', $data);
	}
	/*
	*
	*	Filter products by brand
	*
	*/
	public function filter_brands()
	{
		$total_brands = sizeof($_POST['brand']);
		
		//check if any checkboxes have been ticked
		if($total_brands > 0)
		{
			$brands = '';
			
			for($r = 0; $r < $total_brands; $r++){
				
				$brand = $_POST['brand'];
				$brand_id = $brand[$r]; 
				
				if($r == 0)
				{
					$brands .= $brand_id;
				}
				
				else
				{
					$brands .= '-'.$brand_id;
				}
			}
			redirect('products/filter-brands/'.$brands);
		}
		
		else
		{
			redirect('products/all-products');
		}
	}
    
	/*
	*
	*	Products Page
	*
	*/
	public function products($search = '__', $category_id = 0, $brand_id = 0, $order_by = 'created', $new_products = 0, $new_categories = 0, $new_brands = 0, $price_range = '__', $filter_brands = '__') 
	{
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		$v_data['brands'] = $this->brands_model->all_active_brands();
		$v_data['product_sub_categories'] = $this->categories_model->get_sub_categories($category_id);
		$v_data['all_children'] = $this->categories_model->all_child_categories();
		$v_data['parent_categories'] = $this->categories_model->all_parent_categories();
		$v_data['price_range'] = $this->site_model->generate_price_range();
		
		$where = 'product.category_id = category.category_id AND product.brand_id = brand.brand_id AND product_status = 1 AND category_status = 1 AND brand_status = 1';
		$table = 'product, category, brand';
		$limit = NULL;
		
		//ordering products
		switch ($order_by)
		{
			case 'created':
				$order_method = 'DESC';
			break;
			
			case 'price':
				$order_method = 'ASC';
			break;
			
			case 'price_desc':
				$order_method = 'DESC';
			break;
		}
		
		//case of filter_brands
		if($filter_brands != '__')
		{
			$brands = explode("-", $filter_brands);
			$total = count($brands);
			
			if($total > 0)
			{
				$where .= ' AND (';
				for($r = 0; $r < $total; $r++)
				{
					if($r ==0)
					{
						$where .= 'product.brand_id = '.$brands[$r];
					}
					
					else
					{
						$where .= ' OR product.brand_id = '.$brands[$r];
					}
				}
				$where .= ')';
			}
		}
		
		//case of price_range
		if($price_range != '__')
		{
			$range = explode("-", $price_range);
			$total = count($range);
			
			if($total == 2)
			{
				$start = $range[0];
				$end = $range[1];
				$where .= " AND (product.product_selling_price BETWEEN ".$start." AND ".$end.")";
			}
		}
		
		//case of search
		if($search != '__')
		{
			$where .= " AND (product.product_name LIKE '%".$search."%' OR category.category_name LIKE '%".$search."%' OR brand.brand_name LIKE '%".$search."%')";
		}
		
		//case of category
		if($category_id > 0)
		{
			$where .= ' AND (category.category_id = '.$category_id.' OR category.category_parent = '.$category_id.')';
		}
		
		//case of brand
		if($brand_id > 0)
		{
			$where .= ' AND brand.brand_id = '.$brand_id;
		}
		
		//case of latest products
		if($new_products == 1)
		{
			$limit = 30;
		}
		
		//case of latest category
		if($new_categories == 1)
		{
			$query = $this->categories_model->latest_category();
			
			if($query->num_rows() > 0)
			{
				$category = $query->row();
				$latest_category_id = $category->category_id;
				
				$where .= ' AND category.category_id = '.$latest_category_id;
			}
		}
		
		//case of latest brand
		if($new_brands == 1)
		{
			$query = $this->brands_model->latest_brand();
			
			if($query->num_rows() > 0)
			{
				$brand = $query->row();
				$latest_brand_id = $brand->brand_id;
				
				$where .= ' AND brand.brand_id = '.$latest_brand_id;
			}
		}
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'site/products';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = 5;
		$config['per_page'] = 21;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination no-margin-top">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '»';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '«';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		if($limit == NULL)
		{
        	$v_data["links"] = $this->pagination->create_links();
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			
			if($v_data["total"] < $config["per_page"])
			{
				$v_data["last"] = $page + $v_data["total"];
			}
			
			else
			{
				$v_data["last"] = $page + $config["per_page"];
			}
		}
		
		else
		{
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			$v_data["last"] = $config['total_rows'];
		}
		$v_data['products'] = $this->products_model->get_all_products($table, $where, $config["per_page"], $page, $limit, $order_by, $order_method);
		
		$data['content'] = $this->load->view('products/products', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Search for a product
	*
	*/
	public function search()
	{
		$search = $this->input->post('search_item');
		
		if(!empty($search))
		{
			redirect('products/search/'.$search);
		}
		
		else
		{
			redirect('products/all-products');
		}
	}
    
	/*
	*
	*	Products Page
	*
	*/
	public function view_product($product_id)
	{
		$this->products_model->update_clicks($product_id);
		//Required general page data
		$v_data['all_children'] = $this->categories_model->all_child_categories();
		$v_data['parent_categories'] = $this->categories_model->all_parent_categories();
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		
		//get page data
		$v_data['all_features'] = $this->features_model->all_features();
		$v_data['similar_products'] = $this->products_model->get_similar_products($product_id);
		$v_data['product_details'] = $this->products_model->get_product($product_id);
		$v_data['product_images'] = $this->products_model->get_gallery_images($product_id);
		$v_data['product_features'] = $this->products_model->get_features($product_id);
		$data['content'] = $this->load->view('products/view_product', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	public function search_properties($source)
	{
		$location_id = $this->input->post('location_id');
		$property_type_id = $this->input->post('property_type_id');
		$bedroom_id = $this->input->post('bedroom_id');
		$bathroom_id = $this->input->post('bathroom_id');
		$max_price = $this->input->post('max_price');
		$min_price = $this->input->post('min_price');
		
		if(!empty($location_id))
		{
			$location_id = ' AND property.location_id = '.$location_id.' ';
		}
		else
		{
			$location_id ='';
		}
		
		if(!empty($bathroom_id))
		{
			$bathroom_id = ' AND property.property_bathrooms = '.$bathroom_id.' ';
		}
		else
		{
			$bathroom_id ='';
		}
		
		if(!empty($bedroom_id))
		{
			$bedroom_id = ' AND property.bedrooms = '.$bedroom_id.' ';
		}
		else
		{
			$bedroom_id ='';
		}

		if(!empty($property_type_id))
		{
			$property_type_id = ' AND property.property_type_id = '.$property_type_id.' ';
		}
		else
		{
			$property_type_id ='';
		}

		if(!empty($max_price))
		{
			$max_price = ' AND property.property_price <= '.$max_price.' ';
		}
		else
		{
			$max_price ='';
		}

		if(!empty($min_price))
		{
			$min_price = ' AND property.property_price >= '.$min_price.' ';
		}
		else
		{
			$min_price = '';
		}
		
		$search = $property_type_id.$location_id.$max_price.$min_price.$bedroom_id.$bathroom_id;
		
		if($source == 1)
		{
			$this->session->set_userdata('property_sold_search', $search);
			$this->property_onsale();
		}
		
		else
		{
			$this->session->set_userdata('property_search', $search);
			$this->property_sold();
		}
	}
	public function close_property_search()
	{
		$this->session->unset_userdata('property_search');
		$this->properties();
	}

	public function request_newsletter()
	{
		//form validation rules
		$this->form_validation->set_rules('email_address', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First name', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'valid_email|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run() == FALSE)
		{
			$this->site_model->request_newsletter();
		}
		
		else
		{
			$this->session->set_userdata("error_message","Could not send newsletter request. Please try again");	
		}
		redirect('home');
	}
	
	public function contact_us()
	{
		//form validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Phone number', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('email_address', 'Email', 'is_numeric|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run() == FALSE)
		{
			$this->site_model->send_message();
		}
		
		else
		{
			$this->session->set_userdata("error_message","Could not send newsletter request. Please try again");	
		}
		redirect('contact');
	}
	public function request_appraisal()
	{
		//form validation rules
		$this->form_validation->set_rules('app_first_name', 'First Name', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('app_last_name', 'Last Name', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Phone number', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'is_numeric|xss_clean');
		$this->form_validation->set_rules('email_address', 'Email', 'is_numeric|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run() == FALSE)
		{
			$this->site_model->send_appraisal();
		}
		
		else
		{
			$this->session->set_userdata("error_message","Could not send newsletter request. Please try again");	
		}
		redirect('contact');
	}
	
	public function blog_category($category = NULL) 
	{
		$where = 'post.blog_category_id = blog_category.blog_category_id AND post.post_status = 1';
		$where .= ' AND (blog_category.blog_category_id = '.$category.' OR blog_category.blog_category_parent = '.$category.')';
		$segment = 4;
		$table = 'post, blog_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'blog/category/'.$category;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination ">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li><a href="#">';
		$config['next_link'] = 'Newer';
		$config['next_tag_close'] = '</a></li>';
		
		$config['prev_tag_open'] = ' <li><a href="#">';
		$config['prev_link'] = 'Older';
		$config['prev_tag_close'] = '</a></li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->blog_model->get_all_posts($table, $where, $config["per_page"], $page);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('blog/blog', $v_data, true);
	
		$data['title'] = 'All posts';
		
		$this->load->view('templates/general_page', $data);

	}
	
	public function add_blog_comment($post_id)
	{
		//form validation rules
		$this->form_validation->set_rules('post_comment_description', 'Comment', 'required|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->blog_detail($post_id);
		}
		
		else
		{
			if($this->blog_model->add_comment_user($post_id))
			{
				$this->session->set_userdata('success_message', 'Comment added successfully');
				redirect('news/view-single/'.$post_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add comment. Please try again');
				$this->view_post($post_id);
			}
		}
	}
	
	//payment for invoices
	public function payment($total, $member_id)
	{
		$this->session->set_userdata('payment_attendee_id', $member_id);
		$this->load->model('member_model');
		$iframe = $this->member_model->make_pesapal_payment($total, $member_id);
		$v_data['iframe'] = $iframe;
		$data['content'] = $this->load->view('site/pesapal_payment', $v_data, true);
		$data['title'] = 'Payment For Invoice '.$invoice_number;
		$this->load->view('site/templates/account', $data);
	}
	
	public function payment_success($total,$member_id)
	{
		//mark booking as paid in the database
		$payment_data = $this->input->get();
		$transaction_tracking_id = $payment_data['pesapal_transaction_tracking_id'];
		$invoice_id = $payment_data['pesapal_merchant_reference'];
		
		if($this->member_model->create_payment($transaction_tracking_id, $invoice_id, $total, $member_id))
		{
			$this->session->set_userdata('success_message', 'Payment Made successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'No deduction made. Payment Failed');
		}
		
		redirect('account');
	}
}
?>