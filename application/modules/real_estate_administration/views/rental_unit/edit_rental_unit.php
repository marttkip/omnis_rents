<?php
	$row = $rental_unit[0];
	$rental_unit_id = $row->rental_unit_id;
	$rental_unit_name = $row->rental_unit_name;
	$rental_unit_status = $row->rental_unit_status;
	$rental_unit_price = $row->rental_unit_price;
	$rental_unit_price_type = $row->rental_unit_price_type;
	$bedrooms_idd = $row->bedrooms;
	$rental_unit_size = $row->rental_unit_size;
	$land_size = $row->land_size;
	$lease_type_id = $row->lease_type_id;
	$rental_unit_description = $row->rental_unit_description;
	$rental_unit_image = $row->rental_unit_image;
	$rental_unit_video_id = $row->rental_unit_video_id;
	$rental_unit_bathrooms = $row->rental_unit_bathrooms;
	$car_space_id = $row->car_space_id;
	$actual_date = $row->actual_date;
	$sold_status = $row->sale_status;
	$longitude = $row->longitude;
	$latitude = $row->latitude;
	$rental_unit_inspection_time = $row->rental_unit_inspection_time;
	$rental_unit_brochure = $row->rental_unit_brochure;
	$rental_unit_sale_contract = $row->rental_unit_sale_contract;
	$floor_plan = $row->floor_plan;
?>
<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Edit Rental Unit</h2>
	</header>
	<div class="panel-body">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-lg-12">
                <a href="<?php echo site_url();?>rental-units/<?php echo $property_id;?>" class="btn btn-sm btn-info pull-right"><i class="fa fa-arrow-left"></i> Back to Rental Units</a>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
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
            </div>
        </div>
		<?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
        <div class="row">
            <div class="row">
                <div class="col-lg-6">
                <!-- post Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Title</label>
                        <div class="col-lg-8">
                        	<input type="text" class="form-control" name="rental_unit_name" placeholder="Rental Unit Name" value="<?php echo $rental_unit_name;?>">
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Video ID</label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="rental_unit_video_id" placeholder="Rental Unit Video ID" value="<?php echo $rental_unit_video_id;?>" >
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Price</label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="rental_unit_price" placeholder="Rental Unit Price" value="<?php echo $rental_unit_price;?>" >
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Price Type</label>
                        <div class="col-lg-7">
                        	<?php
                            	if($rental_unit_price_type == 1)
								{
									?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rental_unit_price_type" value="1" checked/> 
                                            For Sale
                                        </label>
                                    </div>
                                    
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rental_unit_price_type" value="0"/> 
                                            To Let
                                        </label>
                                    </div>
                                    <?php
								}
                            	else
								{
									?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rental_unit_price_type" value="1"/> 
                                            For Sale
                                        </label>
                                    </div>
                                    
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="rental_unit_price_type" value="0" checked/> 
                                            To Let
                                        </label>
                                    </div>
                                    <?php
								}
							?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-4 control-label">Available From: </label>
                        
                        <div class="col-lg-7">
                            <div id="datetimepicker1" class="input-append">
                                <input data-format="yyyy-MM-dd" class="form-control" type="text" id="datepicker" name="date_posted" placeholder="Available From" value="<?php echo $actual_date;?>">
                                <span class="add-on" style="cursor:pointer;">
                                    &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-lg-4 control-label" for="image">Brochure</label>
                        <div class="col-lg-7" style="height:auto;">
                    		<div class="alert alert-warning">Must be in PDF format</div>
                        	<?php echo form_upload(array( 'name'=>'rental_unit_brochure', 'class'=>'btn btn-info'));?>
                            <?php if(!empty($rental_unit_brochure)){?>
                            <a href="<?php echo $rental_unit_brochure_location.$rental_unit_brochure;?>" class="submit btn btn-warning" >Download brochure</a>
                            <a href="<?php echo base_url()."admin/rental_unit/delete_brochure/".$rental_unit_id.'/'.$rental_unit_brochure;?>" class="submit btn btn-danger" >Delete brochure</a>
                            <?php }?>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="image">Sale contract</label>
                        <div class="col-lg-7" style="height:auto;">
                    		<div class="alert alert-warning">Must be in PDF format</div>
                        	<?php echo form_upload(array( 'name'=>'rental_unit_sale_contract', 'class'=>'btn btn-info'));?>
                            <?php if(!empty($rental_unit_sale_contract)){?>
                            <a href="<?php echo $property_sale_contract_location.$rental_unit_sale_contract;?>" class="submit btn btn-warning" target="_blank">Download sale contract</a>
                            <a href="<?php echo base_url()."real_estate_administration/rental_unit/delete_sale_contract/".$rental_unit_id.'/'.$property_id.'/'.$rental_unit_sale_contract;?>" class="submit btn btn-danger" onclick="return confirm('Do you want to delete this contract?');">Delete sale contract</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bedrooms</label>
                        <div class="col-lg-7">
                        	<!-- <input type="text" class="form-control" name="rental_unit_size" placeholder="Rental Unit Bedrooms" value="<?php echo $rental_unit_size;?>" > -->
                            <?php
                                $bedrooms_query = $this->rental_unit_model->get_all_active_bedrooms();
                                if($bedrooms_query->num_rows > 0)
                                {
                                    $bedrooms = '<select class="form-control" name="bedroom_id">';
                                    
                                    foreach($bedrooms_query->result() as $res_bedroom)
                                    {
                                        $bedroom_id = $res_bedroom->bedrooms_id;

                                        if($bedroom_id == $bedrooms_idd)
                                        {
                                            $bedrooms .= '<option value="'.$res_bedroom->bedrooms_id.'" selected>'.$res_bedroom->bedrooms_no.'</option>';
                                        }
                                        else
                                        {
                                            $bedrooms .= '<option value="'.$res_bedroom->bedrooms_id.'">'.$res_bedroom->bedrooms_no.'</option>';
                                        }
                                        
                                    }
                                    $bedrooms .= '</select>';
                                    
                                    
                                }
                                
                                else
                                {
                                    $bedrooms = '<select class="form-control" name="location_id">';
                                    
                                        $bedrooms .= '<option value="0">No bedrooms</option>';
                                    
                                    $bedrooms .= '</select>';
                                }
                                echo $bedrooms;
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bathrooms</label>
                        <div class="col-lg-7">
                        	<!-- <input type="text" class="form-control" name="rental_unit_bathrooms" placeholder="Rental Unit Bathrooms" value="<?php echo $rental_unit_bathrooms;?>" > -->
                            
                            <?php
                                $bathrooms_query = $this->rental_unit_model->get_all_active_bathroom();
                                if($bathrooms_query->num_rows > 0)
                                {
                                    $bathroom_no = '<select class="form-control" name="bathroom_id">';
                                    
                                    foreach($bathrooms_query->result() as $res)
                                    {
                                         if($res->bathroom_id == $rental_unit_bathrooms)
                                        {
                                            $bathroom_no .= '<option value="'.$res->bathroom_id.'" selected>'.$res->bathroom_no.'</option>';
                                        }
                                        else
                                        {
                                            $bathroom_no .= '<option value="'.$res->bathroom_id.'">'.$res->bathroom_no.'</option>';
                                        }
                                    }
                                    $bathroom_no .= '</select>';
                                    
                                    
                                }
                                
                                else
                                {
                                    $bathroom_no = '<select class="form-control" name="bathroom_id">';
                                    
                                        $bathroom_no .= '<option value="0">No bedrooms</option>';
                                    
                                    $bathroom_no .= '</select>';
                                }
                                echo $bathroom_no;
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Car spaces</label>
                        <div class="col-lg-7">
                            <?php
                            $car_spaces_query = $this->rental_unit_model->get_all_active_car_spaces();
                            if($car_spaces_query->num_rows > 0)
                            {
                                $car_space_no = '<select class="form-control" name="car_space_id">
                                                <option value="0">Select Car Space</option>';
                                
                                foreach($car_spaces_query->result() as $res)
                                {
                                    if($res->car_space_id == $car_space_id)
                                        {
                                            $car_space_no .= '<option value="'.$res->car_space_id.'" selected>'.$res->car_space.'</option>';
                                        }
                                        else
                                        {
                                            $car_space_no .= '<option value="'.$res->car_space_id.'">'.$res->car_space.'</option>';
                                        }
                                }
                                $car_space_no .= '</select>';
                                
                                
                            }

                            else
                            {
                                $car_space_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bedroom_id">';
                                
                                    $car_space_no .= '<option value="0">No bathroom</option>';
                                
                                $car_space_no .= '</select>';
                            }
                            echo $car_space_no;
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Size</label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="rental_unit_size" placeholder="Rental Unit Land Size" value="<?php echo $rental_unit_size;?>" >
                        </div>
                    </div>
        <div class="form-group">
                     <strong class="col-lg-4 control-label" > </strong>  
                       <div class="col-lg-7">
                      <a href="http://www.latlong.net/" target="_blank" class="btn btn-primary" > Click here to search location </a>
                    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Longitude</label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="longitude" placeholder="Rental Unit Lognitude" value="<?php echo $longitude;?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Latitude </label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="latitude" placeholder="Rental Unit Latitude" value="<?php echo $latitude;?>" >
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Sold?</label>
                        <div class="col-lg-7">
                        	<?php
                        	if($sold_status == 2)
                        	{
                        		?>
	                        	 <input type="radio" name="sold_status"  checked value="2"> Yes
	                             <input type="radio" name="sold_status"  value="1"> No
	                             <?php
                        	}
                        	else
                        	{
                        		?>
	                        	 <input type="radio" name="sold_status"   value="2"> Yes
	                             <input type="radio" name="sold_status" checked value="1"> No
	                             <?php
                        	}
                        	?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate Rental Unit Post?</label>
                        <div class="col-lg-8">
                        <?php
                        if($rental_unit_status == 1)
                        {
                        	?>
                        	<input type="radio" name="rental_unit_status" checked  value="1"> Yes
                            <input type="radio" name="rental_unit_status" value="2"> No
                        	<?php
                        }
                        else
                        {
                        	?>
                        	<input type="radio" name="rental_unit_status"   value="1"> Yes
                            <input type="radio" name="rental_unit_status" checked value="2"> No
                        	<?php
                        }
                        ?>
                            
                        </div>
                    </div>
                    <!-- Image -->
                   
                    <!-- Activate checkbox -->
                    
                </div>
            </div>
            <div class="row">
                <!-- post content -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Rental Unit description</label>
                    <div class="col-lg-8" style="height:auto;">
                        <textarea class="cleditor" name="rental_unit_description" placeholder="Rental Unit Description"> <?php echo $rental_unit_description;?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- post content -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Inspection times</label>
                    <div class="col-lg-8" style="height:auto;">
                        <textarea class="form-control" name="rental_unit_inspection_time" placeholder="Inspection Times"><?php echo $rental_unit_inspection_time;?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-6">
            	 	<div class="form-group">
                        <label class="col-lg-4 control-label">Post Image</label>
                         <input type="hidden" value="<?php echo $rental_unit_image;?>" name="current_image"/>
                        <div class="col-lg-8">
                            
                            <div class="row">
                            
                            	<div class="col-md-8 col-sm-8 col-xs-8">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:150px; height:150px;">
                                             <img src="<?php echo base_url()."assets/images/property/".$rental_unit_image;?>">
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="post_image" ></span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                 </div>
            	<div class="col-md-6">
            	 <div class="form-group">
                        <label class="col-lg-4 control-label">Floor plan</label>
                        <div class="col-lg-8">
                            
                            <div class="row">
                            
                            	<div class="col-md-8 col-sm-8 col-xs-8">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:150px; height:150px;">
                                            <img src="<?php echo base_url()."assets/images/floor_plan/".$floor_plan;?>">
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="floor_plan"></span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                  </div>
                  
            </div>
           <div class="row">
            <!-- Gallery Images -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gallery Images</label>
                        <div class="col-lg-10">
                            <?php echo form_upload(array( 'name'=>'gallery[]', 'multiple'=>true, 'class'=>'btn'));?>
                            <?php
                            	if($gallery_images->num_rows() > 0)
								{
									$galleries = $gallery_images->result();
									
									foreach($galleries as $gal)
									{
										$image = $gal->property_image_thumb;
										$thumb = 'thumb_'.$image;
										$image_id = $gal->image_id;
										?>
                                        <div class="col-md-4">
                                        	<div class="col-md-12">
                                        		<img src="<?php echo base_url()."assets/images/property/".$thumb;?>"/>
                                        	</div>
                                        	<br>
                                        	<div class="col-md-12">
                                        		<a href="<?php echo base_url()."real_estate_administration/rental_unit/delete_gallery_image/".$image.'/'.$thumb.'/'.$image_id.'/'.$rental_unit_id.'/'.$property_id;?>" class="submit btn btn-danger" onclick="return confirm('Do you want to delete this image?');">Delete</a>
                                        	</div>
                                        </div>
                                        <?php
									}
								}
							?>
                        </div>
                    </div>
           </div>
            <div class="row">
                <div class="form-actions center-align">
                    <button class="submit btn btn-primary" type="submit">
                      	Edit Rental Unit Details
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
	</div>
</section>