<?php
	$all_leases = $this->leases_model->get_lease_detail($lease_id);
	foreach ($all_leases->result() as $leases_row)
	{
		$lease_id = $leases_row->lease_id;
		$tenant_unit_id = $leases_row->tenant_unit_id;
		$property_name = $leases_row->property_name;
		$units_name = $leases_row->units_name;
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
		$tenant_status = $leases_row->tenant_status;
		$created = $leases_row->created;

		$lease_start_date = date('jS M Y',strtotime($lease_start_date));
		
		// $expiry_date  = date('jS M Y',strtotime($lease_start_date, mktime()) . " + 365 day");
		$expiry_date  = date('jS M Y', strtotime(''.$lease_start_date.'+1 years'));
		
		//create deactivated status display
		if($lease_status == 0)
		{
			$status = '<span class="label label-default"> Deactivated</span>';

			$button = '';
			$delete_button = '';
		}
		//create activated status display
		else if($lease_status == 1)
		{
			$status = '<span class="label label-success">Active</span>';
			$button = '<td><a class="btn btn-default" href="'.site_url().'deactivate-rental-unit/'.$lease_id.'" onclick="return confirm(\'Do you want to deactivate '.$lease_number.'?\');" title="Deactivate '.$lease_number.'"><i class="fa fa-thumbs-down"></i></a></td>';
			$delete_button = '<td><a href="'.site_url().'deactivate-rental-unit/'.$lease_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$lease_number.'?\');" title="Delete '.$lease_number.'"><i class="fa fa-trash"></i></a></td>';

		}

		//create deactivated status display
		if($tenant_status == 0)
		{
			$status_tenant = '<span class="label label-default">Deactivated</span>';
		}
		//create activated status display
		else if($tenant_status == 1)
		{
			$status_tenant = '<span class="label label-success">Active</span>';
		}
	}

	$today = date('jS F Y H:i a',strtotime(date("Y:m:d h:i:s")));
	
	if($lease_payments->num_rows() > 0)
	{
		$y = 0;
		foreach ($lease_payments->result() as $key) 
		{
			$payment_id = $key->payment_id;
			$receipt_number = $key->receipt_number;
			$amount_paid = $key->amount_paid;
			$paid_by = $key->paid_by;
			$payment_date = $key->payment_date;
			$payment_created = $key->payment_created;
			$payment_created_by = $key->payment_created_by;
			$transaction_code = $key->transaction_code;
			
			$payment_date = date('jS M Y',strtotime($payment_date));
			$payment_created = date('jS M Y',strtotime($payment_created));
			$y++;
		}
	}
	$served_by = $this->accounts_model->get_personnel($this->session->userdata('personnel_id'));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $contacts['company_name'];?> | Receipt</title>
        <!-- For mobile content -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- IE Support -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap/css/bootstrap.css" media="all"/>
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/stylesheets/theme-custom.css" media="all"/>
        <style type="text/css">
			.receipt_spacing{letter-spacing:0px; font-size: 12px;}
			.center-align{margin:0 auto; text-align:center;}
			
			.receipt_bottom_border{border-bottom: #888888 medium solid; margin-bottom:20px;}
			.row .col-xs-12 table {
				border:solid #000 !important;
				border-width:1px 0 0 1px !important;
				font-size:10px;
			}
			.row .col-xs-12 th, .row .col-xs-12 td {
				border:solid #000 !important;
				border-width:0 1px 1px 0 !important;
			}
			.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td
			{
				 padding: 2px;
			}
			
			.row .col-xs-12 .title-item{float:left;width: 130px; font-weight:bold; text-align:right; padding-right: 20px;}
			.title-img{float:left; padding-left:30px;}
			img.logo{max-height:70px; margin:0 auto;}
			.align-right{margin:0 auto; text-align: right !important;}
		</style>
    </head>
    <body class="receipt_spacing">
    	<?php for($r = 1; $r <= 2; $r++){?>
    	<div class="receipt_bottom_border">
        	<table class="table table-condensed">
                <tr>
                    <th><h4><?php echo $contacts['company_name'];?> Receipt</h4></th>
                    <th class="align-right">
                        <img src="<?php echo base_url().'assets/logo/'.$contacts['logo'];?>" alt="<?php echo $contacts['company_name'];?>" class="img-responsive logo" style="float:right;"/>
                    </th>
                </tr>
            </table>
        </div>
    	
        
        <!-- Patient Details -->
    	<div class="row receipt_bottom_border" style="margin-bottom: 10px;">
        
            <div class="col-xs-6">
                <h2 class="panel-title">Tenant's Details</h2>
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr><td><span>Tenant Name :</span></td><td><?php echo $tenant_name;?></td></tr>
                        <tr><td><span>Tenant Phone :</span></td><td><?php echo $tenant_phone_number;?></td></tr>
                        <tr><td><span>Property Name :</span></td><td><?php echo $property_name;?></td></tr>
                        <tr><td><span>Hse No. :</span></td><td><?php echo $units_name;?></td></tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="col-xs-6">
            	<h2 class="panel-title">Receipt Details</h2>
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr><td><span>Receipt Number :</span></td><td><?php echo $receipt_number;?></td></tr>
                        <tr><td><span>Transaction Number:</span></td><td><?php echo $transaction_code;?></td></tr>
                        <tr><td><span>Payment Date :</span></td><td><?php echo $payment_date;?></td></tr>
                        <tr><td><span>Paid By:</span></td><td><?php echo $paid_by;?></td></tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        
    	<div class="row receipt_bottom_border">
        	<div class="col-xs-12 center-align">
            	<strong>BILLED ITEMS</strong>
            </div>
        </div>
        
    	<table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Rent Amount (Kes)</th>
                  <th>Arrears B/F (Kes)</th>
                  <th>Invoice Total (Kes)</th>
                  <th>Payment Total (Kes)</th>
                  <th>Balance (Kes)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $y?></td>
                    <td><?php echo number_format($rent_amount,2);?></td>
                    <td><?php echo number_format($arreas_bf,2);?></td>
                    <td><?php echo number_format(($rent_amount + $arreas_bf),2);?></td>
                    <td><?php echo number_format($amount_paid,2);?></td>
                    <td><?php echo number_format((($rent_amount + $arreas_bf) - $amount_paid),2);?></td>
                </tr>
            </tbody>
        </table>
        
    	<div class="row receipt_bottom_border" style="font-style:italic; font-size:11px;">
        	<div class="col-xs-8 pull-left">
            	<div class="col-xs-6 pull-left">
                    Prepared by: <?php echo $served_by;?> 
                </div>
                <div class="col-xs-6 pull-left">
                  Signature: .....................................
                </div>
          	</div>
        	<div class="col-xs-4 align-right">
            	<?php echo date('jS M Y H:i a'); ?> Thank you
            </div>
        </div>
        
        <table class="table table-condensed">
            <tr>
                <th class="align-right">
                    <?php echo $contacts['company_name'];?> | <?php echo $contacts['location'];?>, <?php echo $contacts['building'];?>, <?php echo $contacts['floor'];?><br/>
                     E-mail: <?php echo $contacts['email'];?>. Tel : <?php echo $contacts['phone'];?><br/>
                     P.O. Box <?php echo $contacts['address'];?> <?php echo $contacts['post_code'];?>, <?php echo $contacts['city'];?><br/>
                </th>
            </tr>
        </table>
        <?php }?>
        
    </body>
    
</html>