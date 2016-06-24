<?php echo $this->load->view('contact/contact_header', '', TRUE); ?>

<?php
$location_query = $this->property_model->get_all_active_locations();
if($location_query->num_rows > 0)
{
    $locations = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="location_id">
                  <option value="0">Select a location</option>';
    
    foreach($location_query->result() as $res_location)
    {
        $locations .= ' 
                        <option value="'.$res_location->location_id.'">'.$res_location->location_name.'</option>
                      ';
    }
    $locations .= '</select>';
    
    
}

else
{
    $locations = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="location_id">';
    
        $locations .= '<option value="0">No locations</option>';
    
    $locations .= '</select>';
}


// property type
$property_type_query = $this->property_model->get_all_active_property_type();
if($property_type_query->num_rows > 0)
{
    $property_types = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="property_type_id">
                        <option value="0">Property type</option>';
    
    foreach($property_type_query->result() as $res)
    {
        $property_types .= '
                            <option value="'.$res->property_type_id.'">'.$res->property_type_name.'</option>';
    }
    $property_types .= '</select>';
    
    
}

else
{
    $property_types = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="property_type_id">';
    
        $property_types .= '<option value="0">No property types</option>';
    
    $property_types .= '</select>';
}
        
// end of property_type

// start of bedrooms selection
$bedrooms_query = $this->property_model->get_all_active_bedrooms();
if($bedrooms_query->num_rows > 0)
{
    $bedrooms_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bedroom_id">
                    <option value="0">Bedrooms</option>';
        
    foreach($bedrooms_query->result() as $res)
    {
        $bedrooms_no .= '
                            <option value="'.$res->bedrooms_id.'">'.$res->bedrooms_no.'</option>';
    }
    $bedrooms_no .= '</select>';
    
    
}

else
{
    $bedrooms_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bedroom_id">';
    
        $bedrooms_no .= '<option value="0">No bedrooms</option>';
    
    $bedrooms_no .= '</select>';
}
// end of bedrooms selection

// start of bathroom selection
$bathrooms_query = $this->property_model->get_all_active_bathroom();
if($bathrooms_query->num_rows > 0)
{
    $bathroom_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bathroom_id">
                    <option value="0">Bathrooms</option>';
    
    foreach($bathrooms_query->result() as $res)
    {
        $bathroom_no .= '<option value="'.$res->bathroom_id.'">'.$res->bathroom_no.'</option>';
    }
    $bathroom_no .= '</select>';
    
    
}

else
{
    $bathroom_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bedroom_id">';
    
        $bathroom_no .= '<option value="0">No bathroom</option>';
    
    $bathroom_no .= '</select>';
}
// end of bathroom selection

// start of car spaces selection
$car_spaces_query = $this->property_model->get_all_active_car_spaces();
if($car_spaces_query->num_rows > 0)
{
    $car_space_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="car_space_id">
                    <option value="0">Car spaces</option>';
    
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
// end of car spaces selection
?>
<div class="container container-wrapper gradient top bottom">
    <div class="contact-info">
        <h2>Contact info</h2>
        
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-2">
    
                <img src="<?php echo base_url();?>assets/themes/realta/img/preview/agents/Portrait Dad.jpg" class="img-responsive agent-img" alt="">
                <p>
                    <label class="center-align"><a href="mailto:i.haggarty@wsfn.com.au">i.haggarty@wsfn.com.au</a></label><br/>
                    <label class="center-align"><a href="tel:0414639738">0414 639 738</a></label>
                </p>
            </div>
            
            <div class="col-sm-6 col-md-4" >
    
                <img src="<?php echo base_url();?>assets/themes/realta/img/preview/agents/Portrait Scott.jpg" class="img-responsive agent-img" alt="">
                <p>
                    <label class="center-align"><a href="mailto:s.haggarty@wsfn.com.au">s.haggarty@wsfn.com.au</a></label><br/>
                    <label class="center-align"><a href="tel:0414072084">0414 072 084</a></label>
                </p>
            </div>
        </div>
    </div>
    
    <label class="center-align"><!--<i class="fa fa-map-marker"></i>--><span>Address:</span><a href="#"> 12 Old Northern Road, Baulkham Hills</a></label>
    <div class="widget">
    	<div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h3 class="content-title">Contact us</h3>
                    <?php echo form_open("send-message", array("class" => "form-horizontal"));?>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="first_name" id="first_name" size="30" value="" placeholder="First Name" class="form-control placeholder" />
                            <label class="error" for="first_name" id="first_name_error">first name is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="last_name" id="last_name" size="30" value="" placeholder="Last Name" class="form-control placeholder" />
                            <label class="error" for="last_name" id="last_name_error">last name is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="phone_number" id="phone_number" size="30" value="" placeholder="Phone Number" class="form-control placeholder" />
                            <label class="error" for="phone_number" id="phone_number_error">Phone number is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="email_address" id="email" size="30" value="" placeholder="Email " class="form-control placeholder" />
                            <label class="error" for="email_address" id="email_error">Email is required.</label>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <textarea name="message" id="input-message" cols="30" rows="8" placeholder="Message " class="form-control placeholder"></textarea>
                            <label class="error" for="input-message" id="message_error">Message is required.</label>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="submit" name="submit" class="form-button btn btn-success" id="submit_btn" value="Send" />
                        </div>
                    </div>

                <?php echo form_close();?>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h3 class="content-title">Request an appraisal</h3>
                <!-- // Filter Now -->
                    <?php echo form_open("request-an-appraisal", array("class" => "form-horizontal"));?>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="app_first_name" id="first_name" size="30" value="" placeholder="First Name" class="form-control placeholder" />
                            <label class="error" for="first_name" id="first_name_error">first name is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="app_last_name" id="last_name" size="30" value="" placeholder="Last Name" class="form-control placeholder" />
                            <label class="error" for="last_name" id="last_name_error">last name is required.</label>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="phone_number" id="phone_number" size="30" value="" placeholder="Phone Number" class="form-control placeholder" />
                            <label class="error" for="phone_number" id="phone_number_error">Phone number is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="text" name="email_address" id="email" size="30" value="" placeholder="Email " class="form-control placeholder" />
                            <label class="error" for="email_address" id="email_error">Email is required.</label>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <textarea name="address" id="input-address" cols="30" rows="8" placeholder="Address " class="form-control placeholder"></textarea>
                            <label class="error" for="input-address" id="message_error">Address is required.</label>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <?php echo $property_types;?>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <?php echo $bedrooms_no;?>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <?php echo $bathroom_no?>
                        </div>
                    </div>
                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <?php echo $car_space_no;?>
                        </div>
                    </div>

                    <div class="col-sm-12 af-outer af-required">
                        <div class="form-group af-inner">
                            <input type="submit" name="submit" class="form-button btn btn-success" id="submit_btn" value="Send" />
                        </div>
                    </div>

                <?php echo form_close();?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="google-maps">
                    <!-- <div id="map-canvas"></div> -->
                    <!--<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.co.ke/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Baulkham+Hills,+New+South+Wales,+Australia&amp;aq=0&amp;oq=baul&amp;sll=0.413842,37.903968&amp;sspn=12.411854,21.643066&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Baulkham+Hills+New+South+Wales,+Australia&amp;ll=-33.760672,150.993018&amp;spn=0.161533,0.338173&amp;z=12&amp;output=embed"></iframe><br /><small><a href="https://www.google.co.ke/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Baulkham+Hills,+New+South+Wales,+Australia&amp;aq=0&amp;oq=baul&amp;sll=0.413842,37.903968&amp;sspn=12.411854,21.643066&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Baulkham+Hills+New+South+Wales,+Australia&amp;ll=-33.760672,150.993018&amp;spn=0.161533,0.338173&amp;z=12" style="color:#0000FF;text-align:left">View Larger Map</a></small>-->
                    
                    <!-- Generated from: http://www.trivoo.net/google-maps/ -->
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:100%;width:100%;"><div id="gmap_canvas" style="height:100%;width:100%;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.trivoo.net/google-maps/" id="get-map-data">trivoo.net</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(-33.760893,150.99268699999993),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-33.760893, 150.99268699999993)});infowindow = new google.maps.InfoWindow({content:"<b>First National</b><br/>12 Old Northern Road<br/>2153 Baulkham Hills" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});}google.maps.event.addDomListener(window, 'load', init_map);</script>
                </div>
            </div>
        </div>

    </div>
    <!-- // Google Map -->

   

    

</div>
