<?php
if (isset($activatedMenu)) { 
	if (strcmp( $activatedMenu, "worldmenu" ) == 0) { $headerdata['worldmenu'] = true; }
	else if (strcmp( $activatedMenu, "homemenu" ) == 0) { $headerdata['homemenu'] = true; }
	else if (strcmp( $activatedMenu, "mallsmenu" ) == 0) { $headerdata['mallsmenu'] = true; }
	else if (strcmp( $activatedMenu, "metromenu" ) == 0) { $headerdata['metromenu'] = true; }
	else if (strcmp( $activatedMenu, "citydatamenu" ) == 0) { $headerdata['citydatamenu'] = true; }
	else if (strcmp( $activatedMenu, "storesmenu" ) == 0) { $headerdata['storesmenu'] = true; } 
	else if (strcmp( $activatedMenu, "jobsmenu" ) == 0) $headerdata['jobsmenu'] = true;
	else if (strcmp( $activatedMenu, "hotelsmenu" ) == 0) $headerdata['hotelsmenu'] = true;
	else if (strcmp( $activatedMenu, "placesmenu" ) == 0) $headerdata['placesmenu'] = true;
	else if (strcmp( $activatedMenu, "eventsmenu" ) == 0) $headerdata['eventsmenu'] = true;
	else if (strcmp( $activatedMenu, "promotionsmenu" ) == 0) $headerdata['promotionsmenu'] = true;
	else if (strcmp( $activatedMenu, "aboutmenu" ) == 0) $headerdata['aboutmenu'] = true;
	else if (strcmp( $activatedMenu, "contactmenu" ) == 0) $headerdata['contactmenu'] = true;
	else if (strcmp( $activatedMenu, "mapmenu" ) == 0) $headerdata['mapmenu'] = true;
} else {
	$headerdata['wolrdmenu'] = true;
}
$headerdata['language'] = $data['language'];
?>


<?php $this->load->view('includes/header', $headerdata); ?>

<?php 
if (isset($data)) {
	$this->load->view($main_content, $data); 
}
else
	$this->load->view($main_content); 
?>

<?php $this->load->view('includes/footer'); ?>