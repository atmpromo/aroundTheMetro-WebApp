<div id="homeview" style="height:0px;width:0px;visibility:hidden"></div>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from travel.bdtask.com/travel_demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Apr 2017 10:08:42 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo  getLocalizedString($language, "Title"); ?></title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114-precomposed.png">
    <!-- Base Css -->
    <link href="<?php echo base_url(); ?>assets/css/base.css" rel="stylesheet" type="text/css"/>

<!--     <link rel="stylesheet" type="assets/temp/css" href="temp/css/css7211.css">
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

<!-- <body style="background-image:url('http://www.hoffman-info.com/wp-content/uploads/2015/01/mapamonde.jpg');
    background-repeat:initial;" > -->

<body style="background-image:url('http://2.bp.blogspot.com/-Xe-PNh-WgUE/VaqkZc2oboI/AAAAAAAAAYg/TpEerW67Zxw/s1600/mapamonde-1024x575.jpg');
    background-repeat:initial;background-size: 100%;
    background-attachment: fixed;" >

    

     

    <div id="main-content">
    
   
    <section class="popular-inner">
        <div class="container">
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                 <a class="navbar-brand" href="<?php echo getURLPrefix($language, 'world'); ?>">
                 <img style="max-width:100px; margin-top: -7px; max-height:100px;" src="<?php echo base_url(); ?>assets/images/logo.png" class="img-resposive" alt="" >
                 </a></div>
                <div class="col-md-7">
                    <div class="title">
                        <h2 style="color:white;"><?php echo getLocalizedString($language, "world_phrase_1"); ?></h2>
                         <h4 style="color:white;"><?php echo getLocalizedString($language, "world_phrase_2"); ?></h4> 
                    </div>
                </div>
            </div>
         
    <div class="row">
    <?php
     foreach ($countries as $country){ ?>	
     
          <div class="col-sm-4 col-md-3">
            <div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">
                <img style="width:50%;" src="<?php echo base_url(); ?>assets/images/Flags/<?php echo $country["short_name"]; ?>.png">
              <div class="caption">
                <h3><?php echo $country['full_name']; ?></h3>
                
                <?php 
                    foreach ($cities[$country['shortcut']] as $city) {
						if ($city['active'] == 1) 
						{ ?>
                <a href="<?php echo getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"]; ?>"><p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?></p></a>						
						<?php }
						else { ?> 
                  <p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?> <span style="text-align:center; font-size:12; font-style:italic;">(coming soon)</span></p></a>
                        <?php }

                        ?>


                    <?php } ?>
                
                
              </div>
            </div>
          </div>
          
          <?php } ?>
                              
                              
                              



        </div>
        
<!--        <div class="row">
                                 <div class="col-sm-4 col-md-3">
                                <div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">
                                  	<img style="width:50%;" src="<?php echo base_url(); ?>assets/images/Flags/<?php echo $country["short_name"]; ?>.png">
                                  <div class="caption">
                                    <h3><?php echo $country['full_name']; ?></h3>
                         <?php 
										foreach ($cities[$country['shortcut']] as $city) {
											?>
                                    <a href="<?php echo getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"]; ?>"><p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?></p></a>
                                    <?php } ?>
                                    </div>
                                    </div>
                         
                         
                          
                        </div>
                                                                                  <div class="col-sm-4 col-md-3">
                                <div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">
                                  	<img style="width:50%;" src="<?php echo base_url(); ?>assets/images/Flags/<?php echo $country["short_name"]; ?>.png">
                                  <div class="caption">
                                    <h3><?php echo $country['full_name']; ?></h3>
                         <?php 
										foreach ($cities[$country['shortcut']] as $city) {
											?>
                                    <a href="<?php echo getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"]; ?>"><p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?></p></a>
                                    <?php } ?>
                                    </div>
                                    </div>
                         
                         
                          
                        </div>                                 <div class="col-sm-4 col-md-3">
                                <div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">
                                  	<img style="width:50%;" src="<?php echo base_url(); ?>assets/images/Flags/<?php echo $country["short_name"]; ?>.png">
                                  <div class="caption">
                                    <h3><?php echo $country['full_name']; ?></h3>
                         <?php 
										foreach ($cities[$country['shortcut']] as $city) {
											?>
                                    <a href="<?php echo getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"]; ?>"><p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?></p></a>
                                    <?php } ?>
                                    </div>
                                    </div>
                         
                         
                          
                        </div>                                 <div class="col-sm-4 col-md-3">
                                <div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">
                                  	<img style="width:50%;" src="<?php echo base_url(); ?>assets/images/Flags/<?php echo $country["short_name"]; ?>.png">
                                  <div class="caption">
                                    <h3><?php echo $country['full_name']; ?></h3>
                         <?php 
										foreach ($cities[$country['shortcut']] as $city) {
											?>
                                    <a href="<?php echo getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"]; ?>"><p  style="text-align:center; font-size:16px"><?php echo $city['full_name']; ?></p></a>
                                    <?php } ?>
                                    </div>
                                    </div>
                         
                         
                          
                        </div>
                        </div>-->
                        
                        
                        
<!--                        <div class="row">
                        <?php 
$all_items = array_chunk($countries,4);

foreach($all_items as $div_item){
foreach ($div_item as $country){
echo '<div class="col-sm-4 col-md-3">';
echo '<div class="thumbnail" id="thumbnailtest" style="background-color: rgba(255,255,255,.85);">';
echo '<img style="width:50%;" src="'. base_url().'assets/images/Flags/'. $country["short_name"].'.png">';
echo '<div class="caption">';
echo '<h3>  '. $country["full_name"].'</h3>';

foreach ($cities[$country['shortcut']] as $city) {
	
echo '<a href="'. getURLPrefix($language , "citydata")."/".$country["short_name"]."/".$city["name_data"].'"><p  style="text-align:center; font-size:16px">'. $city['full_name'].'</p></a>';
}

echo '</div>';
echo '</div>';
echo '</div>';

}
}
echo '<pre>';
print_r($all_items);
echo '</pre>';
?>
</div>-->
    </section>
    

    </div>

</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <!-- jquery ui js -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- fraction slider js -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.fractionslider.js" type="text/javascript"></script>
        <!-- owl carousel js --> 
        <script src="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
        <!-- counter -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/waypoints.js" type="text/javascript"></script>
        <!-- filter portfolio -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.shuffle.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/portfolio.js" type="text/javascript"></script>
        <!-- magnific popup -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
        <!-- range slider -->
        <script src="<?php echo base_url(); ?>assets/js/ion.rangeSlider.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js" type="text/javascript"></script>
        <!-- custom -->
        <script src="<?php echo base_url(); ?>assets/js/custom.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/js/search.js" type="application/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/stores.js" type="text/javascript"></script>
        
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87810605-11', 'auto');
  ga('send', 'pageview');

</script>
        <!-- <script src="assets/temp/js/core.min.js"></script> 
<script src="assets/temp/js/script.js"></script> -->
    </body>

<!-- Mirrored from travel.bdtask.com/travel_demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Apr 2017 10:08:42 GMT -->
</html>