<div id="page-content">
<section class="header" style="background-image:url(<?php //echo $this->config->item('download_prefix_metro_coverphoto').$metro['coverphoto_filename']; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo $metro['metro_name']; ?></h1>
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
                    
                    <h3><?php echo $metro['name']; ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="hotel-review">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="review-text">
                               
                                <br/>
                                <br/>
                                <br/>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row" align="center">
                    
                        <div class="col-md-12" align="center">
                        <div class="col-md-2"></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city. '/restaurants/'.$metro['metro_ID']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."resto.png"; ?>" width="60%"></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/boutiques/'.$metro['metro_ID']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."boutique.png"; ?>" width="60%"></a></div>
                            <div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/beautyhealths/'.$metro['metro_ID']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."beautyhealth.png"; ?>" width="60%"></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/attractions/'.$metro['metro_ID']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."attraction.png"; ?>" width="60%"></a></div>
                        <div class="col-md-2"></div>
                        </div>
                         <div class="col-md-12" align="center">
                        <div class="col-md-2"></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city. '/restaurants/'.$metro['metro_ID']; ?>" ><h4><?php echo getLocalizedString($language, 'Restaurants'); ?></h3></a></div>
                        	<div class="col-md-2" 	align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/boutiques/'.$metro['metro_ID']; ?>" ><h4><?php echo getLocalizedString($language, 'Boutiques'); ?></h3></a></div>
                            <div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/beautyhealths/'.$metro['metro_ID']; ?>" ><h4><?php echo getLocalizedString($language, 'BeautyHealths'); ?></h3></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'metro_filter').'/'.$country. '/'. $city.'/attractions/'.$metro['metro_ID']; ?>" ><h4><?php echo getLocalizedString($language, 'Attractions'); ?></h3></a></div>
                        <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter -->
    <!-- <section class="get-offer">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <span>Subscribe to our Newsletter</span>
                    <h2>& Discover the best offers!</h2>
                </div>
                <div class="col-sm-7">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter Your Email" name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="flaticon-paper-plane"></i> Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
</div>