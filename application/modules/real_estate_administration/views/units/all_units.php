<?php
		$row = $rental_unit_details->row();
		$rental_unit_id = $row->rental_unit_id;
		$rental_unit_name = $row->rental_unit_name;
		$rental_unit_price = $row->rental_unit_price;
		$created = $row->created_on;
		$rental_unit_status = $row->rental_unit_status;
		$property_id = $row->property_id;
		
		if($rental_unit_status == 0)
		{
			$rental_unit_status = '<span class="label label-default">Deactivated</span>';
		}
		else
		{
			$rental_unit_status = '<span class="label label-success">Active</span>';
		}
		
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
						<th><a href="'.site_url().'admin/units/units_name/'.$order_method.'/'.$page.'">Unit name</a></th>
						<th><a href="'.site_url().'admin/units/created/'.$order_method.'/'.$page.'">Date Created</a></th>
						<th><a href="'.site_url().'admin/units/last_modified/'.$order_method.'/'.$page.'">Last modified</a></th>
						<th><a href="'.site_url().'admin/units/units_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th><a>Tenancy Status</a></th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			foreach ($query->result() as $row)
			{
				$units_id = $row->units_id;
				$units_name = $row->units_name;
				$units_status = $row->units_status;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				
				$tenancy_query = $this->rental_unit_model->get_tenancy_details($units_id);

				if($tenancy_query->num_rows() > 0)
				{

					$tenancy_status = '<span class="label label-success"> Occupied </span>';
				}
				else
				{
					$tenancy_status = '<span class="label label-warning"> Vacant </span>';
					
				}
				
				//create deactivated status display
				if($units_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-sub-unit/'.$units_id.'/'.$rental_unit_id.'" onclick="return confirm(\'Do you want to activate '.$units_name.'?\');" title="Activate '.$units_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($units_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-sub-unit/'.$units_id.'/'.$rental_unit_id.'" onclick="return confirm(\'Do you want to deactivate '.$units_name.'?\');" title="Deactivate '.$units_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$units_name.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->modified)).'</td>
						<td>'.$status.'</td>
						<td>'.$tenancy_status.'</td>
						<td>
							<!-- Button to trigger modal -->
							<a href="#user'.$units_id.'" class="btn btn-primary btn-sm" data-toggle="modal" title="Expand '.$units_name.'"><i class="fa fa-plus"></i></a>
							
							<!-- Modal -->
							<div id="user'.$units_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$units_name.'</h4>
										</div>
										
										<div class="modal-body">
											<table class="table table-stripped table-condensed table-hover">
												<tr>
													<th>Units Name</th>
													<td>'.$units_name.'</td>
												</tr>
												<tr>
													<th>Status</th>
													<td>'.$status.'</td>
												</tr>
												<tr>
													<th>Date Created</th>
													<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
												</tr>
												<tr>
													<th>Created By</th>
													<td>'.$created_by.'</td>
												</tr>
												<tr>
													<th>Date Modified</th>
													<td>'.date('jS M Y H:i a',strtotime($row->modified)).'</td>
												</tr>
												<tr>
													<th>Modified By</th>
													<td>'.$modified_by.'</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
											<a href="'.site_url().'edit-sub-unit/'.$rental_unit_id.'/'.$units_id.'" class="btn btn-sm btn-success" title="Edit '.$units_name.'"><i class="fa fa-pencil"></i></a>
											'.$button.'
											<a href="'.site_url().'delete-sub-unit/'.$units_id.'/'.$rental_unit_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$units_name.'?\');" title="Delete '.$units_name.'"><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</div>
							</div>
						
						</td>
						<td><a href="'.site_url().'edit-sub-unit/'.$rental_unit_id.'/'.$units_id.'" class="btn btn-sm btn-success" title="Edit '.$units_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-sub-unit/'.$units_id.'/'.$rental_unit_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$units_name.'?\');" title="Delete '.$units_name.'"><i class="fa fa-trash"></i></a></td>
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
			$result .= "There are no units";
		}
?>

						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title"><?php echo $title;?> for <?php echo $rental_unit_name;?></h2>
							</header>
							<div class="panel-body">
                            	<div class="row" style="margin-bottom:20px;">
                                    <div class="col-lg-2 col-lg-offset-8">
                                    	<a href="<?php echo site_url();?>rental-units/<?php echo $property_id;?>" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                    <div class="col-lg-2">
                                    	<a href="<?php echo site_url();?>add-sub-unit/<?php echo $rental_unit_id;?>/<?php echo $property_id;?>" class="btn btn-info pull-right">Add Sub Unit</a>
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
								<div class="table-responsive">
                                	
									<?php echo $result;?>
							
                                </div>
							</div>
						</section>