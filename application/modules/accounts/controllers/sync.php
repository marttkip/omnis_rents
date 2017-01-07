<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sync extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('accounts/sync_model');
	}
    
	public function sync_payments()
	{
		$this->form_validation->set_rules('mpesa_data', 'Mpesa Data', 'required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$return = $this->sync_model->receipt_auto_payment();
			
			if($return['message'])
			{
				$result['message'] = 'success';
				$result['result'] = 'Sync successfull';
			}
			
			else
			{
				$result['message'] = 'success';
				$result['result'] = $return['result'];
			}
		}
		
		else
		{
			$result['message'] = 'error';
			$result['result'] = validation_errors();
		}
		
		echo json_encode($result);
	}
}
?>