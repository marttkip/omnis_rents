<?php

class Accounts_model extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	
	/*
	*	Retrieve all tenants
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_tenants($table, $where, $per_page, $page, $order = 'tenant_name', $order_method = 'ASC')
	{
		//retrieve all tenants
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		// $this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	public function get_months_other_amount($lease_id,$month,$this_year)
	{

		$this->db->from('payments');
		$this->db->select('SUM(amount_paid) AS total_paid');
		$this->db->where('lease_id = '.$lease_id.' AND payment_status = 1 AND month = "'.$month.'" AND year ="'.$this_year.'"');
		$query = $this->db->get();
		$total_paid = 0;
		foreach ($query->result() as $key) {
			# code...
			$total_paid = $key->total_paid;
		}
		return $total_paid;
	}

	public function get_months_amount($lease_id)
	{

		$this->db->from('payments');
		$this->db->select('SUM(amount_paid) AS total_paid');
		$this->db->where('lease_id = '.$lease_id.' AND payment_status = 1');

		$query = $this->db->get();
		$total_paid = 0;

		foreach ($query->result() as $key) {
			# code...
			$total_paid = $key->total_paid;
		}
		return $total_paid;
	}

	public function get_this_months_payment($lease_id,$month)
	{

		$this->db->from('payments');
		$this->db->select('*');
		$this->db->where('lease_id = '.$lease_id.' AND payment_status = 1 AND month = "'.$month.'"');
		$query = $this->db->get();
		return $query;

	}
	
	public function get_months_last_amount($lease_id,$rent_amount,$arrears_bf,$lease_start_date)
	{
		$this->db->from('payments');
		// $this->db->select('balance_cf AS balance');
		$this->db->select('SUM(amount_paid) AS total_paid');
		$this->db->where('lease_id = '.$lease_id.' AND payment_status = 1');
		$this->db->order_by('lease_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$total_paid = 0;

		foreach ($query->result() as $key) {
			# code...
			$total_paid = $key->total_paid;
		}
		if($total_paid == NULL)
		{
			$total_paid = 0;
		}
		// var_dump($lease_id);die();

		$date1 = $lease_start_date;

		$date2 = date('Y-m-d');

		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$year1 = date('Y',$ts1);
		$year2 = date('Y',$ts2);

		$month1 = date('m',$ts1);
		$month2 = date('m',$ts2);
		$total_months_comb = $month2 - $month2;
		$total_months = ($year2-$year1) * 12 + $total_months_comb;

		
		if($total_months == 0)
		{
			$total_months = 1;
		}
		$total_months = $total_months+1;
		// var_dump($total_months);

		if($total_months > 1)
		{
			$balance = $rent_amount - $total_paid;	
		}
		else
		{
			$balance = $arrears_bf - $total_paid;
		}
		return $balance;
	}
	
	public function get_cancel_actions()
	{
		$this->db->where('cancel_action_status', 1);
		$this->db->order_by('cancel_action_name');
		
		return $this->db->get('cancel_action');
	}
	
	public function get_lease_payments($lease_id)
	{
		$this->db->where('leases.lease_id = payments.lease_id AND payments.lease_id = '.$lease_id.' AND leases.lease_status = 1 AND payments.year ='.date('Y'));
		
		return $this->db->get('payments, leases');
	}
	
	public function get_lease_payments2($lease_id, $year = NULL, $month = NULL)
	{
		if($year != NULL)
		{
			$this->db->where('leases.lease_id = payments.lease_id AND payments.lease_id = '.$lease_id.' AND payments.year ='.$year.' AND payments.month ='.$month);
		}
		
		else
		{
			$this->db->where('leases.lease_id = payments.lease_id AND payments.lease_id = '.$lease_id);
		}
		
		return $this->db->get('payments,leases');
	}
	public function create_receipt_number()
	{
		//select product code
		$preffix = "SSL-REC-";
		$this->db->from('payments');
		$this->db->where("receipt_number LIKE '".$preffix."%'");
		$this->db->select('MAX(receipt_number) AS number');
		$query = $this->db->get();//echo $query->num_rows();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$real_number = str_replace($preffix, "", $number);
			$real_number++;//go to the next number
			$number = $preffix.sprintf('%03d', $real_number);
		}
		else{//start generating receipt numbers
			$number = $preffix.sprintf('%03d', 1);
		}
		
		return $number;
	}
	public function receipt_payment($lease_id,$personnel_id = NULL){
		$amount = $this->input->post('amount_paid');
		$payment_method=$this->input->post('payment_method');
		
		if($payment_method == 1)
		{
			$transaction_code = $this->input->post('bank_name');
		}
		else if($payment_method == 5)
		{
			//  check for mpesa code if inserted
			$transaction_code = $this->input->post('mpesa_code');
		}
		else
		{
			$transaction_code = '';
		}

		// calculate the points to get 
		$payment_date = $this->input->post('payment_date');


		$this->get_points_to_award($lease_id,$payment_date);
		// end of point calculation
		$date_check = explode('-', $payment_date);
		$month = $date_check[1];
		$year = $date_check[0];
		$data = array(
			'lease_id' => $lease_id,
			'payment_method_id'=>$payment_method,
			'amount_paid'=>$amount,
			'personnel_id'=>$this->session->userdata("personnel_id"),
			'transaction_code'=>$transaction_code,
			'payment_date'=>$this->input->post('payment_date'),
			'receipt_number'=>$this->create_receipt_number(),
			'paid_by'=>$this->input->post('paid_by'),
			'payment_created'=>date("Y-m-d"),
			'year'=>$year,
			'month'=>$month,
			'payment_created_by'=>$this->session->userdata("personnel_id"),
			'approved_by'=>$personnel_id,'date_approved'=>date('Y-m-d')
		);
		if($this->db->insert('payments', $data))
		{
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}
	function get_points_to_award($lease_id,$payment_date)
	{
		$points_date = explode('-', $payment_date);
		$checked_date = $payment_date[2];
		$checked_month = $payment_date[1];

	
		// check for payments on the lease on that month 
		$this->db->from('leases');
		$this->db->select('tenant_unit_id');
		$this->db->where('lease_status = 1 AND lease_id ='.$lease_id);
		$leases_query = $this->db->get();
		
		if($leases_query->num_rows() > 0)
		{

			foreach ($leases_query->result() as $value) {
				# code...
				$tenant_unit_id = $value->tenant_unit_id;

				// get the tenant_unit value

				$this->db->from('tenant_unit');
				$this->db->select('points');
				$tenant_unit_query = $this->db->get();

				if($tenant_unit_query->num_rows() > 0)
				{
					foreach ($tenant_unit_query->result() as $items) {
						# code...
						$old_points = $items->points;
					}
					// update 
				}
				else
				{
					$old_points = 0;
				}
			}
		}
		else
		{
			$old_points = 0;
		}
		$where = 'points_category_status = 1 AND (points_category_date_from >= '.$checked_date.' AND  points_category_date_to <= '.$checked_date.')';
		$this->db->from('points_category');
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get();
		// var_dump($query->num_rows()); die();
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$allocate_points = $key->points;
			}
			

		}
		else
		{
			$allocate_points  = 0;
		}
		$points = $old_points + $allocate_points;
		$data = array(
					'points' => $points,
				);
		$this->db->where('tenant_unit_id', $tenant_unit_id);
		$this->db->update('tenant_unit', $data);
		

		

		return TRUE;
		
	}
	function get_payment_methods()
	{
		
		return $this->db->get('payment_method');
	}
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_active_tenants()
	{
		$this->db->from('personnel');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end tenants
	*
	*/
	public function get_all_front_end_tenants()
	{
		$this->db->from('tenants');
		$this->db->select('*');
		$this->db->where('tenant_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	

	public function get_all_countries()
	{
		//retrieve all tenants
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new tenant to the database
	*
	*/
	public function add_tenant()
	{
		$data = array(
				'tenant_name'=>ucwords(strtolower($this->input->post('tenant_name'))),
				'tenant_email'=>$this->input->post('tenant_email'),
				'tenant_number'=>$this->create_tenant_number(),
				'tenant_national_id'=>$this->input->post('tenant_national_id'),
				'tenant_phone_number'=>$this->input->post('tenant_phone_number'),
				'created'=>date('Y-m-d H:i:s'),
				'tenant_status'=>1,
				'created_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function add_tenant_to_unit($rental_unit_id)
	{
		$this->db->where('tenant_unit_status = 1 AND rental_unit_id = '.$rental_unit_id.'');
		$this->db->from('tenant_unit');
		$this->db->select('*');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$tenant_unit_id = $key->tenant_unit_id;
				$tenant_unit_status = $key->tenant_unit_status;
					// update the details the status to 1 
				$update_array = array('tenant_unit_status'=>0);
				$this->db->where('tenant_unit_id = '.$tenant_unit_id);
				$this->db->update('tenant_unit',$update_array);
			}
			$insert_array = array(
							'tenant_id'=>$this->input->post('tenant_id'),
							'rental_unit_id'=>$rental_unit_id,
							'created'=>date('Y-m-d'),
							'created_by'=>$this->session->userdata('personnel_id'),
							'tenant_unit_status'=>1,
							);
			$this->db->insert('tenant_unit',$insert_array);
			return TRUE;
		}
		else
		{
			// create the tenant unit number
			$insert_array = array(
							'tenant_id'=>$this->input->post('tenant_id'),
							'rental_unit_id'=>$rental_unit_id,
							'created'=>date('Y-m-d'),
							'created_by'=>$this->session->userdata('personnel_id'),
							'tenant_unit_status'=>1,
							);
			$this->db->insert('tenant_unit',$insert_array);
			$tenant_unit_id = $this->db->insert_id();

			return TRUE;
		}
	}
	public function create_tenant_number()
	{
		//select product code
		$this->db->where('branch_code = "'.$this->session->userdata('branch_code').'"');
		$this->db->from('tenants');
		$this->db->select('MAX(tenant_number) AS number');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number
			if($number == 1){
				$number = "".$this->session->userdata('branch_code')."-000001";
			}
			
			if($number == 1)
			{
				$number = "".$this->session->userdata('branch_code')."-000001";
			}
			
		}
		else{//start generating receipt numbers
			$number = "".$this->session->userdata('branch_code')."-000001";
		}
		return $number;
	}
	
	/*
	*	Add a new front end tenant to the database
	*
	*/
	public function add_frontend_tenant()
	{
		$data = array(
				'tenant_name'=>ucwords(strtolower($this->input->post('tenant_name'))),
				'tenant_email'=>$this->input->post('tenant_email'),
				'tenant_national_id'=>$this->input->post('tenant_national_id'),
				'tenant_password'=>md5(123456),
				'tenant_phone_number'=>$this->input->post('tenant_phone_number'),
				'created'=>date('Y-m-d H:i:s'),
				'tenant_status'=>1,
				'created_by'=>$this->session->userdata('personnel_id'),
			);
			
		if($this->db->insert('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing tenant
	*	@param int $tenant_id
	*
	*/
	public function edit_tenant($tenant_id)
	{
		$data = array(
				'tenant_name'=>ucwords(strtolower($this->input->post('tenant_name'))),
				'tenant_email'=>$this->input->post('tenant_email'),
				'tenant_national_id'=>$this->input->post('tenant_national_id'),
				'tenant_phone_number'=>$this->input->post('tenant_phone_number'),
				'tenant_status'=>1,
				'modified_by'=>$this->session->userdata('personnel_id'),
			);
		
		//check if tenant wants to update their password
		$pwd_update = $this->input->post('admin_tenant');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('tenant_id', $tenant_id);
		
		if($this->db->update('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing tenant
	*	@param int $tenant_id
	*
	*/
	public function edit_frontend_tenant($tenant_id)
	{
		$data = array(
				'tenant_name'=>ucwords(strtolower($this->input->post('tenant_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if tenant wants to update their password
		$pwd_update = $this->input->post('admin_tenant');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('tenant_id', $tenant_id);
		
		if($this->db->update('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing tenant's password
	*	@param int $tenant_id
	*
	*/
	public function edit_password($tenant_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('tenant_id', $tenant_id);
				
				if($this->db->update('tenants', $data))
				{
					$return['result'] = TRUE;
				}
				else{
					$return['result'] = FALSE;
					$return['message'] = 'Oops something went wrong and your password could not be updated. Please try again';
				}
			}
			else{
					$return['result'] = FALSE;
					$return['message'] = 'New Password and Confirm Password don\'t match';
			}
		}
		
		else
		{
			$return['result'] = FALSE;
			$return['message'] = 'You current password is not correct. Please try again';
		}
		
		return $return;
	}
	
	/*
	*	Retrieve a single tenant
	*	@param int $tenant_id
	*
	*/
	public function get_tenant($tenant_id)
	{
		//retrieve all tenants
		$this->db->from('tenants');
		$this->db->select('*');
		$this->db->where('tenant_id = '.$tenant_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single tenant by their email
	*	@param int $email
	*
	*/
	public function get_tenant_by_email($email)
	{
		//retrieve all tenants
		$this->db->from('tenants');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}

	
	
	/*
	*	Delete an existing tenant
	*	@param int $tenant_id
	*
	*/
	public function delete_tenant($tenant_id)
	{
		if($this->db->delete('tenants', array('tenant_id' => $tenant_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated tenant
	*	@param int $tenant_id
	*
	*/
	public function activate_tenant($tenant_id)
	{
		$data = array(
				'activated' => 1
			);
		$this->db->where('tenant_id', $tenant_id);
		
		if($this->db->update('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated tenant
	*	@param int $tenant_id
	*
	*/
	public function deactivate_tenant($tenant_id)
	{
		$data = array(
				'activated' => 0
			);
		$this->db->where('tenant_id', $tenant_id);
		
		if($this->db->update('tenants', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a tenant's password
	*	@param string $email
	*
	*/
	public function reset_password($email)
	{
		//reset password
		$result = md5(date("Y-m-d H:i:s"));
		$pwd2 = substr($result, 0, 6);
		$pwd = md5($pwd2);
		
		$data = array(
				'password' => $pwd
			);
		$this->db->where('email', $email);
		
		if($this->db->update('tenants', $data))
		{
			//email the password to the tenant
			$tenant_details = $this->tenants_model->get_tenant_by_email($email);
			
			$tenant = $tenant_details->row();
			$tenant_name = $tenant->tenant_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$tenant_name.'. Your new password is '.$pwd;
			
			//send the tenant their new password
			if($this->email_model->send_mail($receiver, $sender, $message))
			{
				return TRUE;
			}
			
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", strtolower($field_name));
		
		return $web_name;
	}
	public function change_password()
	{
		
		$data = array(
				'personnel_password' => md5($this->input->post('new_password'))
			);
		$this->db->where('personnel_password = "'.md5($this->input->post('current_password')).'" AND personnel_id ='.$this->session->userdata('personnel_id'));
		
		if($this->db->update('personnel', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_tenancy_details($tenant_id,$rental_unit_id)
	{
		$this->db->from('tenant_unit');
		$this->db->select('*');
		$this->db->where('tenant_id = '.$tenant_id.' AND rental_unit_id ='.$rental_unit_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function check_for_account($rental_unit_id)
	{

		$this->db->from('tenant_unit');
		$this->db->select('*');
		$this->db->where('tenant_unit_status = 1 AND rental_unit_id ='.$rental_unit_id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_tenant_list($table, $where, $order)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order,'asc');
		$query = $this->db->get('');
		
		return $query;
	}

	public function update_invoices()
	{
		$this->db->from('leases');
		$this->db->select('*');
		$this->db->where('lease_status = 1');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			// get the lease information 

			foreach ($query->result() as $key) {
				# code...
				$lease_id = $key->lease_id;
				$lease_start_date = $key->lease_start_date;
				$rent_amount = $key->rent_amount;
				$inital_rent_amount = $key->rent_amount;
				$arreas_bf = $key->arreas_bf;
				
				// get the year and the month
				$date = explode('-', $lease_start_date);
				$month = $date[1];
				$year = $date[0];
				$x=0;
				$todays_month = date('m');
				for ($m=$month; $m<=$todays_month; $m++) {
					// echo $m; die();
					// check on the invoice table if the month exist for this 
					if($m == 1 OR $m == 2 OR $m == 3 OR $m == 4 OR $m == 5 OR $m == 6 OR $m == 7 OR $m == 8 OR $m == 9)
					{
						$todaym = '0'.$m;
					}
					$todaym = str_replace('00', '0', $todaym);
					$this->db->from('invoice');
					$this->db->select('*');
					$this->db->where('invoice_month = "'.$todaym.'" and invoice_year = '.$year.' AND lease_id = '.$lease_id);
					$invoice_query = $this->db->get();

					if($invoice_query->num_rows() == 0)
					{
						// previous invoice 



						if($m == 1)
						{
							$prev_month_debt = 1;

						}
						else
						{
							$prev_month_debt = $m-1;
						}
						if($prev_month_debt == 1 OR $prev_month_debt == 2 OR $prev_month_debt == 3 OR $prev_month_debt == 4 OR $prev_month_debt == 5 OR $prev_month_debt == 6 OR $prev_month_debt == 7 OR $prev_month_debt == 8 OR $prev_month_debt == 9)
						{
							$prev_month_debt = '0'.$prev_month_debt;
						}
						
						$payment_amount = $this->accounts_model->get_months_last_debt($lease_id,$prev_month_debt);
				     	// var_dump($payment_amount); die();
				     	if($m == 1)
				     	{
				     	 $prev_arrears = $arreas_bf; 
				     	}
				     	else
				     	{
				     		$this->db->from('invoice');
							$this->db->select('*');
							$this->db->where('invoice_month = "'.$prev_month_debt.'" and invoice_year = '.$year.' AND lease_id = '.$lease_id);
							$invoice_query2 = $this->db->get();
							$previous_invoice = 0;
							if($invoice_query2->num_rows() > 0)
							{
								foreach ($invoice_query2->result() as $prev_key) {
									# code...
									$previous_invoice = $prev_key->invoice_amount;
								}
							}
				     		$prev_arrears =  $previous_invoice - $payment_amount; 
				     	}

				     	$invoice_amount = $rent_amount + $prev_arrears;
						// do an insert
						
						if($m== 1 OR $m == 2 OR $m == 3 OR $m == 4 OR $m == 5 OR $m == 6 OR $m == 7 OR $m == 8 OR $m == 9)
						{
							$todaym2 = '0'.$m;
						}

						$todaym2 = str_replace('00', '0', $todaym2);
						$insert_array = array(
												'lease_id' => $lease_id,
												'invoice_date' => date('Y-m-d'),
												'invoice_month' => $todaym2,
												'invoice_year' => $year,
												'invoice_amount' => $invoice_amount,
												'arrears_bf' => $prev_arrears
										 	 );
						$this->db->insert('invoice',$insert_array);

					}
					// $rent_amount =$rent_amount++;
				}
				

			}
		}
		else
		{

		}
	}
	public function get_current_arrears($lease_id)
	{
		$current_date = date('Y-m-d');
		$date = explode('-', $current_date);
		$month = $date[1];
		$year = $date[0];

		if($month == 1 OR $month == 2 OR $month == 3 OR $month == 4 OR $month == 5 OR $month == 6 OR $month == 7 OR $month == 8 OR $month == 9)
		{
			$todaymonth = $month;
		}
		// var_dump($todaymonth); die();

		$this->db->from('invoice');
		$this->db->select('*');
		$this->db->where('invoice_month = "'.$todaymonth.'" and invoice_year = '.$year.' AND lease_id = '.$lease_id);
		$invoice_query2 = $this->db->get();
		$arrears_bf = 0;
		if($invoice_query2->num_rows() > 0)
		{
			foreach ($invoice_query2->result() as $prev_key) {
				# code...
				$arrears_bf = $prev_key->arrears_bf;
			}
		}
		return $arrears_bf;
	}

	public function get_months_last_arrears($month,$year,$lease_id)
	{
		$where = 'invoice_month = "'.$month.'" and invoice_year = '.$year.' AND lease_id = '.$lease_id.'';
		// var_dump($where); die();
		$this->db->from('invoice');
		$this->db->select('*');
		$this->db->where($where);
		$invoice_query2 = $this->db->get();
		$arrears_bf = 0;
		if($invoice_query2->num_rows() > 0)
		{
			foreach ($invoice_query2->result() as $prev_key) {
				# code...
				$arrears_bf = $prev_key->arrears_bf;
			}
		}
		return $arrears_bf;
	}
	public function get_current_balance($lease_id)
	{
		$current_date = date('Y-m-d');
		$date = explode('-', $current_date);
		$month = $date[1];
		$year = $date[0];

		if($month == 1 OR $month == 2 OR $month == 3 OR $month == 4 OR $month == 5 OR $month == 6 OR $month == 7 OR $month == 8 OR $month == 9)
		{
			$todaymonth = $month;
		}

		$this->db->from('invoice');
		$this->db->select('*');
		$this->db->where('invoice_month = "'.$todaymonth.'" and invoice_year = '.$year.' AND lease_id = '.$lease_id);
		$invoice_query2 = $this->db->get();
		$invoice_amount = 0;
		if($invoice_query2->num_rows() > 0)
		{
			foreach ($invoice_query2->result() as $prev_key) {
				# code...
				$invoice_amount = $prev_key->invoice_amount;
			}
		}

		//  check for payments also
		$this->db->from('payments');
		$this->db->select('*');
		$this->db->where('month = "'.$todaymonth.'" and year = '.$year.' AND lease_id = '.$lease_id);
		$payment_query2 = $this->db->get();
		$amount_paid = 0;
		if($payment_query2->num_rows() > 0)
		{
			foreach ($payment_query2->result() as $prev_key) {
				# code...
				$amount_paid = $prev_key->amount_paid;
			}
		}

		return $invoice_amount - $amount_paid;
	}
	public function get_months_last_debt($lease_id,$month)
	{
		$where = 'lease_id = '.$lease_id.' AND payment_status = 1 AND month = "'.$month.'"';
		// var_dump($where);die();
		$this->db->from('payments');
		// $this->db->select('balance_cf AS balance');
		$this->db->select('SUM(amount_paid) AS total_paid');
		$this->db->where($where);
		$this->db->order_by('lease_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$total_paid = 0;

		foreach ($query->result() as $key) {
			# code...
			$total_paid = $key->total_paid;
		}
		if($total_paid == NULL)
		{
			$total_paid = 0;
		}
		
		return $total_paid;
	}
	
	public function get_payment_details($payment_id)
	{
		$this->db->where('leases.lease_id = payments.lease_id AND payments.payment_id = '.$payment_id);
		
		return $this->db->get('payments, leases');
	}
	
	public function get_personnel($personnel_id)
	{
		if(empty($personnel_id))
		{
			//redirect('login');
			$personnel = '-';
		}
		
		else
		{
			$this->db->select('personnel.personnel_fname, personnel.personnel_onames');
			$this->db->from('personnel');
			$this->db->where('personnel.personnel_id = '.$personnel_id);
			
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$personnel = $row->personnel_onames.' '.$row->personnel_fname;
			}
			
			else
			{
				$personnel = '-';
			}
			
			return $personnel;
		}
	}
	
	public function receipt_auto_payment()
	{
		$mpesa_data = $this->input->post('mpesa_data');
		$payment_data = explode(' ', $mpesa_data);
		$transaction_code = $payment_data[0];
		$date = explode('/', $payment_data[3]);
		$transaction_date = $date[2].'-'.$date[1].'-'.$date[0];
		$transaction_time = $payment_data[5].' '.$payment_data[6];
		$cost = $payment_data[7];
		$paid_by = $payment_data[10].' '.$payment_data[11].' '.$payment_data[12];
		$account_no = $payment_data[16];
		$payment_method = 5;
		$cost_array = explode('Ksh', $cost);
		$rent_amount = str_replace(',', '', $cost_array[1]);
		$amount = intval($rent_amount);
		
		$lease_id = $this->get_lease_id($account_no);
		
		//var_dump($payment_data); die();
		//lease found
		if($lease_id > 0)
		{
			//check if payment exists
			$exists = $this->check_payment_exists($transaction_code);
			
			if(!$exists)
			{
				// end of point calculation
				$date_check = explode('-', $transaction_date);
				$month = $date_check[1];
				$year = $date_check[0];
				$data = array(
					'lease_id' => $lease_id,
					'payment_method_id'=>$payment_method,
					'amount_paid'=>$amount,
					'personnel_id'=>0,
					'transaction_code'=>$transaction_code,
					'payment_date'=>$transaction_date,
					'receipt_number'=>$this->create_receipt_number(),
					'paid_by'=>$paid_by,
					'payment_created'=>date("Y-m-d"),
					'year'=>$year,
					'month'=>$month,
					'payment_created_by'=>0,
					'approved_by'=>0,
					'date_approved'=>date('Y-m-d')
				);
				//var_dump($data); die();
				if($this->db->insert('payments', $data))
				{
					$return['message'] = TRUE;
				}
				else
				{
					$return['message'] = FALSE;
					$return['result'] = 'Unable to save payment';
				}
			}
			
			else
			{
				$return['message'] = FALSE;
				$return['result'] = 'Paymnt already saved';
			}
		}
		
		//lease not found
		else
		{
			$date_check = explode('-', $transaction_date);
			$month = $date_check[1];
			$year = $date_check[0];
			$data = array(
				'payment_method_id'=>$payment_method,
				'amount_paid'=>$amount,
				'personnel_id'=>0,
				'transaction_code'=>$transaction_code,
				'payment_date'=>$transaction_date,
				'receipt_number'=>$this->create_receipt_number(),
				'paid_by'=>$paid_by,
				'payment_created'=>date("Y-m-d"),
				'year'=>$year,
				'month'=>$month,
				'payment_created_by'=>0,
				'approved_by'=>0,
				'date_approved'=>date('Y-m-d')
			);
			if($this->db->insert('unclaimed_payments', $data))
			{
				$return['message'] = FALSE;
				$return['result'] = 'Tenant not found';
			}
			else{
				$return['message'] = FALSE;
				$return['result'] = 'Unable to save payment';
			}
		}
		
		return $return;
	}
	
	public function get_lease_id($account_no)
	{
		$this->db->select('lease_id');
		$this->db->where('leases.lease_status = 1 AND leases.rental_unit_id = rental_unit.rental_unit_id AND rental_unit.rental_unit_name = \''.$account_no.'\'');
		$query = $this->db->get('leases, rental_unit');
		
		$lease_id = 0;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$lease_id = $row->lease_id;
		}
		
		return $lease_id;
	}
	
	public function check_payment_exists($transaction_code)
	{
		$this->db->select('payment_id');
		$this->db->where('transaction_code = \''.$transaction_code.'\'');
		$query = $this->db->get('payments');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
}
?>