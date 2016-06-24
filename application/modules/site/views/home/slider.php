<div class="clearfix" id="flexslider">
    <div class="flexslider">
        <ul class="slides">
        <?php
            if($slides->num_rows() > 0)
            {
                foreach($slides->result() as $slide)
                {
                    $slide_name = $slide->slideshow_name;
                    $description = $slide->slideshow_description;
                    $slide_image = $slide->slideshow_image_name;
                    $description = $this->site_model->limit_text($description, 8);
                    
                    ?>
                    <!-- Slide 1 -->
                    <li>
                        <a href="#"><img src="<?php echo base_url();?>assets/slideshow/<?php echo $slide_image;?>" alt=""/></a>
                    </li>
                <?php
                }
            }
            ?>
           

        </ul>
    </div>
</div>