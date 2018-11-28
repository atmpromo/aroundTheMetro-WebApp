<div id="page-content">
<section class="header" style="background-image:url(<?php echo $this->config->item('download_prefix_store_coverphoto').$place[0]['coverphoto_filename']; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo $place[0]['name']; ?></h1>
                            <p><?php echo $place[0]['aboutus'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hotels-details-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <h3><?php echo $place[0]['name']; ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="hotel-review">
                                <img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$place[0]['coverphoto_filename']; ?>" class="img-responsive" alt="">
<!--                                <div class="hotel-review-ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>-->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="review-text">
                                <h4><?php echo getLocalizedString($language, "Type"); ?> : <?php echo $place[0]['type']; ?></h4>
                                <h4><?php echo getLocalizedString($language, "Metro"); ?> : <?php echo $place[0]['metro']; ?></h4>
                                <p><?php echo $place[0]['aboutus']; ?></p>
                                <p><?php echo getLocalizedString($language, "Contact"); ?> : <?php echo $place[0]['phone']; ?></p>
                                
                                <p><?php echo getLocalizedString($language, "Address"); ?> : <?php echo $place[0]['address']; ?></p>
                                <p><?php echo getLocalizedString($language, "Opening_Hour"); ?> : <?php echo $place[0]['opening_hour']; ?></p>

                                <p><?php echo getLocalizedString($language, "Website"); ?> : <a href="<?php echo $place[0]['website']; ?>"><?php echo $place[0]['website']; ?></a></p>
                               

                                <?php 
								if ($place[0]['claimed']==0) { 
								echo '<a href="mailto:info@aroundthemetro.com" class="btn btn-warning" role="button">'.getLocalizedString($language, "claim_page")."</a>"; 
								
								}
								?>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div class="separator"></div> -->
                </div>
            </div>
        </div>
    </section>

</div>