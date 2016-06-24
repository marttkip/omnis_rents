 
    <!-- // Recent Properties -->

    <div class="projects">
        <div class="content-title">
            <h2>Recent Properties</h2>
        </div>
        <ul id="filtrable" class="filtrable nav nav-pills ">
            <li class="all current"><a href="#" data-filter="*">All</a></li>
        	<?php
            if($property_type_names->num_rows() > 0)
			{
				foreach($property_type_names->result() as $res)
				{
					$property_type_name = $res->property_type_name;
					echo '<li class="'.$property_type_name.'"><a href="#" data-filter=".'.$property_type_name.'">'.$property_type_name.'</a></li>';
				}
			}
			?>
        </ul>
        <div class="clear"></div>
        <section class="row items">
            
            <?php
			if($latest->num_rows() > 0)
			{
				
				$lates_properties = $latest->result();
				
				foreach($lates_properties as $prods)
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
						<article class="item col-sm-6 col-md-4 '.$property_type_name.'">
							<div class="thumbnail">
								<a href="'.base_url().'properties/view-single/'.$rental_unit_id.'">'.$image.'</a>
			
								<div class="caption">
									<p class="price">Kes '.number_format($rental_unit_price).'</p>
									<ul class="fa-ul">
										<li><i class="fa fa-li fa-location-arrow"></i>'.$rental_unit_name.', '.$location_name.'</li>
										<li><i class="fa fa-li fa-home"></i>'.$rental_unit_size.'</li>
										<li><i class="fa fa-li fa-globe"></i>'.$property_land_size.'</li>
									</ul>
								</div>
							</div>
						</article>
						';
				}
			}
			?>
            
        </section>
    </div>
