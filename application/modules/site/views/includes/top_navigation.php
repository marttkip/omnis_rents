<?php
$this->load->model('site/site_model');
$navigation = $this->site_model->get_navigation();
?>
<!-- // Main Navigation -->

<div class="header">
    <div class="container">
       
        <div id="res-menu"></div>
        <nav class="site-navigation">
            <ul class="sf-menu clearfix">
              <?php echo $navigation;?>
            </ul>
        </nav>
    </div>
</div>