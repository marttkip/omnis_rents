<?php
$result ='';
	if($dependants->num_rows() > 0)
	{
		$count = 0;
			
		$result .= 
		'
		<br/>
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>First name</a></th>
					<th>Other names</a></th>
					<th>Relationship</a></th>
					<th>Last editted</a></th>
					<th>Status</a></th>
					<th colspan="5">Actions</th>
				</tr>
			</thead>
			  <tbody>
			  
		';
		
		foreach ($dependants->result() as $row)
		{
			$personnel_dependant_id = $row->personnel_dependant_id;
			$personnel_dependant_fname = $row->personnel_dependant_fname;
			$personnel_dependant_onames = $row->personnel_dependant_onames;
			$relationship_name = $row->relationship_name;
			$personnel_dependant_status = $row->personnel_dependant_status;
			$created = date('jS M Y H:i a',strtotime($row->created));
			$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
			
			//create deactivated status display
			if($personnel_dependant_status == 0)
			{
				$status = '<span class="label label-danger">Deactivated</span>';
				$button = '<a class="btn btn-sm btn-info" href="'.site_url().'human-resource/activate-position/'.$personnel_dependant_id.'/'.$personnel_id.'" onclick="return confirm(\'Do you want to activate '.$personnel_dependant_fname.'?\');" title="Activate '.$personnel_dependant_fname.'"><i class="fa fa-thumbs-up"></i></a>';
			}
			//create activated status display
			else if($personnel_dependant_status == 1)
			{
				$status = '<span class="label label-success">Active</span>';
				$button = '<a class="btn btn-sm btn-default" href="'.site_url().'human-resource/deactivate-position/'.$personnel_dependant_id.'/'.$personnel_id.'" onclick="return confirm(\'Do you want to deactivate '.$personnel_dependant_fname.'?\');" title="Deactivate '.$personnel_dependant_fname.'"><i class="fa fa-thumbs-down"></i></a>';
			}
			
			$count++;
			$result .= 
			'
				<tr>
					<td>'.$count.'</td>
					<td>'.$personnel_dependant_fname.'</td>
					<td>'.$personnel_dependant_onames.'</td>
					<td>'.$relationship_name.'</td>
					<td>'.$last_modified.'</td>
					<td>'.$status.'</td>
					<td>'.$button.'</td>
					<td><a href="'.site_url().'human-resource/delete-dependant-contact/'.$personnel_dependant_id.'/'.$personnel_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$personnel_dependant_fname.'?\');" title="Delete '.$personnel_dependant_fname.'"><i class="fa fa-trash"></i></a></td>
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
		$result = "<p>No dependants have been added</p>";
	}
	

//repopulate data if validation errors occur
$validation_error = validation_errors();
				
if(!empty($validation_error))
{
	$relationship_id = set_value('relationship_id');
	$personnel_dependant_fname = set_value('personnel_dependant_fname');
	$personnel_dependant_onames = set_value('personnel_dependant_onames');
	$personnel_dependant_email = set_value('personnel_dependant_email');
	$personnel_dependant_locality = set_value('personnel_dependant_locality');
	$personnel_dependant_phone = set_value('personnel_dependant_phone');
	$gender_id = set_value('gender_id');
	$title_id = set_value('title_id');
}

else
{
	$relationship_id = '';
	$personnel_dependant_fname = '';
	$personnel_dependant_onames = '';
	$personnel_dependant_email = '';
	$personnel_dependant_locality = '';
	$personnel_dependant_phone = '';

	$gender_id = '';
	$title_id = '';
}
?>
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Personnel's dependant list</h2>
                </header>
                <div class="panel-body">
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open('human-resource/add-dependant-contact/'.$personnel_id, array("class" => "form-horizontal", "role" => "form"));?>
<div class="row">
	<div class="col-md-6">
        
        <div class="form-group">
            <label class="col-lg-5 control-label">Title: </label>
            
            <div class="col-lg-7">
                <select class="form-control" name="title_id">
                	<?php
                    	if($titles->num_rows() > 0)
						{
							$title = $titles->result();
							
							foreach($title as $res)
							{
								$db_title_id = $res->title_id;
								$title_name = $res->title_name;
								
								if($db_title_id == $title_id)
								{
									echo '<option value="'.$db_title_id.'" selected>'.$title_name.'</option>';
								}
								
								else
								{
									echo '<option value="'.$db_title_id.'">'.$title_name.'</option>';
								}
							}
						}
					?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-5 control-label">First Name: </label>
            
            <div class="col-lg-7">
            	<input type="text" class="form-control" name="personnel_dependant_fname" placeholder="First Name" value="<?php echo $personnel_dependant_fname;?>">
            </div>
        </div>
   
     <div class="form-group">
            <label class="col-lg-5 control-label">Other Names: </label>
            
            <div class="col-lg-7">
            	<input type="text" class="form-control" name="personnel_dependant_onames" placeholder="Other Names" value="<?php echo $personnel_dependant_onames;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Gender: </label>
            
            <div class="col-lg-7">
            	<select class="form-control" name="gender_id">
                	<?php
                    	if($genders->num_rows() > 0)
						{
							$gender = $genders->result();
							
							foreach($gender as $res)
							{
								$db_gender_id = $res->gender_id;
								$gender_name = $res->gender_name;
								
								if($db_gender_id == $gender_id)
								{
									echo '<option value="'.$db_gender_id.'" selected>'.$gender_name.'</option>';
								}
								
								else
								{
									echo '<option value="'.$db_gender_id.'">'.$gender_name.'</option>';
								}
							}
						}
					?>
                </select>
            </div>
        </div>
     </div>
	<div class="col-md-6">
        
        <div class="form-group">
            <label class="col-lg-5 control-label">Email Address: </label>
            
            <div class="col-lg-7">
            	<input type="text" class="form-control" name="personnel_dependant_email" placeholder="Email Address" value="<?php echo $personnel_dependant_email;?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-5 control-label">Phone: </label>
            
            <div class="col-lg-7">
            	<input type="text" class="form-control" name="personnel_dependant_phone" placeholder="Phone" value="<?php echo $personnel_dependant_phone;?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-5 control-label">Residence: </label>
            
            <div class="col-lg-7">
            	<input type="text" class="form-control" name="personnel_dependant_locality" placeholder="Residence" value="<?php echo $personnel_dependant_locality;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Relationship to personnel: </label>
            
            <div class="col-lg-7">
            	<select class="form-control" name="relationship_id">
                	<?php
                    	if($relationships->num_rows() > 0)
						{
							$relationship = $relationships->result();
							
							foreach($relationship as $res)
							{
								$db_relationship_id = $res->relationship_id;
								$relationship_name = $res->relationship_name;
								
								if($db_relationship_id == $relationship_id)
								{
									echo '<option value="'.$db_relationship_id.'" selected>'.$relationship_name.'</option>';
								}
								
								else
								{
									echo '<option value="'.$db_relationship_id.'">'.$relationship_name.'</option>';
								}
							}
						}
					?>
                </select>
            </div>
        </div>
	</div>
</div>
<div class="row" style="margin-top:10px;">
	<div class="col-md-12">
        <div class="form-actions center-align">
        	
            <button class="btn btn-primary" type="submit">
                Add dependant
            </button>
        </div>
    </div>
</div>
            <?php echo form_close();?>
            <?php echo $result;?>
                </div>
            </section>