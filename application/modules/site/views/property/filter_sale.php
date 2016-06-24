<?php
$location_query = $this->property_model->get_all_active_locations();
if($location_query->num_rows > 0)
{
    $locations = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="location_id">
                  <option value="0">Select</option>';
    
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
                        <option value="0">Select</option>';
    
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
                    <option value="0">Select</option>';
        
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
                    <option value="0">Select</option>';
    
    foreach($bathrooms_query->result() as $res)
    {
        $bathroom_no .= '<option value="'.$res->bathroom_id.'">'.$res->bathroom_no.'</option>';
    }
    $bathroom_no .= '</select>';
    
    
}

else
{
    $bathroom_no = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="bathroom_id">';
    
        $bathroom_no .= '<option value="0">No bathroom</option>';
    
    $bathroom_no .= '</select>';
}
// end of bathroom selection

// max price selection
$prices_query = $this->property_model->get_all_min_active_prices();
if($prices_query->num_rows > 0)
{
    $max_price_value = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="max_price">
         <option value="0">Any</option>';
    
    foreach($prices_query->result() as $res)
    {
          $max_price_value .= '<option value="'.$res->price.'">$'.number_format($res->price,0).'</option>';
    }
    $max_price_value .= '</select>';
    
    
}

else
{
    $max_price_value = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="max_price">';
    
        $max_price_value .= '<option value="0">No prices added</option>';
    
    $max_price_value .= '</select>';
}
// end of max price selection

// min price selection
$prices_query = $this->property_model->get_all_max_active_prices();
if($prices_query->num_rows > 0)
{
    $min_price_value = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="min_price">
                        <option value="0">Any</option>';
    
    foreach($prices_query->result() as $res)
    {
        $min_price_value .= '<option value="'.$res->price.'">$'.number_format($res->price,0).'</option>';
    }
    $min_price_value .= '</select>';
    
    
}

else
{
    $min_price_value = '<select class="selectpicker show-menu-arrow show-tick" data-live-search="true" data-width="100%" name="min_price">';
    
        $min_price_value .= '<option value="0">No prices added</option>';
    
    $min_price_value .= '</select>';
}
// end of min price selection
$min_price_value = $max_price_value;
?>


<div class="container container-wrapper filters">
        
    <!-- // Filter Now -->
    <?php echo form_open("search-properties-sold", array("class" => "form-horizontal"));?>

    <div class="row">
       <div class="col-sm-4 col-xs-12">
            <label> Location </label>
            <?php echo $locations;?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <label> Property type </label>
            <?php echo $property_types;?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <label> Bedrooms </label>
            <?php echo $bedrooms_no;?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <label> Bathrooms </label>
            <?php echo $bathroom_no;?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <label> Minimum price </label>
            <?php echo $max_price_value;?>
        </div>
        <div class="col-sm-4 col-xs-12">
            <label> Maximum price </label>
            <?php echo $min_price_value;?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-xs-12 col-sm-offset-4 col-md-offset-4"> 
            <div class="center-align">
            	<button type="submit"  class="btn btn-success btn-block" style="margin-top:8px;"> Search - sold</button>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</div>