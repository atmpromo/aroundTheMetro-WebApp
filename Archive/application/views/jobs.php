<!-- page header -->
<div id="page-content">
    <section class="header" style="background-image:url(../montrealundergroundcity/assets/images/banner2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo getLocalizedString($language, "Jobs"); ?></h1>
                            
                            <!-- <div class="ui breadcrumb">
                                <a href="index-2.html" class="section">Home</a>
                                <div class="divider"> / </div>
                                <div class="active section">Blog Post</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog -->
    <section class="blog-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                    <?php 
                    foreach($jobs as $job):
                    ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="blog-content">
                                <!-- <div class="blog-img image-hover">
                                    <a href="#"><img src="assets/images/blog-800x250-1.jpg" class="img-responsive" alt=""></a>
                                    <span class="post-date">14 November 2016</span>
                                </div> -->
                                <h3><a href="<?php echo $job['link']; ?>"><?php echo $job['company']; ?></a></h3>
                                <h4><a href="<?php echo $job['link']; ?>"><?php echo $job['title']; ?></a></h4>
                                <p><?php 
                                echo substr($job['description'], 0, 320); 
                                if (strlen($job['description']) > 320) {
                                    echo "...";
                                }
                                ?></p>
                                <a class="thm-btn" href="<?php echo $job['link']; ?>"><?php echo getLocalizedString($language, "Details"); ?></a>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
