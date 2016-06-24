<div class="projects">
        <div class="content-title">
            <h2>Recent Properties</h2>
        </div>
        <ul id="filtrable" class="filtrable nav nav-pills ">
            <li class="all current"><a href="#" data-filter="*">All</a></li>
            <li class="sale"><a href="#" data-filter=".sale">Sale</a></li>
            <?php echo $property_types;?>
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
						$rental_unit_image = $prods->rental_unit_image;
						$rental_unit_id = $prods->rental_unit_id;
						$rental_unit_name = $prods->rental_unit_name;
						$description = $prods->rental_unit_description;
						$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
						$price = number_format($rental_unit_price, 0, '.', ',');
						$location_name = $prods->location_name;
						$rental_unit_size = $prods->rental_unit_size;
						$land_size = $prods->land_size;
						$lease_type_id = $prods->lease_type_id;
						$property_type_name = $prods->property_type_name;

						if($lease_type_id == 1)
						{
							$type = 'rent';
						}
						else
						{
							$type = 'sale';
						}

						
						
						
						echo 
						'
						<article class="item col-sm-6 col-md-4 '.$type.' '.$property_type_name.'">
			                <div class="thumbnail">
			                    <a href="'.base_url().'properties/view-single/'.$rental_unit_id.'"><img src="'.base_url().'/assets/images/property/'.$rental_unit_image.'" class="img-responsive" alt=""></a>

			                    <div class="caption">
			                        <p class="price">$ '.$rental_unit_price.' </p>
			                        <ul class="fa-ul">
			                            <li><i class="fa fa-li fa-location-arrow"></i>'.$location_name.'</li>
			                            <li><i class="fa fa-li fa-home"></i>'.$rental_unit_size.' sqft</li>
			                            <li><i class="fa fa-li fa-globe"></i>'.$land_size.' acres</li>
			                        </ul>
			                    </div>
			                </div>
			            </article>
						';
					}
					
				}
				
				else
				{
					echo '<p>No products have been added yet :-(</p>';
				}
			?>
            
           
        </section>
    </div>
