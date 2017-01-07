<?php
class Messaging extends MX_Controller 
{
	var $csv_path;
	function __construct()
	{
		parent:: __construct();
		$this->load->model('messaging_model');
		$this->load->model('site/site_model');
		$this->load->model('admin/sections_model');
		$this->load->model('admin/admin_model');
		$this->load->model('admin/users_model');
		$this->load->model('administration/personnel_model');
		$this->load->model('accounts/accounts_model');

		$this->csv_path = realpath(APPPATH . '../assets/csv');
	}
	
	public function index()
	{
		if(!$this->auth_model->check_login())
		{
			redirect('login');
		}
		
		else
		{
			redirect('message/dashboard');
		}
	}

	public function unsent_messages()
	{

		$where = 'messaging.message_category_id = message_category.message_category_id AND messaging.sent_status = 0 AND messaging.branch_code = "'. $this->session->userdata('branch_code').'"';
		$table = 'messaging, message_category';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'messaging/unsent-messages';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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
        $v_data["links"] = $this->pagination->create_links();

		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['page'] = $page;
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/unsent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function sent_messages()
	{

		$where = 'messaging.message_category_id = message_category.message_category_id AND messaging.sent_status = 1 AND messaging.branch_code = "'. $this->session->userdata('branch_code').'"';
		$table = 'messaging, message_category';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'messaging/unsent-messages';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
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
        $v_data["links"] = $this->pagination->create_links();

		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['page'] = $page;
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/sent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
	public function import_template()
	{
		$this->messaging_model->import_template();
	}
	function do_messages_import($message_category_id)
	{

		if(isset($_FILES['import_csv']))
		{
			// var_dump($message_category_id); die();
			if(is_uploaded_file($_FILES['import_csv']['tmp_name']))
			{
				//import products from excel 

				$response = $this->messaging_model->import_csv_charges($this->csv_path, $message_category_id);
				
				
				if($response == FALSE)
				{

				}
				
				else
				{
					if($response['check'])
					{
						$v_data['import_response'] = $response['response'];
					}
					
					else
					{
						$v_data['import_response_error'] = $response['response'];
					}
				}
			}
			
			else
			{
				$v_data['import_response_error'] = 'Please select a file to import.';
			}
		}
		
		else
		{
			$v_data['import_response_error'] = 'Please select a file to import.';
		}
		redirect('messaging/unsent-messages');
	}
	public function spoilt_messages()
	{

		$where = 'messaging.message_category_id = message_category.message_category_id AND messaging.sent_status = 2 AND messaging.branch_code = "'. $this->session->userdata('branch_code').'"';
		$table = 'messaging, message_category';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-posts';
		$config['total_rows'] = $this->messaging_model->count_items($table, $where);
		$config['uri_segment'] = 2;
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
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->messaging_model->get_all_messages($table, $where, $config["per_page"], $page);
		$data['title'] = $this->site_model->display_page_title();
		$v_data['title'] = $data['title'];
		$v_data['query'] = $query;
		$data['content'] = $this->load->view('sms/sent_messages', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function send_messages()
	{
		$this->messaging_model->send_unsent_messages();

		redirect('messaging/unsent-messages');
	}

	public function send_monthly_rent_reminder()
	{
		$this->load->model('real_estate_administration/leases_model');
		$all_leases = $this->leases_model->get_active_lease_detail();
		
		if($all_leases->num_rows() > 0)
		{
			echo '<table border="1">
			<tr>
				<th>#</th>
				<th>House</th>
				<th>Tenant</th>
				<th>Phone</th>
				<th>Amount</th>
				<th>Response</th>
			</tr>';
			$count = 0;
			foreach ($all_leases->result() as $leases_row)
			{
				$lease_id = $leases_row->lease_id;
				$tenant_unit_id = $leases_row->tenant_unit_id;
				$property_name = $leases_row->property_name;
				$rental_unit_name = $leases_row->rental_unit_name;
				$tenant_name = $leases_row->tenant_name;
				$lease_start_date = $leases_row->lease_start_date;
				$lease_duration = $leases_row->lease_duration;
				$rent_amount = $leases_row->rent_amount;
				$lease_number = $leases_row->lease_number;
				$arreas_bf = $leases_row->arreas_bf;
				$rent_calculation = $leases_row->rent_calculation;
				$deposit = $leases_row->deposit;
				$deposit_ext = $leases_row->deposit_ext;
				$tenant_phone_number = $leases_row->tenant_phone_number;
				$tenant_national_id = $leases_row->tenant_national_id;
				$lease_status = $leases_row->lease_status;
				$created = $leases_row->created;
				$units_name = $leases_row->units_name;
		
				$lease_start_date = date('jS M Y',strtotime($lease_start_date));
				
				// $expiry_date  = date('jS M Y',strtotime($lease_start_date, mktime()) . " + 365 day");
				$expiry_date  = date('jS M Y', strtotime(''.$lease_start_date.'+1 years'));
				$outstanding = '';
				//$total_due = $rent_amount*12;
				if($arreas_bf < 0)
				{
					$arreas_bf = 0;
				}
				else
				{
					$outstanding = '. Please note you have an outstanding amount of Ksh. '.number_format($arreas_bf).'. Kindly settle the balance promptly. For more information contact Serenity Services on 0704346052';
				}
				$total_due = $rent_amount + $arreas_bf;
				$count++;
				
				$message = 'Hello '.$tenant_name.'. Your rent due for July 2016 is Ksh. '.number_format($rent_amount).$outstanding;
				$results = $this->messaging_model->sms($tenant_phone_number, $message);
				
				echo 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$rental_unit_name.' '.$units_name.'</td>
						<td>'.$tenant_name.'</td>
						<td>'.$tenant_phone_number.'</td>
						<td>'.$total_due.'</td>
						<td>'.$results.'</td>
					</tr>
				';
				
			}
			echo '</table>';
		}
	}

	public function view_balances()
	{
		$this->load->model('real_estate_administration/leases_model');
		$all_leases = $this->leases_model->get_active_lease_detail();
		
		if($all_leases->num_rows() > 0)
		{
			echo '<table border="1">
			<tr>
				<th>#</th>
				<th>House</th>
				<th>Tenant</th>
				<th>Phone</th>
				<th>Rent</th>
				<th>Arrears</th>
				<th>Total Payments</th>
				<th>Paid</th>
				<th>Balance</th>
			</tr>';
			$count = 0;
			foreach ($all_leases->result() as $leases_row)
			{
				$lease_id = $leases_row->lease_id;
				$tenant_unit_id = $leases_row->tenant_unit_id;
				$property_name = $leases_row->property_name;
				$rental_unit_name = $leases_row->rental_unit_name;
				$tenant_name = $leases_row->tenant_name;
				$lease_start_date = $leases_row->lease_start_date;
				$lease_duration = $leases_row->lease_duration;
				$rent_amount = $leases_row->rent_amount;
				$lease_number = $leases_row->lease_number;
				$arreas_bf = $leases_row->arreas_bf;
				$rent_calculation = $leases_row->rent_calculation;
				$deposit = $leases_row->deposit;
				$deposit_ext = $leases_row->deposit_ext;
				$tenant_phone_number = $leases_row->tenant_phone_number;
				$tenant_national_id = $leases_row->tenant_national_id;
				$lease_status = $leases_row->lease_status;
				$created = $leases_row->created;
				$units_name = $leases_row->units_name;
				$payments = $this->accounts_model->get_lease_payments2($lease_id);
				$total_payments = 0;
				
				if($payments->num_rows() > 0)
				{
					foreach($payments->result() as $res)
					{
						$amount_paid = $res->amount_paid;
						$total_payments += $amount_paid;
					}
				}
		
				$lease_start_date = date('jS M Y',strtotime($lease_start_date));
				
				// $expiry_date  = date('jS M Y',strtotime($lease_start_date, mktime()) . " + 365 day");
				$expiry_date  = date('jS M Y', strtotime(''.$lease_start_date.'+1 years'));
				$outstanding = '';
				//$total_due = $rent_amount*12;
				if($arreas_bf < 0)
				{
					$arreas_bf = 0;
				}
				else
				{
					$outstanding = '. Please note you have an outstanding amount of Ksh. '.number_format($arreas_bf).'. Kindly settle the balance promptly. For more information contact Serenity Services on 0704346052';
				}
				$total_due = $rent_amount + $arreas_bf;
				$count++;
				
				$message = 'Hello '.$tenant_name.'. Your rent due for July 2016 is Ksh. '.number_format($rent_amount).$outstanding;
				//$results = $this->messaging_model->sms($tenant_phone_number, $message);
				
				echo 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$units_name.' '.$lease_id.'</td>
						<td>'.$tenant_name.'</td>
						<td>'.$tenant_phone_number.'</td>
						<td>'.number_format($rent_amount).'</td>
						<td>'.number_format($arreas_bf).'</td>
						<td>'.number_format($total_due).'</td>
						<td>'.number_format($total_payments).'</td>
						<td>'.number_format(($total_due - $total_payments)).'</td>
					</tr>
				';
				
			}
			echo '</table>';
		}
	}
}