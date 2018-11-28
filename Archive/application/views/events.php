<div class="se-pre-con"></div>
<div id="page-content">
    <section class="header" style="background-image:url(../montrealundergroundcity/assets/images/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo getLocalizedString($language, "Events"); ?></h1>
                            
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
    <section class="blog-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                    <?php
                    foreach($events as $event):
                    ?>
                        <div class="col-sm-3">
                            <div class="blog-content">
                                <div class="blog-img image-hover">
                                    <a href="<?php echo getURLPrefix($language, 'event_details').'/'.$event['id']; ?>"><img src="<?php echo $this->config->item('download_prefix_event').$event['imagename']; ?>" class="img-responsive" alt=""></a>
                                    <span class="post-date"><?php echo $event['expiredate']; ?></span>
                                </div>
                                <h4><a href="<?php echo getURLPrefix($language, 'event_details').'/'.$event['id']; ?>"><?php echo $event['title']; ?></a></h4>
                                <p><?php echo $event['subtitle']; ?></p>
                                <a class="thm-btn" href="<?php echo getURLPrefix($language, 'event_details').'/'.$event['id']; ?>"><?php echo getLocalizedString($language, "Details"); ?></a>
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