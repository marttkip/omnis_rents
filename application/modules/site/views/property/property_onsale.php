
<?php //echo $this->load->view('property/property_header', '', TRUE); ?>
<?php echo $this->load->view('home/filter', '', TRUE); ?>
<div class="container container-wrapper gradient projects">

    <!-- // Recent Properties -->
  
    <div class="row">
	    <div class="col-xs-12">
	    	<div class="content-title pull left">
		        <h4><?php echo $title;?></h4>
		    </div>
		    <div class="agent-properties property-list clear">
				<div class="grid">
					<ul class="clear">
					<?php
				    	if($query->num_rows() > 0)
						{
							
							$properties = $query->result();
							
							foreach($properties as $prods)
							{
								$rental_unit_price = $prods->rental_unit_price;
								$property_type = $prods->property_type_name;
								$property_image = $prods->rental_unit_image;
								$rental_unit_id = $prods->rental_unit_id;
								$rental_unit_name = $prods->rental_unit_name;
								$description = $prods->rental_unit_name;
								$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
								//$mini_desc = implode(' ', array_slice(explode('.', $description), 0, 1));
								$price = number_format($rental_unit_price, 0, '.', ',');
								$location_name = $prods->location_name;
								$rental_unit_size = $prods->rental_unit_size;
								$land_size = $prods->land_size;
								$lease_type_id = $prods->lease_type_id;
								$property_type_name = $prods->property_type_name;
								$rental_unit_video_id = $prods->rental_unit_video_id;
								$rental_unit_bathrooms = $prods->bathroom_no;
								$rental_unit_bedrooms = $prods->bedrooms_no;
								$car_space_no = $prods->car_space;
								$property_land_size = $prods->property_land_size;
								$sale_status = $prods->sale_status;
								$rental_unit_price_type = $prods->rental_unit_price_type;
									
								if(empty($rental_unit_video_id))
								{
									$image = '<a href="'.base_url().'properties/view-single/'.$rental_unit_id.'"><img src="'.base_url().'/assets/images/property/'.$rental_unit_image.'" class="img-responsive property-image" alt="'.$rental_unit_name.'"/></a>';
								}
								
								else
								{
									$image = '<div class="youtube" id="'.$rental_unit_video_id.'"></div>';
								}

								if($lease_type_id == 1)
								{
									$type = 'rent';
								}
								else
								{
									$type = 'sale';
								}
								
								if($rental_unit_price_type == 1)
								{
									$price_display = 'Auction - price over $'.$price;
								}
								else
								{
									$price_display = '$'.$price;
								}
								?>
								<li id="post-660" class="post-660 homeland_properties type-homeland_properties status-publish has-post-thumbnail hentry clear">
									<div class="row">
										<div class="col-md-5">
											<div class="property-mask property-image">
                                            	<figure class="pimage">
                                                    <a href="<?php echo base_url();?>properties/view-single/<?php echo $rental_unit_id;?>">
                                                    <!--<img width="330" height="230" src="<?php echo base_url();?>assets/images/property/<?php echo $rental_unit_image?>" class="attachment-homeland_rental_unit_medium wp-post-image" alt="banner 2">-->					
                                                    <?php echo $image;?>
                                                    </a>
                                                    <figcaption><a href="<?php echo base_url();?>properties/view-single/<?php echo $rental_unit_id;?>"><i class="fa fa-link fa-lg"></i></a></figcaption>
                                                    <h4> <a href="<?php echo base_url();?>properties/view-single/<?php echo $rental_unit_id;?>" rel="tag"><?php echo $price_display;?></a></h4>	
                                                    <div class="property-price clear">
                                                        <div class="cat-price">
                                                            <span class="pcategory"></span>
                                                            <span class="price">For sale</span>							
                                                        </div>
                                                    </div>
                                                </figure>		
											</div>
										</div>
										<div class="col-md-7">
											<div class="agent-property-desc">
												<div class="property-desc">
													<h4><a href="<?php echo base_url();?>properties/view-single/<?php echo $rental_unit_id;?>"><?php echo $rental_unit_name;?>, <?php echo $location_name;?></a></h4><label></label>
                                                    <p><?php echo $mini_desc;?></p>
											
												</div>
                                                <div class="row house-icons">
                                                    <div class="col-sm-4 col-md-4">
                                                        <i class="fa fa-bed"></i>
                                                        <?php echo $rental_unit_bedrooms ?> Bedrooms
                                                    </div>
                                                    <div class="col-sm-4 col-md-4">
                                                        <i class="fa icon-bath"></i>
                                                        <?php echo $rental_unit_bathrooms;?> Bathrooms					
                                                    </div>
                                                    <div class="col-sm-4 col-md-4">
                                                        <i class="fa fa-car"></i>
                                                        <?php echo $car_space_no;?> Car spaces					
                                                    </div>
                                                </div>
												<div class="agent-info">
													<img alt="" src="http://0.gravatar.com/avatar/40b602e6564375ffd02925dd8a94af99?s=24&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D24&amp;r=G" class="avatar avatar-24 photo" height="24" width="24">			<label><span>Agent:</span> Alvaro Masitsa</label>
                                                    
                                                    <a href="<?php echo base_url();?>properties/view-single/<?php echo $rental_unit_id;?>" class="view-profile">More details</a>
												</div>
											</div>
										</div>
									</div>
								</li>
						<?php
							}
						}

						?>
					</ul>
					<?php

				    if(isset($links))
				    {
				    	echo $links;
				    }

				    ?>
				</div>						
			</div>
	    </div>
	
	 </div>   
</div>