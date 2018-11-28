<div id="page-content">
<section class="header" style="background-image:url(../montrealundergroundcity/assets/images/banner2.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h1><?php echo getLocalizedString($language, "Promotions"); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="row thm-margin">
                    <div class="portfolio-items list-unstyled" id="grid">
                    <?php
                    foreach($promotions as $promotion):
                    ?>
                        <div class="col-sm-6 col-md-3 thm-padding" data-groups='["people"]' style="padding-left:20px;padding-right:20px;padding-top:20px;padding-bottom:20px;">
                            <div class="destination-grid">
                                <a href="<?php echo $promotion['link']; ?>"><img src="<?php echo $this->config->item('download_prefix_promotion').$promotion['imagename']; ?>" class="img-responsive" alt=""></a>
                                <div class="mask">
                                    <h2><?php echo $promotion['storename']; ?></h2>
                                    <p><?php echo $promotion['period']; ?></p>
                                    <a href="<?php echo $promotion['link']; ?>" class="thm-btn"><?php echo getLocalizedString($language, "Readmore"); ?></a>
                                </div>
                                <div class="dest-name">
                                    <h4><?php echo $promotion['storename']; ?></h4>
                                </div>
                                <!-- <div class="dest-icon">
                                    <i class="flaticon-earth-globe" data-toggle="tooltip" data-placement="top" title="15 Tours"></i>
                                    <i class="flaticon-ship" data-toggle="tooltip" data-placement="top" title="9 Criuses"></i>
                                    <i class="flaticon-transport" data-toggle="tooltip" data-placement="top" title="31 Flights"></i>
                                    <i class="flaticon-front" data-toggle="tooltip" data-placement="top" title="83 Hotels"></i>
                                </div> -->
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>