<div id="page-content">
    <section class="header" style="background-image:url(<?php echo $this->config->item('download_prefix_coverphoto').$mall['coverphoto_filename']; ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo $mall['name']; ?></h1>
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
                    
                    <h3><?php echo $mall['name']; ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="hotel-review">
                                <img src="<?php echo $this->config->item('download_prefix_logo').$mall['logophoto_filename']; ?>" class="img-responsive" alt="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="review-text">
                                <?php 
                                    $info = json_decode($mall['info']);
                                    if (count($info) > 0) {
                                        foreach($info as $key => $val):
                                            echo "<h4>".$key." : ".$val."</h4>";
                                        endforeach;
                                    }
                                ?>
                                <br/>
                                <h4><?php echo getLocalizedString($language, "Workinghours"); ?></h4>
                                <h5><?php echo $mall['workinghours']; ?></h5>
                                <br/>
                                <br/>
<!--                                <h4><?php echo getLocalizedString($language, "Aboutus"); ?></h4>
                                <p><?php echo $mall['aboutus']; ?></p>-->
                            </div>
                        </div>
                        
                    </div>
                    <div class="row" align="center">
                    
                        <div class="col-md-12" align="center">
                        <div class="col-md-2"></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/restaurants/'.$mall['id']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."resto.png"; ?>" width="60%"></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/boutiques/'.$mall['id']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."boutique.png"; ?>" width="60%"></a></div>
                            <div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/beautyhealths/'.$mall['id']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."beautyhealth.png"; ?>" width="60%"></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/attractions/'.$mall['id']; ?>" ><img class="stores_img" src="<?php echo $this->config->item('download_prefix_store')."attraction.png"; ?>" width="60%"></a></div>
                        <div class="col-md-2"></div>
                        </div>
                         <div class="col-md-12" align="center">
                        <div class="col-md-2"></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/restaurants/'.$mall['id']; ?>" ><h4><?php echo getLocalizedString($language, 'Restaurants'); ?></h3></a></div>
                        	<div class="col-md-2" 	align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/boutiques/'.$mall['id']; ?>" ><h4><?php echo getLocalizedString($language, 'Boutiques'); ?></h3></a></div>
                            <div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/beautyhealths/'.$mall['id']; ?>" ><h4><?php echo getLocalizedString($language, 'BeautyHealths'); ?></h3></a></div>
                        	<div class="col-md-2" align="center"><a href="<?php echo getURLPrefix($language,'mall_filter').'/attractions/'.$mall['id']; ?>" ><h4><?php echo getLocalizedString($language, 'Attractions'); ?></h3></a></div>
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