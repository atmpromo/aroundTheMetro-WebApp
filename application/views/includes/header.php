<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from travel.bdtask.com/travel_demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Apr 2017 10:08:42 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo getLocalizedString($language, "Title"); ?></title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114-precomposed.png">
    <!-- Base Css -->
    <link href="<?php echo base_url(); ?>assets/css/base.css" rel="stylesheet" type="text/css"/>

    <!-- <link rel="stylesheet" type="assets/temp/css" href="temp/css/css7211.css">
    <link rel="stylesheet" href="assets/temp/css/style.css"> -->
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=597a4120ea2b3c001261912e&product=sticky-share-buttons"></script>
</head>

<?php 
function getURLPrefix($lang, $controllername) {
  switch($lang) {
    case 0:
      return base_url().$controllername;
    case 1:
      return base_url().$controllername.'_fr';
    case 2:
      return base_url().$controllername.'_cn';
  }
}
?>

<body>
    <!-- page loader -->
    <div class="se-pre-con"></div>
    <div id="page-content">
        <!-- navber -->
        <nav id="mainNav" class="navbar navbar-fixed-top">
            <div class="container">
                <!--Brand and toggle get grouped for better mobile display--> 
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo getURLPrefix($language, 'world'); ?>">
                        <img style="max-width:90px; margin-top: -7px; max-height:80px;" src="<?php echo base_url(); ?>assets/images/logo.png" class="img-resposive" alt="" >
                    </a>
              </div>
                <!--Collect the nav links, forms, and other content for toggling--> 
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                <!-- world Menu -->
                    <?php 
                    if (isset($worldmenu) && $worldmenu)
                      echo '<li class="active"><a href="'.getURLPrefix($language, 'world').'">'.getLocalizedString($language, "world").'</a></li>'; 
                    else
                      echo '<li><a href="'.getURLPrefix($language, 'world').'">'.getLocalizedString($language, "world").'</a></li>';
                    ?>
                <!-- Home Menu -->
                    <?php 
                    if (isset($citydatamenu) && $citydatamenu)
                      echo '<li class="active"><a href="'.getURLPrefix($language, 'citydata')."/".$country."/".$city.'">'.$city.'</a></li>'; 
                    else
                      echo '<li><a href="'.getURLPrefix($language, 'citydata')."/".$country."/".$city.'">'.$city.'</a></li>';
                    ?>


                <!-- Metros Menu -->
                    <?php 
                    if (isset($metrosmenu) && $metrosmenu) 
                      echo '<li class="dropdown active">'; 
                    else 
                      echo '<li class="dropdown">';
                    ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo getLocalizedString($language, "Metros"); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                                foreach($metros as $metro):
                                    echo "<li><a href=".getURLPrefix($language, 'metro_details')."/". $country . "/". $city ."/".$metro['metro_ID'].">".$metro['metro_name']."</a></li>";
                                endforeach;
                            ?>
                        </ul>
                    </li>
                <!-- Stores Menu -->
                    <?php 
                    if (isset($placesmenu) && $placesmenu) 
                      echo '<li class="dropdown active">'; 
                    else 
                      echo '<li class="dropdown">';
                    ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo getLocalizedString($language, "Places"); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo getURLPrefix($language,'places')."/".$country."/".$city.'/restaurants'; ?>"><?php echo getLocalizedString($language, "Restaurants"); ?></a></li>
                            <li><a href="<?php echo getURLPrefix($language,'places')."/".$country."/".$city.'/boutiques'; ?>"><?php echo getLocalizedString($language, "Boutiques"); ?></a></li>
                            <li><a href="<?php echo getURLPrefix($language,'places')."/".$country."/".$city.'/beautyhealths'; ?>"><?php echo getLocalizedString($language, "BeautyHealths"); ?></a></li>
                            <li><a href="<?php echo getURLPrefix($language,'places')."/".$country."/".$city.'/attractions'; ?>"><?php echo getLocalizedString($language, "Attractions"); ?></a></li>
                        </ul>
                    </li>

             
                <!-- About Menu -->
<!--                    <?php 
                    if (isset($aboutmenu) && $aboutmenu) 
                      echo '<li class="active"><a href="'.getURLPrefix($language,'about').'">'.getLocalizedString($language, "About").'</a></li>'; 
                    else 
                      echo '<li><a href="'.getURLPrefix($language,'about').'">'.getLocalizedString($language, "About").'</a></li>'; 
                    ?>-->

                    <li class="dropdown">
                        <?php
                        switch ($language) {
                        case 0:?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="onEnglishClicked()"><?php echo getLocalizedString($language, "English"); ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-btn" href="#" onclick="onFrenchClicked()"><?php echo getLocalizedString($language, "French"); ?></a></li>
                            </ul>
                        <?php
                            break;
                        case 1: ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="onFrenchClicked()"><?php echo getLocalizedString($language, "French"); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-btn" href="#" onclick="onEnglishClicked()"><?php echo getLocalizedString($language, "English"); ?></a></li>
                            </ul>
                        <?php
                            break;

                        } ?>
                    </li>
                </ul>
                
                <!-- <ul class="nav navbar-nav navbar-right hidden-sm" style="position: absolute; right:20px;">
                    <li class="dropdown">
                    <?php
                    switch ($language) {
                    case 0:?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="onEnglishClicked()"><?php echo getLocalizedString($language, "English"); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-btn" href="#" onclick="onFrenchClicked()"><?php echo getLocalizedString($language, "French"); ?></a></li>
                            <li><a class="nav-btn" href="#" onclick="onChineseClicked()"><?php echo getLocalizedString($language, "Chinese"); ?></a></li>
                        </ul>
                    <?php
                        break;
                    case 1: ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="onFrenchClicked()"><?php echo getLocalizedString($language, "French"); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-btn" href="#" onclick="onEnglishClicked()"><?php echo getLocalizedString($language, "English"); ?></a></li>
                            <li><a class="nav-btn" href="#" onclick="onChineseClicked()"><?php echo getLocalizedString($language, "Chinese"); ?></a></li>
                        </ul>
                    <?php
                        break;
                    case 2: ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" onclick="onChineseClicked()"><?php echo getLocalizedString($language, "Chinese"); ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-btn" href="#" onclick="onEnglishClicked()"><?php echo getLocalizedString($language, "English"); ?></a></li>
                            <li><a class="nav-btn" href="#" onclick="onFrenchClicked()"><?php echo getLocalizedString($language, "French"); ?></a></li>
                        </ul>
                    <?php
                        break;
                    } ?>
                    </li>
                </ul> -->
            </div> <!-- /.navbar-collapse --> 
        </div> <!-- /.container --> 
    </nav> 
    <!-- </div>
    <div style="width:100%;height:2000px"> -->
    <?php 
    if (isset($hotelsmenu) && $hotelsmenu) {
        echo '<section style="width:100%;height:950px">';
        echo '<iframe src="https://www.hotelscombined.com/" style="width:100%;height:950px"></iframe>';
        echo '</section>';
        echo '</div>';
    } else if (isset($mapmenu) && $mapmenu) {
        echo '<section style="width:100%;height:950px">';
        echo '<iframe src="'.getURLPrefix($language,'map').'/content" style="width:100%;height:950px"></iframe>';
        echo '</section>';
        echo '</div>';
    }
    ?>
    <!-- /.nav end -->
    <!-- </div> -->
    <script>
        var linklist = ["home", "map", "stores", "store_details","mall_filter", "places" , "citydata" , "mall_details", "metro_details",  "jobs", "hotels", "events", "promotions", "about", "contact" , "world"];
          function onEnglishClicked() {
            var newurl = window.location.href;
            for (var i=0; i<linklist.length; i++) {
                if ( newurl.includes("/"+linklist[i]+"_fr") ) {
                    newurl = newurl.replace("/"+linklist[i]+"_fr", "/"+linklist[i]);
                    location.href = newurl;
                    break;
                } else if ( newurl.includes("/"+linklist[i]+"_cn") ) {
                    newurl = newurl.replace("/"+linklist[i]+"_cn", "/"+linklist[i]);
                    location.href = newurl;
                    break;
                }
            }
          }

          function onFrenchClicked() {
            var newurl = window.location.href;
            for (var i=0; i<linklist.length; i++) {
                //if (!newurl.includes("/"+linklist[i]+"_fr/")) {
                if (!newurl.includes("/"+linklist[i]+"_fr")) {
                    if ( newurl.includes("/"+linklist[i]+"_cn") ) {
                        newurl = newurl.replace("/"+linklist[i]+"_cn", "/"+linklist[i]+"_fr");
                        location.href = newurl;
                        break;
                    } else if ( newurl.includes("/"+linklist[i]) ) {
                        newurl = newurl.replace("/"+linklist[i], "/"+linklist[i]+"_fr");
                        location.href = newurl;
                        break;
                    }
                }
            }
          }

          function onChineseClicked() {
            var newurl = window.location.href;
            for (var i=0; i<linklist.length; i++) {
                //if (!newurl.includes("/"+linklist[i]+"_cn/")) {
                if (!newurl.includes("/"+linklist[i]+"_cn")) {
                    if ( newurl.includes("/"+linklist[i]+"_fr") ) {
                        newurl = newurl.replace("/"+linklist[i]+"_fr", "/"+linklist[i]+"_cn");
                        location.href = newurl;
                        break;
                    } else if ( newurl.includes("/"+linklist[i]+"") ) {
                        newurl = newurl.replace("/"+linklist[i], "/"+linklist[i]+"_cn");
                        location.href = newurl;
                        break;
                    }
                }
            }
          }
        </script>
