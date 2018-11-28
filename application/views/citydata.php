<div id="homeview" style="height:0px;width:0px;visibility:hidden"></div>


<div class="slider-wrapper">
    <div class="responisve-container">
        <div class="slider">
         <section id="hero" class="owl-carousel owl-theme container">
            <div class="item row hero-container">
                <div class="item-outter">
                    <img class="img" src="<?php echo base_url(); ?>assets/images/Metromap/<?php echo $country . '_' . $city; ?>.png">
                    <div class="overlay">
                        <h1 class="text">Around the Metro in<br/><?php echo $city . ', ' . $country; ?></h1>
                        <a href="<?php echo base_url(); ?>assets/images/Metromap/<?php echo $country . '_' . $city; ?>.png" class="thm-btn view_button" data-position="<?php echo getLocalizedString($language, 'ButtonPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1500"><?php echo getLocalizedString($language, "View3dmap"); ?></a>
                    </div>
                </div>
            </div>
            
        </section>

            <!--<div class="fs_loader" class="text-center"></div>-->
                <!--<div class="slide">
                    <p class="uc" data-position="<?php echo getLocalizedString($language, 'WelcomePos'); ?>" data-in="top" data-step="1" data-out="top" data-ease-in="easeOutBounce"><?php echo getLocalizedString($language, "Welcometo"); ?> </p>
                    <p class="slider-titele" data-position="<?php echo getLocalizedString($language, 'TitlePos'); ?>" data-in="left"  data-step="2" data-delay="100"><?php echo getLocalizedString($language, "Title"); ?></p>
                    <p class="slider-text" data-position="<?php echo getLocalizedString($language, 'BannerPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1000">
                        <?php echo getLocalizedString($language, "BannerText1"); ?>
                    </p>
                    <a href="<?php echo getURLPrefix($language, 'map'); ?>" class="thm-btn" data-position="<?php echo getLocalizedString($language, 'ButtonPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1500"><?php echo getLocalizedString($language, "View3dmap"); ?></a>
                </div>
                <div class="slide">
                    <p class="uc" data-position="<?php echo getLocalizedString($language, 'WelcomePos'); ?>" data-in="top" data-step="1" data-out="top"><?php echo getLocalizedString($language, "Welcometo"); ?> </p>
                    <p class="slider-titele" data-position="<?php echo getLocalizedString($language, 'TitlePos'); ?>" data-in="bottom"  data-step="2" data-delay="100"><?php echo getLocalizedString($language, "Title"); ?></p>
                    <p class="slider-text" data-position="<?php echo getLocalizedString($language, 'BannerPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1000">
                        <?php echo getLocalizedString($language, "BannerText2"); ?>
                    </p>
                    <a href="<?php echo getURLPrefix($language, 'map'); ?>" class="thm-btn" data-position="<?php echo getLocalizedString($language, 'ButtonPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1500"><?php echo getLocalizedString($language, "View3dmap"); ?></a>
                    
                </div>
                <div class="slide">
                    <p class="uc" data-position="<?php echo getLocalizedString($language, 'WelcomePos'); ?>" data-in="top" data-step="1" data-out="top"><?php echo getLocalizedString($language, "Welcometo"); ?> </p>
                    <p class="slider-titele" data-position="<?php echo getLocalizedString($language, 'TitlePos'); ?>" data-in="bottom"  data-step="2" data-delay="100"><?php echo getLocalizedString($language, "Title"); ?></p>
                    <p class="slider-text" data-position="<?php echo getLocalizedString($language, 'BannerPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1000">
                        <?php echo getLocalizedString($language, "BannerText3"); ?>
                    </p>
                    <a href="<?php echo getURLPrefix($language, 'map'); ?>" class="thm-btn" data-position="<?php echo getLocalizedString($language, 'ButtonPos'); ?>" data-in="bottom" data-out="right" data-step="2" data-delay="1500"><?php echo getLocalizedString($language, "View3dmap"); ?></a>
                </div>-->
            </div>
        </div>
    </div>



    <div id="main-content">
    
   
    <section class="popular-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="title">
                        <h2><?php echo getLocalizedString($language, 'Restaurants'); ?></h2>
                        <!-- <p>Most Popular Restaurants in Montreal</p> -->
                    </div>
                </div>
            </div>
            <div class="row thm-margin">
                <div id="resto-slide" class="owl-carousel">
                    <?php
                        foreach($places['restaurants'] as $restoindex):
                            $resto = $places['stores'][$restoindex]; 
                            if ($resto['featured'] == '1') {
                        ?>

                            <div class="item">
                                <div class="grid-item-inner">
                                    <div class="grid-img-thumb">
                                        <div class="ribbon"><span><?php echo getLocalizedString($language, 'Featured'); ?></span></div>
                                        <a href="<?php echo getURLPrefix($language,'place_details')."/".$country."/".$city.'/' . $resto['key']; ?>"><img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$resto['coverphoto_filename']; ?>" alt="1" class="img-responsive" style="max-height:200px; min-height:200px;" /></a>
                                    </div>
                                    <div class="grid-content">
                                        <div class="grid-text">
                                            <div class="travel-times">
                                                <h4 class="pull-left"> <?php echo $resto["name"]; ?> </h4>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- popular boutiques -->
    <section class="popular-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="title">
                        <h2><?php echo getLocalizedString($language, 'Boutiques'); ?></h2>
                        <!-- <p>Most Popular Restaurants in Montreal</p> -->
                    </div>
                </div>
            </div>
            <div class="row thm-margin">
                <div id="boutique-slide" class="owl-carousel">
                    <?php
                        foreach($places['boutiques'] as $boutiqueindex):
                            $boutique = $places['stores'][$boutiqueindex]; 
                            if ($boutique['featured'] == '1') {
                        ?>

                            <div class="item">
                                <div class="grid-item-inner">
                                    <div class="grid-img-thumb">
                                        <!-- ribbon -->
                                        <div class="ribbon"><span><?php echo getLocalizedString($language, 'Featured'); ?></span></div>
                                        <a href="<?php echo getURLPrefix($language,'place_details')."/".$country."/".$city.'/' . $boutique['key']; ?>"><img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$boutique['coverphoto_filename']; ?>" alt="1" class="img-responsive" style="max-height:200px; min-height:200px;"/></a>
                                    </div>
                                    <div class="grid-content">
                                        <div class="grid-text">
                                            <!-- <div class="place-name"><?php echo $resto["name"]; ?></div> -->
                                            <div class="travel-times">
                                                <h4 class="pull-left"> <?php echo $boutique["name"]; ?> </h4>
                                                <!-- <span class="pull-right">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                            }
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>
    
       <!-- popular Beauty & Health -->
    <div id="prefix" style="visibility: hidden;height:0px"><?php echo getURLPrefix($language, 'store_details'); ?></div>
    <section class="popular-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="title">
                        <h2><?php echo getLocalizedString($language, 'BeautyHealths'); ?></h2>
                        <!-- <p>Most Popular Restaurants in Montreal</p> -->
                    </div>
                </div>
            </div>
            <div class="row thm-margin">
                <div id="beautyhealth-slide" class="owl-carousel">
                    <?php
                        foreach($places['beautyhealths'] as $beautyhealthindex):
                            $beautyhealth = $places['stores'][$beautyhealthindex]; 
                            if ($beautyhealth['featured'] == '1') {
                        ?>

                            <div class="item">
                                <div class="grid-item-inner">
                                    <div class="grid-img-thumb">
                                        <!-- ribbon -->
                                        <div class="ribbon"><span><?php echo getLocalizedString($language, 'Featured'); ?></span></div>
                                        <a href="<?php echo getURLPrefix($language,'place_details')."/".$country."/".$city.'/' . $beautyhealth['key']; ?>"><img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$beautyhealth['coverphoto_filename']; ?>" alt="1" class="img-responsive"  style="max-height:200px; min-height:200px;"/></a>
                                    </div>
                                    <div class="grid-content">
                                        <div class="grid-text">
                                            <!-- <div class="place-name"><?php echo $resto["name"]; ?></div> -->
                                            <div class="travel-times">
                                                <h4 class="pull-left"> <?php echo $beautyhealth["name"]; ?> </h4>
                                                <!-- <span class="pull-right">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                            }
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>


  <!-- popular attractions -->
    <section class="popular-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="title">
                        <h2><?php echo getLocalizedString($language, 'Attractions'); ?></h2>
                        <!-- <p>Most Popular Restaurants in Montreal</p> -->
                    </div>
                </div>
            </div>
            <div class="row thm-margin">
                <div id="attraction-slide" class="owl-carousel">
                    <?php
                        foreach($places['attractions'] as $attractionindex):
                            $attraction = $places['stores'][$attractionindex]; 
                            if ($attraction['featured'] == '1') {
                        ?>

                            <div class="item">
                                <div class="grid-item-inner">
                                    <div class="grid-img-thumb">
                                        <!-- ribbon -->
                                        <div class="ribbon"><span><?php echo getLocalizedString($language, 'Featured'); ?></span></div>
                                        <a href="<?php echo getURLPrefix($language,'place_details')."/".$country."/".$city.'/' . $attraction['key']; ?>"><img src="<?php echo $this->config->item('download_prefix_store_coverphoto').$attraction['coverphoto_filename']; ?>" alt="1" class="img-responsive" style="max-height:200px; min-height:200px;"/></a>
                                    </div>
                                    <div class="grid-content">
                                        <div class="grid-text">
                                            <!-- <div class="place-name"><?php echo $resto["name"]; ?></div> -->
                                            <div class="travel-times">
                                                <h4 class="pull-left"> <?php echo $attraction["name"]; ?> </h4>
                                                <!-- <span class="pull-right">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                            }
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>
    </div>

</div>