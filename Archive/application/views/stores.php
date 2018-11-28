
<div id="storesview" style="height:0px;width:0px;visibility:hidden"></div>
<div id="prefix" style="visibility: hidden;height:0px"><?php echo getURLPrefix($language, 'store_details'); ?></div>

<div id="page-content">
    <section class="header" style="background-image:url(../assets/images/banner2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <h1> <?php echo $title; ?> </h1>
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
                <div class="col-sm-4 col-md-3">
                        <div class="input-group custom-search" style="margin-bottom:20px;margin-left:20px">
                            <input id="keyword" type="text" class="form-control" placeholder="Search" />
                            <span class="input-group-btn">
                                <button class="btn hotel-search" type="button">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                        <!-- Facility -->
                        <div class="sidber-box cats-facility">
                            <div class="cats-title">
                                Shopping Malls
                            </div>
                            <div class="facility">
                            <?php
                            $cnt = 0;
                            foreach($malls as $mall):
                                $cnt = $cnt + 1;
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input id="mall<?php echo $cnt; ?>" type="checkbox" value="<?php echo $mall; ?>" checked>
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <?php echo $mall; ?>
                                    </label>
                                </div>
                            <?php
                            endforeach;
                            ?>
                            <div id="mallcnt" style="visibility: hidden;height:0px"><?php echo $cnt; ?></div>
                            </div>
                        </div>
                        <!-- Facility -->
                        <div class="sidber-box cats-facility">
                            <div class="cats-title">
                                Metros
                            </div>
                            <div class="facility">
                            <?php
                            $cnt = 0;
                            foreach($metros as $metro):
                                $cnt = $cnt + 1;
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input id="metro<?php echo $cnt; ?>" type="checkbox" value="<?php echo $metro; ?>" checked>
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        <?php echo $metro; ?>
                                    </label>
                                </div>
                            <?php
                            endforeach;
                            ?>
                            <div id="metrocnt" style="visibility: hidden;height:0px"><?php echo $cnt; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9">
                        <div class="hotel-list-content">
                            <div id="datas" class="row grid-margin">
                                <h4><?php echo getLocalizedString($language, "Loadingdata"); ?></h4>
                            </div>
                        </div>
                        <!-- pagination -->
                        <div id="pagercomp" class="pagination-inner" style="margin-top:0px;margin-bottom:40px;">
                            <!-- pager -->
                            <ul id="pagenavbtns" class="pager">
                                <li class="previous"><a><?php echo getLocalizedString($language, "Previous"); ?></a></li>
                                <li class="next"><a><?php echo getLocalizedString($language, "Next"); ?></a></li>
                            </ul>
                            <!-- pagination -->
                            <ul id="pagecontrol" class="pagination">
                                <!-- <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">15</a></li> -->
                            </ul>
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