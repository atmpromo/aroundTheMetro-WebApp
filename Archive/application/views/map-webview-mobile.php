<!DOCTYPE HTML>
<html>
	<head>
		<title>VisioWeb Sample Mapviewer</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF8">

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/lib/jquery.js"></script>

		<!-- jquery.mousewheel.js is used for Firefox mousewheel support -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/lib/jquery.mousewheel.js"></script>
		<!-- jquery.bbq.min.js is for jQuery.deparam.querystring(), parsing url parameters -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/lib/jquery.bbq.min.js"></script>

			<!-- RELEASE VisioWeb -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/build/vg.mapviewer.web.js"></script>
		<!-- -->
	
 		<!-- Utility libraries -->

		<!-- Bootstrap -->
		<link href="<?php echo base_url(); ?>assets/visioweb/media/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		
		<link href="<?php echo base_url(); ?>assets/visioweb/media/bootstrap/css/bootstrap-lightbox.min.css" rel="stylesheet" media="screen">

 		<!-- jquery.knob used for progress bar. -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/js/jquery.knob.js"></script>

 		<!-- Application helpers feel free to copy and modify them -->

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/js/MyRoute.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/js/MyNavigation.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/visioweb/js/MyNavigation.css" />

		<link href="<?php echo base_url(); ?>assets/visioweb/css/visioglobe.mobile.css" rel="stylesheet" media="screen">

		<script type="text/javascript">
		// Local map bundle
		//var mapURL =  '../data.bundles/visioglobe_island_web/descriptor.json';
		// Remote map bundle.
		// Remember, you must have published once on VisioMapEditor for your mapURL to be valid.
		var mapURL = 'https://mapserver.visioglobe.com/k58e41b43a0a0e2ba6eb5ca418f07ff096490d65b/descriptor.json';
		//var mapURL = 'https://mapserver.visioglobe.com/YOUR_HASH_HERE/descriptor.json';
		</script>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/js/mapviewer.common.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/visioweb/js/mapviewer.web.js"></script>
				
	</head>
	<body>


	<div id="vg_mapviewer">
		<h3 class="inner_title"><?php echo getLocalizedString($language, "Title"); ?></small></h3>

		<div id="container">
		</div>
		<div id="progress">
			<input value="0" data-width="150" data-readonly="true" data-thickness=".2" data-fgColor="#00afcf" data-bgColor="#292c2e" class="knob" readonly="readonly">
		</div>

		<div id="instructions" class="instructions">
			<div>
				<div id="instructions_prev_button" class="instructions"><img src="<?php echo base_url(); ?>assets/visioweb/media/leftArrow.png"/></div>
				<div id="instructions_count" class="instructions"></div>
				<div id="instructions_brief" class="instructions"></div>
				<div id="instructions_detail" class="instructions"></div>
				<div id="instructions_icon_and_time">
					<img id="instructions_icon" class="instructions" />
					<div id="instructions_time" class="instructions"></div>
				</div>
				<div id="instructions_next_button" class="instructions"><img src="<?php echo base_url(); ?>assets/visioweb/media/rightArrow.png"/></div>
			</div>
			<div id="vg_statusbar">
				<div class="info">
				</div>
			</div>
		</div>
	</div> <!-- #vg_mapviewer -->
	<div id="vg_footer" class="noselect">

		<span class="pull-left" id="route_container">
			<button id="route_clear" class ="vg_button">
				<div id="route_clear_img"></div>
					<div id="route_clear_label">Clear Route</div>
			</button>
		</span>

		<span class="pull-right" style="display: none;" id="floor_container">
			<!-- <span class="floor_text">Floor</span>-->
			<span id="change_floor"></span>
		</span>
	</div> <!-- #vg_footer -->

	<!-- Bubbles or overlay elements on the map, are usually hidden, the mapviewer will change them
		to visible once they are added to the map via mapviewer.addPOI() -->
	<div style="display: none;">
		<div id="place_bubble">
			<div id="place_bubble_title">Title</div>
			<div id="place_bubble_close_button"></div>
			<div id="place_bubble_info_button"></div>
			<button id="place_bubble_set_origin" class="vg_button route_choice_button" data-direction="src" type="button">Set Origin</button>
			<button id="place_bubble_set_waypoint" class="vg_button route_choice_button" data-direction="waypoint" type="button">Set Waypoint</button>
			<button id="place_bubble_set_destination" class="vg_button route_choice_button" data-direction="dst" type="button">Set Destination</button>
		</div>

		<div id="test" style="font-weigth: bold; font-size: 24px; color: #fff; background: none;">
			<img src="<?php echo base_url(); ?>assets/visioweb/media/test.png" style="width: 32px; height: 32px" /> Hello world<br/>
			<a href="#test" style="color: #fff;">Test...</a>
		</div>
		<div id="test2" style="font-weigth: bold; font-size: 24px; color: #fff; background: none; width: 64px; height: 128px">
			<img src="<?php echo base_url(); ?>assets/visioweb/media/test.png" style="width: 64px; height: 64px" />
		</div>
		<div id="testNE" style="font-weigth: bold; font-size: 24px; color: #fff; background: red; width: 32px; height: 32px">
			<img src="<?php echo base_url(); ?>assets/visioweb/media/test.png" style="width: 32px; height: 32px; position: absolute" />
		</div>
		<div id="testSE" style="font-weigth: bold; font-size: 24px; color: #fff; background: green; width: 32px; height: 32px">
			SE
		</div>
		<div id="testSW" style="font-weigth: bold; font-size: 24px; color: #fff; background: none; width: 32px; height: 32px">
			SW
		</div>
		<div id="testNW" style="font-weigth: bold; font-size: 24px; color: #fff; background: green; width: 32px; height: 32px">
			NW
		</div>
		<div id="testMiddleTop" style="font-weigth: bold; font-size: 24px; color: #fff; background: none; width: 32px; height: 32px; color: red">
			MT
		</div>
	</div>
	</body>
</html>
