 <div class="featured" >
        <div class="content-title">
            <h2>Featured Properties</h2>
        </div>
        <div class="featured-carousel">
            <div class="featured-control">
                <a href="#" class="featured-prev"><i class="fa fa-angle-left"></i></a>
                <a href="#" class="featured-next"><i class="fa fa-angle-right"></i></a>
            </div>
            <div class="theme-owl-carousel">
                <div class="theme-owl-carousel-wrapper">
                    <div id="featured" class="owl-carousel">
                     <?php
                        if($featured->num_rows() > 0)
                        {
                            $featured_properties = $featured->result();
                            
                            foreach($featured_properties as $prods)
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
								$property_bathrooms = $prods->bathroom_no;
								$property_bedroom = $prods->bedrooms_no;
								$car_space_no = $prods->car_space;
								$property_land_size = $prods->property_land_size;
								
								if(empty($rental_unit_video_id))
								{
									$image = '<a href="'.base_url().'properties/view-single/'.$rental_unit_id.'"><img src="'.base_url().'/assets/images/property/'.$property_image.'" class="img-responsive property-image" alt="'.$rental_unit_name.'"/></a>
									<div style="clear:both;"></div>';
								}
								
								else
								{
									$image = '<div class="youtube" id="'.$rental_unit_video_id.'"></div>';
								}
											echo '
												
									
									<div class="thumbnail">
										'.$image.'
										
										<div class="hero-block">
											<div class="hero-unit text-center">
												<a href="'.base_url().'properties/view-single/'.$rental_unit_id.'">  <h5>'.$rental_unit_name.', '.$location_name.'</h5> </a>
												
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
											 <article style="text-align:justfied; max-height:60px;height:60px; overflow:hidden;">'.$mini_desc.'</article><br/>
												<a style="text-align:justfied;" href="'.base_url().'properties/view-single/'.$rental_unit_id.'" class="btn btn-large btn-success">More info</a>
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
    </div>