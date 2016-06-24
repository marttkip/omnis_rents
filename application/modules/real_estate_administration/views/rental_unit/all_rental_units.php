
<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th>Property Name</th>
						<th>Rental Unit Name</th>
						<th>Location</th>
						<th>Date Created</th>
						<th>Last Modified</th>
						<th>Status</th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			
			foreach ($query->result() as $row)
			{
				$rental_unit_id = $row->rental_unit_id;
				$property_name = $row->property_name;
				$rental_unit_name = $row->rental_unit_name;
				$rental_unit_price = $row->rental_unit_price;
				$created = $row->created_on;
				$rental_unit_status = $row->rental_unit_status;
				
				//status
				if($rental_unit_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}

				//create deactivated status display
				if($rental_unit_status == 0)
				{
					$status = '<span class="label label-default"> Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-rental-unit/'.$rental_unit_id.'" onclick="return confirm(\'Do you want to activate '.$rental_unit_name.'?\');" title="Activate '.$rental_unit_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($rental_unit_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-rental-unit/'.$rental_unit_id.'" onclick="return confirm(\'Do you want to deactivate '.$rental_unit_name.'?\');" title="Deactivate '.$rental_unit_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
			
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$property_name.'</td>
						<td>'.$rental_unit_name.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'sub-units/'.$rental_unit_id.'" class="btn btn-sm btn-primary" ><i class="fa fa-folder"></i> Sub Units</a></td>
						<td><a href="'.site_url().'tenants/'.$rental_unit_id.'" class="btn btn-sm btn-warning" ><i class="fa fa-folder"></i> Tenants Detail</a></td>
						<td><a href="'.site_url().'edit-rental-unit/'.$rental_unit_id.'/'.$property_id.'" class="btn btn-sm btn-success" title="Edit '.$rental_unit_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'deactivate-rental-unit/'.$rental_unit_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$rental_unit_name.'?\');" title="Delete '.$rental_unit_name.'"><i class="fa fa-trash"></i></a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no rental units added";
		}
?>

						<section class="panel">
							<header class="panel-heading">						
								<h2 class="panel-title"><?php echo $title;?></h2>
							</header>
							<div class="panel-body">
                            	<div class="row" style="margin-bottom:20px;">
                                    <div class="col-lg-2 col-lg-offset-8">
                                    	<a href="<?php echo site_url();?>real-estate-administration/properties" class="btn btn-primary pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="col-lg-2">
                                    	<a href="<?php echo site_url();?>add-rental-unit/<?php echo $property_id;?>" class="btn btn-info pull-right btn-sm"><i class="fa fa-plus"></i> Add Rental Unit</a>
                                    </div>
                                </div>
                            	<?php
                                $success = $this->session->userdata('success_message');
		
								if(!empty($success))
								{
									echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
									$this->session->unset_userdata('success_message');
								}
								
								$error = $this->session->userdata('error_message');
								
								if(!empty($error))
								{
									echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
									$this->session->unset_userdata('error_message');
								}
								?>
                            	<div class="row" style="margin-bottom:20px;">
                                    <!--<div class="col-lg-2 col-lg-offset-8">
                                        <a href="<?php echo site_url();?>human-resource/export-personnel" class="btn btn-sm btn-success pull-right">Export</a>
                                    </div>-->
                                    <div class="col-lg-12">
                                    </div>
                                </div>
								<div class="table-responsive">
                                	
									<?php echo $result;?>
							
                                </div>
							</div>
                            <div class="panel-footer">
                            	<?php if(isset($links)){echo $links;}?>
                            </div>
						</section>