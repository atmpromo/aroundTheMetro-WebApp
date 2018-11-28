<div id="page-content">
<section class="header" style="background-image:url(<?php echo $this->config->item('download_prefix_store_coverphoto').$store['coverphoto_filename']; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo $store['name']; ?></h1>
                            <p><?php echo $store['aboutus'] ?></p>
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
                <h3><?php echo $store['name']; ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="hotel-review">
                                <img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$store['coverphoto_filename']; ?>" class="img-responsive" alt="">
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
                                <h4><?php echo getLocalizedString($language, "Type"); ?> : <?php echo $store['type']; ?></h4>
                                <h4><?php echo getLocalizedString($language, "Mall"); ?> : <?php echo $store['mallname']; ?></h4>
                                <h4><?php echo getLocalizedString($language, "Metro"); ?> : <?php echo $store['metroname']; ?></h4>
                                <p><?php echo $store['aboutus']; ?></p>
                                <p><?php echo getLocalizedString($language, "Contact"); ?> : <?php echo $store['contact']; ?></p>
                                <p><?php echo getLocalizedString($language, "Facebook"); ?> : <a href="<?php echo $store['facebook']; ?>"><?php echo $store['facebook']; ?></a></p>
                                <p><?php echo getLocalizedString($language, "Website"); ?> : <a href="<?php echo $store['link']; ?>"><?php echo $store['link']; ?></a></p>
                                
                                <?php 
								if ($store['claimed']==0) { 
								echo '<a href="#" class="btn btn-warning" role="button">'.getLocalizedString($language, "claim_page")."</a>"; 
								
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