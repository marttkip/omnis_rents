<?php
if($property->num_rows() > 0)
{
	$property_rs = $property->result();
	
	foreach($property_rs as $prods)
	{
		$property_id = $prods->property_id;
		$property_name = $prods->property_name;
		$property_status = $prods->property_status;
		$property_price = $prods->property_price;
		$bedrooms = $prods->bedrooms;
		$property_size = $prods->property_size;
		$land_size = $prods->land_size;
		$lease_type_id = $prods->lease_type_id;
		$property_description = $prods->property_description;
		$location_name = $prods->location_name;
		$property_type_name = $prods->property_type_name;
		$property_video_id = $prods->property_video_id;
		$sale_status = $prods->sale_status;
		$property_bathrooms = $prods->bathroom_no;
		$property_bedroom = $prods->bedrooms_no;
		$car_space_no = $prods->car_space;
		$actual_date = $prods->actual_date;
		$property_image = $prods->property_image;
		$property_brochure = $prods->property_brochure;
		$property_sale_contract = $prods->property_sale_contract;
		$property_inspection_time = $prods->property_inspection_time;
		$latitude = $prods->latitude;
		$longitude = $prods->longitude;
		
		$image = '<img src="'.base_url().'/assets/images/property/'.$property_image.'" class="img-responsive"/>';
	
		if($sale_status == 2)
		{
			$sale_status = 'Sold';
		}
		else
		{
			$sale_status = 'For Sale';
		}
	}
}

if(!isset($brochure))
{
	echo $this->load->view('home/single_header', '', TRUE); 
	echo $this->load->view('home/filter', '', TRUE); 
}
?>

<div class="container container-wrapper gradient projects single-project">
	
    <!-- Property header -->
	<div class="row">
    	<div class="col-md-12">
        	<div id="baseInfo" class="stackItem">
                <div id="listing_header">
                    <span class="property_id">
                        
                    </span>
                    <h1 itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                        <span itemprop="streetAddress"><?php echo $property_name;?></span>, 
                        
                        <span itemprop="addressLocality"><?php echo $location_name;?></span>
                        
                        <span itemprop="addressRegion">
                        
                        </span>
                        
                        <span itemprop="postalCode">
                        
                        </span>
                    </h1>
                </div>
                
                <div id="listing_info">
                    <ul class="info">
                        <li class="price">
                            <p class="price">
                                <span class="pricePrefix">
                                    Sold for
                                </span>
                                
                                <span class="priceText">
                                    $<?php echo number_format($property_price,2);?>
                                </span>
                            </p>
                        </li>
                    
                        <li class="property_info">
                            <span class="propertyType">
                                <?php echo $property_type_name;?>
                            </span>
                            
                            <ul class="linkList horizontalLinkList propertyFeatures">
                                <li class="first">
                                    <i class="fa fa-bed"></i>
                                    <span>
                                        <?php echo $property_bedroom;?>
                                    </span>
                                </li>
                                
                                <li>
                                    <i class="fa icon-bath"></i>
                                    <span>
                                        <?php echo $property_bathrooms;?>
                                    </span>
                                </li>
                                
                                <li>
                                    <i class="fa fa-car"></i>
                                    <span>
                                        <?php echo $car_space_no;?>
                                    </span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
                <div class="clear"> </div>
            </div>

        </div>
    </div>
  	<!-- End Property header -->
    
    
    <!-- Property description -->
    <div class="row">
    	<div class="col-md-6">
        	<div id="description" class="stackItem">
                
                <p class="body" style="text-align:justify">
                	<?php echo $property_description;?>
                </p>
            </div>
        </div>
        
        <div class="col-md-6">
        	<div class="row">
            	<div class="col-md-4">
                	<h4>Inspection times</h4>
                    <?php echo $property_inspection_time;?>
                </div>
                
                <div class="col-md-8">
        			<div id="map_canvas" style="width: 100%; height:350px"></div>
                </div>
            </div>
            
            <div class="row" style="margin-top:20px;">
            	<div class="col-md-6">
                	<a href="<?php echo site_url().'about'?>"><img src="<?php echo base_url();?>assets/themes/realta/img/preview/agents/Portrait Dad.jpg" class="img-responsive" alt="" style="max-height:200px"></a>
                    <ul class="fa-ul-icons">
                        <li><i class="fa fa-phone"></i><a href="tel:0414072084">0414 072 084</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:1.haggarty@walshsullivan.com.au">1.haggarty@walshsullivan.com.au</a></li>
                    </ul>
                </div>
            	<div class="col-md-6">
                    <a href="<?php echo site_url().'about'?>"><img src="<?php echo base_url();?>assets/themes/realta/img/preview/agents/Portrait Scott.jpg" class="img-responsive" alt="" style="max-height:200px"></a>
                    <ul class="fa-ul-icons">
                        <li><i class="fa fa-phone"></i><a href="tel:0414072084">0414 072 084</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:s.haggarty@walshsullivan.com.au">s.haggarty@walshsullivan.com.au</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- end map -->
    </div>
    <!-- End Property description -->
    
  	<!-- Property images & map -->
    <div class="row" id="single_property_container">
    	<div class="col-md-6" style="margin-bottom:10px;">
        	<?php echo $image;?>
       	</div>
		<?php
            if($gallery_images->num_rows() > 0)
            {
                foreach($gallery_images->result() as $cat)
                {			
                    $property_image_name = $cat->property_image_thumb;
                    
                    echo
                    '<div class="col-md-6" style="margin-bottom:10px;">
                        <img src="'.base_url().'assets/images/property/'.$property_image_name.'" class="img-responsive">
                    </div>';
                }
                ?>
                </div>
                
                <?php
            }
        ?>
    </div>
  	<!-- End Property images & map -->
  
</div>

<script type="text/javascript"   src="http://maps.google.com/maps/api/js?sensor=false"> </script>

<script type="text/javascript">
$(document).ready(function() {
	initialize()
});
  function initialize() {
    var position = new google.maps.LatLng('<?php echo $latitude ?>', '<?php echo $longitude ?>');
	 <!-- var position = new google.maps.LatLng(latitude, longitude);-->
    var myOptions = {
      zoom: 18,
      center: position,
      //mapTypeId: google.maps.MapTypeId.ROADMAP
	mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(
        document.getElementById("map_canvas"),
        myOptions);
 
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title:"<?php echo $property_type_name;?>"
    });  
 
    var contentString = '<br/><span itemprop="streetAddress"><?php echo $property_name;?></span>, <span itemprop="addressLocality"><?php echo $location_name;?></span>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
       infowindow.open(map,marker);
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
 
  }
 
</script>

<style>
#mainPhoto {
 width: 485px;
  height: 370px;
  background-color:#EEEEEE;
}
.thumbs{
  left: -169px;
  height: 370px;
  background-color: #EEEEEE;	
	}
</style>
</body>