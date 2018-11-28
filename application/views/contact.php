<div id="page-content">
    <section class="header" style="background-image:url(<?php echo base_url(); ?>assets/images/contact.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1><?php echo getLocalizedString($language, 'contact'); ?></h1>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact -->
        <div class="container">
            <div class="row">
            <br/>
            <br/>
  			 <div class="col-sm-12" align="center" style="padding:25px;">
				<div class="col-sm-6" align="center">
                	<div class="col-sm-12">
                            <h2><?php echo getLocalizedString($language, 'contact_header'); ?></h2>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        
                    <p class="normal_text normal_gray editContent"><?php echo getLocalizedString($language, 'contact_phrase'); ?></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="contact-form" >
                    
                        <form action="mailto:info@montrealsouterrain.ca" method="post" enctype="text/plain">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo getLocalizedString($language, 'contact_name'); ?></label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo getLocalizedString($language, 'contact_email'); ?></label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo getLocalizedString($language, 'contact_phone'); ?></label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo getLocalizedString($language, 'contact_subject'); ?></label>
                                        <input type="text" class="form-control" id="subject" name="subject">
                                    </div>
                                </div>
                            <div class="form-group">
                                <label><?php echo getLocalizedString($language, 'contact_message'); ?></label>
                                <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                            </div>
                            <input type="submit" class="btn btn-info" value="<?php echo getLocalizedString($language, 'contact_submit'); ?>">

                        </form>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </section>
</div>
