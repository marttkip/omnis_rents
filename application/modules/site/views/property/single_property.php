<?php
if($property->num_rows() > 0)
{
	$property_rs = $property->result();
	
	foreach($property_rs as $prods)
	{
		$rental_unit_id = $prods->rental_unit_id;
		$rental_unit_price_type = $prods->rental_unit_price_type;
		$rental_unit_name = $prods->rental_unit_name;
		$rental_unit_status = $prods->rental_unit_status;
		$rental_unit_price = $prods->rental_unit_price;
		$bedrooms = $prods->bedrooms;
		$rental_unit_size = $prods->rental_unit_size;
		$land_size = $prods->land_size;
		$lease_type_id = $prods->lease_type_id;
		$rental_unit_description = $prods->rental_unit_description;
		$location_name = $prods->location_name;
		$property_type_name = $prods->property_type_name;
		$rental_unit_video_id = $prods->rental_unit_video_id;
		$sale_status = $prods->sale_status;
		$property_bathrooms = $prods->bathroom_no;
		$property_bedroom = $prods->bedrooms_no;
		$car_space_no = $prods->car_space;
		$actual_date = $prods->actual_date;
		$rental_unit_image = $prods->rental_unit_image;
		$rental_unit_brochure = $prods->rental_unit_brochure;
		$rental_unit_sale_contract = $prods->rental_unit_sale_contract;
		$rental_unit_inspection_time = $prods->rental_unit_inspection_time;
		$latitude = $prods->latitude;
		$longitude = $prods->longitude;
		$floor_plan = $prods->floor_plan;
		$price = number_format($rental_unit_price, 2);
		
		if(empty($rental_unit_video_id))
		{
			$image = '<img src="'.base_url().'/assets/images/property/'.$rental_unit_image.'" class="img-responsive"/>';
		}
	
		else
		{
			$image = '<div class="youtube" id="'.$rental_unit_video_id.'">
			</div>';
		}
	
		if($sale_status == 2)
		{
			if($rental_unit_price_type == 1)
			{
				$sale_status = '';
				$price_display = 'Auction - price over $'.$price;
			}
			else
			{
				$sale_status = 'Sold for';
				$price_display = '$'.$price;
			}
		}
		else
		{
			if($rental_unit_price_type == 1)
			{
				$sale_status = '';
				$price_display = 'Auction - price over $'.$price;
			}
			else
			{
				$sale_status = 'For sale for';
				$price_display = '$'.$price;
			}
		}
	}
}

if(!isset($brochure))
{
	//echo $this->load->view('home/single_header', '', TRUE); 
	//echo $this->load->view('home/filter', '', TRUE); 
}
?>

<div class="container container-wrapper gradient projects single-project">
    
  	<!-- Property images & map -->
    <div class="row" id="single_property_container">
    	<div class="col-md-6">
        	<div class="single-property-image">
        		<?php echo $image;?>
            </div>
        </div>
        
    	<div class="col-md-6">
        	<?php
				if($gallery_images->num_rows() > 0)
				{
					$gallery_no = $gallery_images->num_rows();
					?>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
						<?php
						for($r = 0; $r < $gallery_no; $r++)
						{
							if($r == 0)
							{
								$active = 'active';
							}
							else
							{
								$active = '';
							}
							?>
							<li data-target="#carousel-example-generic" data-slide-to="<?php echo $r;?>" class="<?php echo $active;?>"></li>
							<?php
						}
						?>
						</ol>
						
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
					<?php
					$count = 0;
					foreach($gallery_images->result() as $cat)
					{			
						$rental_unit_image_name = $cat->property_image_thumb;
						$active = '';
						$count++;
						
						if($count == 1)
						{
							$active = 'active';
						}
						
						echo
						'
							<div class="item '.$active.'">
								<img src="'.base_url().'assets/images/property/'.$rental_unit_image_name.'" class="img-responsive">
							</div>
						';
					}
					?>
					</div>
					<?php
					if ($gallery_no > 0)
					{
					?>
						  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
				</div>
					<?php
					}
				}
			?>
        </div><!-- end images -->
    </div>
  	<!-- End Property images & map -->
	
    <!-- Property header -->
	<div class="row">
    	<div class="col-md-12">
        	<div id="baseInfo" class="stackItem">
                <div id="listing_header">
                    <span class="rental_unit_id">
                        
                    </span>
                    <h1 itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                        <span itemprop="streetAddress"><?php echo $rental_unit_name;?></span>, 
                        
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
                                    <?php echo $sale_status;?>
                                </span>
                                
                                <span class="priceText">
                                    <?php echo $price_display;?>
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
        	<div class="row">
            	<div class="col-md-6">
                    <div id="description" class="stackItem" style="text-align:justify">
                    	<?php echo $rental_unit_description;?>
                    </div>
                </div>
                
                <div class="col-md-6">
                
                	<h4>Inspection times</h4>
                    <?php echo $rental_unit_inspection_time;?>
                    
                    <div class="row" style="margin-top:30px;">
                    	<div class="col-md-12">
							<a href="<?php echo site_url().'print-brochure/'.$rental_unit_id;?>" class="submit btn btn-success"  style="width: 100%; margin-bottom:20px;" target="_blank">Print brochure</a>
                    	</div>
                    </div>
                    
                    <div class="row">
                    	<div class="col-md-12">
							<?php if(!empty($rental_unit_sale_contract)){?>
                            <a href="<?php echo base_url().'assets/sale_contracts/'.$rental_unit_sale_contract;?>" class="submit btn btn-success"  style="width: 100%;">Download sale contract</a>
                            <?php }?>
                    	</div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        	<div style="width: 100%;">
                <div id="map_canvas" style="width: 100%; height:350px"></div>
            </div>
            
            <div class="row" style="margin-top:20px;">
            	<div class="col-md-12">
                	<div class="agent-info">
                        <img alt="" src="http://0.gravatar.com/avatar/40b602e6564375ffd02925dd8a94af99?s=24&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D24&amp;r=G" class="avatar avatar-24 photo" height="24" width="24">			<label><span>Agent:</span> Alvaro Masitsa</label>
                        
                        <a href="<?php echo base_url();?>contact" class="view-profile">Contact</a>
                    </div>
                </div>
            </div>
        </div><!-- end map -->
    </div>
    
    <?php
    if(!empty($floor_plan))
	{
	?>
    <div class="row">
    	<div class="col-md-12">
        	<h4>Floor plan</h4>
        	<img src="<?php echo base_url().'/assets/images/floor_plan/'.$floor_plan;?>" class="img-responsive"/>
        </div>
    </div>
    <?php
	}
	?>
    <!-- End Property description -->
  
</div>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCRL4A7M9ZGM7GIPaZqbfv67xtcPFLc2xc&libraries=places"></script>

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
 
    var contentString = '<br/><span itemprop="streetAddress"><?php echo $rental_unit_name;?></span>, <span itemprop="addressLocality"><?php echo $location_name;?></span>';
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