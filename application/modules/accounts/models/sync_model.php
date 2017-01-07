<?php

class Sync_model extends CI_Model 
{
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
	
	public function receipt_auto_payment()
	{
		$mpesa_data = $this->input->post('mpesa_data');
		$payment_data = explode(' ', $mpesa_data);//count($payment_data);die();
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
		$transaction_date = date('Y-m-d', strtotime($transaction_date));
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