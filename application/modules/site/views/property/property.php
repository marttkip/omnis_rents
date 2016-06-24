<?php echo $this->load->view('property/property_header', '', TRUE); ?>
<?php echo $this->load->view('home/filter', '', TRUE); ?>
<div class="container container-wrapper gradient projects">
  <section class="theme-pages">
			<div class="theme-fullwidth">
			
		
				<div class="property-list ">
					<div class="row">
                    	<div class="col-md-3 col-md-offset-9">
                        	<a style="text-align:justfied; margin-bottom:10px; z-index: 2;
position: relative; width:100%;" href="<?php echo site_url();?>properties/sold" class="btn btn-large btn-success">More recent sales</a> 
                        </div>
                    </div>
					<div class="property-four-cols">
						<div class="row">
						<?php
							$x = $query->num_rows();
					    	if($query->num_rows() > 0)
							{
								
								$properties = $query->result();
								$p = 0;
								foreach($properties as $prods)
								{
									$property_price = $prods->property_price;
									$property_price_type = $prods->property_price_type;
									$property_image = $prods->property_image;
									$property_id = $prods->property_id;
									$property_name = $prods->property_name;
									$description = $prods->property_description;
									$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
									$price = number_format($property_price, 0, '.', ',');
									$location_name = $prods->location_name;
									$property_size = $prods->property_size;
									$land_size = $prods->land_size;
									$lease_type_id = $prods->lease_type_id;
									$property_type_name = $prods->property_type_name;
									$property_bathrooms = $prods->property_bathrooms;
									$bedrooms = $prods->bedrooms_no;
									$property_video_id = $prods->property_video_id;
									$property_bathrooms = $prods->bathroom_no;
									$property_bedroom = $prods->bedrooms_no;
									$car_space_no = $prods->car_space;
									$sale_status = $prods->sale_status;
										
									if(empty($property_video_id))
									{
										$image = '<a href="'.base_url().'properties/view-single/'.$property_id.'"><img src="'.base_url().'/assets/images/property/'.$property_image.'" class="img-responsive property-image" alt="'.$property_name.'"/></a>';
									}
									
									else
									{
										$image = '<div class="youtube" id="'.$property_video_id.'"></div>';
									}

									if($sale_status == 2)
									{
										$type = 'sold';
									}
									else
									{
										$type = 'for sale';
									}

									if($property_price_type == 1)
									{
										$price_display = 'Auction - price over $'.$price;
									}
									else
									{
										$price_display = '$'.$price;
									}
									echo '
                                    <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
										'.$image.'
                                        
										<div class="hero-block">
						                    <div class="hero-unit text-center">
												<a href="'.base_url().'properties/view-single/'.$property_id.'">  <h5>'.$property_name.', '.$location_name.'</h5> </a>
												
												<div class="row property-info">
													
													
													<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
														<span>
															<i class="fa fa-bed"></i>
															'.$property_bedroom.' 
														</span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
														<span>
															<i class="fa icon-bath"></i> '.$property_bathrooms.'
														</span>
													</div>
													
													<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
														<span>
														
															<i class="fa fa-car"></i>
															'.$car_space_no.' 
														</span>
													</div>
												</div>
												<br/>
						                     <article style="text-align:justfied; max-height:70px;height:70px; overflow:hidden; text-align: justify;">'.$mini_desc.'</article><br/>
												<a style="text-align:justfied;" href="'.base_url().'properties/view-single/'.$property_id.'" class="btn btn-large btn-success">More info</a>
						                    </div>
						                </div>
                                       
                                    </div>
                                      
                                    ';
								}
							}
						?>
                        </div>
					</div>                  
				</div>
			</div>
	</section>
</div>