
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url();?>admin/units" class="btn btn-info pull-right">Back to units</a>
                        </div>
                    </div>
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			
			//the units details
			$units_id = $units[0]->units_id;
			$units_name = $units[0]->units_name;
			$units_status = $units[0]->units_status;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$units_id = set_value('units_id');
				$units_name = set_value('units_name');
				$units_status = set_value('units_status');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- Units Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Sub Unit Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="units_name" placeholder="Sub Unit Name" value="<?php echo $units_name;?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Sub Unit?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                        	<?php
                            if($units_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="units_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="1" name="units_status">';}
							?>
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<?php
                            if($units_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="units_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="0" name="units_status">';}
							?>
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit Sub Unit
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                </div>
            </section>