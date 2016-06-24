
<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Add a rental unit</h2>
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
                        	<input type="text" class="form-control" name="rental_unit_name" placeholder="Rental Unit Name" value="<?php echo set_value('rental_unit_name');?>" required>
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Video ID</label>
                        <div class="col-lg-8">
                        	<input type="text" class="form-control" name="rental_unit_video_id" placeholder="Rental Unit Video ID" value="<?php echo set_value('rental_unit_video_id');?>" >
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit Price</label>
                        <div class="col-lg-8">
                        	<input type="text" class="form-control" name="rental_unit_price" placeholder="Rental Unit Price" value="<?php echo set_value('rental_unit_price');?>" >
                        </div>
                    </div>
                	<div class="form-group">
                        <label class="col-lg-4 control-label">Type</label>
                        <div class="col-lg-7">
                        	<?php
                            	if(set_value('rental_unit_price_type') == 1)
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
                                    <input data-format="yyyy-MM-dd" class="form-control" type="text" id="datepicker" name="date_posted" placeholder="Available From" value="<?php echo date('Y-m-d');?>">
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
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="image">Sale contract</label>
                        <div class="col-lg-7" style="height:auto;">
                    		<div class="alert alert-warning">Must be in PDF format</div>
                        	<?php echo form_upload(array( 'name'=>'rental_unit_sale_contract', 'class'=>'btn btn-info'));?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bedrooms</label>
                        <div class="col-lg-7">
                        	
                            <?php echo $bedrooms;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bathrooms</label>
                        <div class="col-lg-7">
                            <?php echo $bathrooms;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Car Spaces</label>
                        <div class="col-lg-7">
                        	<select class="form-control" name="car_space_id">
                            	<option value="0">Select Car Space</option>
                            <?php
                            $car_spaces_query = $this->rental_unit_model->get_all_active_car_spaces();
                            if($car_spaces_query->num_rows > 0)
                            {
                                $car_space_no = '';
                                
                                foreach($car_spaces_query->result() as $res)
                                {
									$car_space_no .= '<option value="'.$res->car_space_id.'">'.$res->car_space.'</option>';
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
                        	<input type="text" class="form-control" name="rental_unit_size" placeholder="Rental Unit Size" value="<?php echo set_value('rental_unit_size');?>" >
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
                        	<input type="text" class="form-control" name="longitude" placeholder="Rental Unit Lognitude" value="<?php echo set_value('longitude');?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Latitude </label>
                        <div class="col-lg-7">
                        	<input type="text" class="form-control" name="latitude" placeholder="Rental Unit Latitude" value="<?php echo set_value('latitude');?>" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Sold?</label>
                        <div class="col-lg-7">
                        	 <input type="radio" name="lease_type_id" value="1"> Yes
                             <input type="radio" name="lease_type_id" checked value="2"> No
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate Rental Unit Post?</label>
                        <div class="col-lg-8">
                            <input type="radio" name="rental_unit_status" checked  value="1"> Yes
                            <input type="radio" name="rental_unit_status" value="1"> No
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
                        <textarea class="cleditor" name="rental_unit_description" placeholder="Rental Unit description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- post content -->
                <div class="form-group">
                    <label class="col-lg-2 control-label">Inspection times</label>
                    <div class="col-lg-8" style="height:auto;">
                        <textarea class="form-control" name="rental_unit_inspection_time" placeholder="Inspection times"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-lg-4">
            	 <div class="form-group">
                        <label class="col-lg-4 control-label">Rental Unit image</label>
                        <div class="col-lg-8">
                            
                            <div class="row">
                            
                            	<div class="col-md-8 col-sm-8 col-xs-8">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%;">
                                            <img src="http://placehold.it/800x500">
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="post_image"></span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            	<div class="col-lg-4">
            	 <div class="form-group">
                        <label class="col-lg-4 control-label">Floor plan</label>
                        <div class="col-lg-8">
                            
                            <div class="row">
                            
                            	<div class="col-md-8 col-sm-8 col-xs-8">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:100%;">
                                            <img src="http://placehold.it/500x500">
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
                  <div class="col-lg-4">
                  		<div class="form-group">
		                   <label class="col-lg-2 control-label" for="image">Gallery Images</label>
		                   <div class="col-lg-8" style="height:auto;">
		                       <?php echo form_upload(array( 'name'=>'gallery[]', 'multiple'=>true, 'class'=>'btn'));?>
		                   </div>
		               </div>
                  </div>
            </div>
           
            <div class="row">
                <div class="form-actions center-align">
                    <button class="submit btn btn-primary" type="submit">
                        Add New Rental Unit
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close();?>
	</div>
</section>