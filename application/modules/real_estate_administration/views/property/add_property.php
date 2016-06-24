<?php
//personnel data
$property_name = set_value('property_name');
$property_location = set_value('property_location');
$property_prefix = set_value('property_prefix');
$total_units = set_value('total_units');
$property_land_size = set_value('property_land_size');
?>          
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?>
                    	<a href="<?php echo site_url();?>real-estate-administration/properties" class="btn btn-sm btn-info pull-right" style="margin-top:-5px;"><i class="fa fa-arrow-left"></i> Back to Properties</a>

                    </h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                        </div>
                    </div>
                        
                    <!-- Adding Errors -->
                    <?php
						$success = $this->session->userdata('success_message');
						$error = $this->session->userdata('error_message');
						
						if(!empty($success))
						{
							echo '
								<div class="alert alert-success">'.$success.'</div>
							';
							
							$this->session->unset_userdata('success_message');
						}
						
						if(!empty($error))
						{
							echo '
								<div class="alert alert-danger">'.$error.'</div>
							';
							
							$this->session->unset_userdata('error_message');
						}
			
						$validation_errors = validation_errors();
						
						if(!empty($validation_errors))
						{
							echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
						}
                    ?>
                    
                    <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
						<div class="row">
							<div class="col-md-6">
						      
						        <div class="form-group">
						            <label class="col-lg-4 control-label">Property Name: </label>
						            
						            <div class="col-lg-8">
						            	<input type="text" class="form-control" name="property_name" placeholder="Property Name" value="<?php echo $property_name;?>">
						            </div>
						        </div>
                                <!-- post category -->
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Property Type</label>
                                    <div class="col-lg-8">
                                        <?php echo $property_types;?>
                                    </div>
                                </div>
                                <!-- post category -->
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Property Location</label>
                                    <div class="col-lg-8">
                                        <?php echo $locations;?>
                                    </div>
                                </div>
						        <div class="form-group">
						            <label class="col-lg-4 control-label">Land Size: </label>
						            
						            <div class="col-lg-8">
						            	<input type="text" class="form-control" name="property_land_size" placeholder="Land Size" value="<?php echo $property_land_size;?>">
						            </div>
						        </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Activate Property?</label>
                                    <div class="col-lg-8">
                                        <input type="radio" name="property_status" checked  value="1"> Yes
                                        <input type="radio" name="property_status" value="0"> No
                                    </div>
                                </div>
							</div>
						    
						    <div class="col-md-6">
						        
						        <div class="form-group">
						            <label class="col-lg-4 control-label">Property prefix: </label>
						            
						            <div class="col-lg-8">
						            	<input type="text" class="form-control" name="property_prefix" placeholder="Property Prefix" value="<?php echo $property_prefix;?>">
						            </div>
						        </div>
						        <div class="form-group">
						            <label class="col-lg-4 control-label">Total Units: </label>
						            
						            <div class="col-lg-8">
						            	<input type="text" class="form-control" name="total_units" placeholder="Total Units" value="<?php echo $total_units;?>">
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
						    </div>
						</div>
                        <div class="row">
                            <!-- post content -->
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Property Description</label>
                                <div class="col-lg-10" style="height:auto;">
                                    <textarea class="cleditor" name="property_description" placeholder="Property Description"><?php echo set_value('property_description');?></textarea>
                                </div>
                            </div>
                        </div>
						<div class="row" style="margin-top:10px;">
							<div class="col-md-12">
						        <div class="form-actions center-align">
						            <button class="submit btn btn-sm btn-primary" type="submit">
						                Add property
						            </button>
						        </div>
						    </div>
						</div>
                    <?php echo form_close();?>
                </div>
            </section>