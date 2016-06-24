
<?php echo $this->load->view('property/property_header', '', TRUE); ?>
<?php echo $this->load->view('home/filter', '', TRUE); ?>
<div class="container container-wrapper gradient projects">

    <!-- // Recent Properties -->

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
		    	if($query->num_rows() > 0)
				{
					
					$properties = $query->result();
					
					foreach($properties as $prods)
					{
						$property_price = $prods->property_price;
						$property_image = $prods->property_image;
						$property_id = $prods->property_id;
						$property_name = $prods->property_name;
						$description = $prods->property_description;
						$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
						$price = number_format($property_price, 0, '.', ',');
						$location_name = $prods->location_name;
						$property_size = $prods->property_size;
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

    					echo '
				        <article class="item col-sm-6 col-md-4 '.$type.' '.$property_type_name.'">
				            <div class="thumbnail">
				                <a href="'.base_url().'properties/view-single/'.$property_id.'"><img src="'.base_url().'assets/images/property/'.$property_image.'" class="img-responsive" alt=""></a>

				                <div class="caption">
				                    <p class="price">$ '.$property_price.'</p>
				                    <ul class="fa-ul">
				                        <li><i class="fa fa-li fa-location-arrow"></i>'.$location_name.', NY</li>
				                        <li><i class="fa fa-li fa-home"></i>'.$property_size.' sqft</li>
				                        <li><i class="fa fa-li fa-globe"></i>'.$land_size.' acres</li>
				                    </ul>
				                </div>
				            </div>
				        </article>
				        ';
				    }
				}
				?>
        		
    </section>
    <?php

    if(isset($links))
    {
    	echo $links;
    }

    ?>
  

</div>
