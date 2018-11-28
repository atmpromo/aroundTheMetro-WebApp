
<div id="storesview" style="height:0px;width:0px;visibility:hidden"></div>
<div id="prefix" style="visibility: hidden;height:0px"><?php echo getURLPrefix($language, 'store_details'); ?></div>

<div id="page-content">
    <section class="header" style="background-image:url(<?php echo $this->config->item('download_prefix_cityplace_coverphoto').$headerimg[0]->image_name; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1> <?php echo $title;
							 ?> </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tour-inner">
        <div class="container">
            <h1 id="title" style="margin-top:10px"> <?php echo $title; ?> </h1>
            <br/>

<div class="row">
<?php
//echo '<pre>';
//print_r($headerimg);
//echo '</pre>';
 foreach ($places as $place){ ?>	
 
      <div class="col-sm-4 col-md-3">
        <div class="thumbnail">
         <?php

                            if ($place['featured'] == '1') {
                        ?>
  <div class="ribbon"><span><?php echo getLocalizedString($language, 'Featured'); ?></span></div>
  <?php } ?>

          <a href="<?php echo getURLPrefix($language,'place_details')."/".$country."/".$city.'/' . $place['key']; ?>"><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store').$place['imagename']; ?>" alt="<?php echo $place['name']; ?>"></a>
          <div class="caption">
            <h3><?php echo $place['name']; ?></h3>
            <p><?php echo $place['metro']; ?></p>
          </div>
        </div>
      </div>
      
      <?php 
	  
	   } ?>
      
</div>



        </div>
    </section>

</div>

