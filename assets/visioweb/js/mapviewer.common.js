/* eslint-disable max-len, brace-style, no-mixed-spaces-and-tabs, comma-dangle, no-var, guard-for-in, new-cap, camelcase, require-jsdoc */
/*
	This sample can take the following URL parameters:
	&language=fr|en  choose navigation laguange
	&firstnode   if it exists, it will use firstNodeAsIntersection=true for computing navigation instructions.
	&nomerge     if it exists it will use mergeFloorChangeInstructions=false for computing navigation instructions.

	&src=srcID&dst=dstID&waypoint=wayID will start with a route computed bewtween srcID and dstID, via possibly (if given) wayID.

	&addspaces replace ' ' with <br>.  Only useful on VisioWeb2D.
	&forcelabels if no ids.json file found, set the labels of the places with their IDs.
*/
var vg_ids;
var currentNavigation;
var currentRoute = null;
var routeStartEnd = null; // dummy route object for having start and end as we click
var routeStartID = false;
var routeEndID = false;
var routeWaypointIDs = [];

/*
 * Simple example:
 * shops can be highlighted (browsing), or active (the user is interested)
 * can also accept a POI corresponding to the label of the shop. (since 1.7.19)
 */
function setActiveShop(shop)
{
	// If the shop is actually a POI, find the place with the same id.
	if (shop.vg && shop.vg.poi)
	{
		shop = mapviewer.getPlace(shop.options ? shop.options('id') : shop.vg.id);
		if (shop === false)
		{
			return;
		}
	}


	if (shop == active_shop)
	{
		return;
	}

	resetActiveShop();
	if (typeof(shop) != 'undefined' && shop !== false && !shop.vg.poi)
	{
		// Note, that the 'opacity' parameter only works in VisioWeb2D, it is ignored in VisioWeb
		mapviewer.highlight(shop, 0x00FF00, {opacity: 0.5});
		active_shop = shop;
		// a shop cannot be highlighted and active at the same time.
		if (highlighted_shop == active_shop)
		{
			highlighted_shop = null;
		}

		var shop_id = shop.vg.id;
		jQuery('.shop_link').each(function(i, entry) { if (jQuery(entry).attr('data-id') == shop_id) { jQuery(entry).addClass('selected'); return false;}});
	}
}

function resetActiveShop()
{
	if (active_shop !== null && !active_shop.vg.poi)
	{
		mapviewer.removeHighlight(active_shop);
		active_shop = null;
	}


	// deactivate item on list.
	jQuery('.shop_link').removeClass('selected');
}

function setHighlightedShop(shop)
{
	if (shop === false)
	{
		return;
	}
	if (shop instanceof Array ||
		(shop.vg && shop.vg.poi))
	{
		return;
	}
	if (shop == highlighted_shop)
	{
		return;
	}
	resetHighlightedShop();
	if (typeof(shop) != 'undefined' && shop != active_shop)
	{
		// Note, that the 'opacity' parameter only works in VisioWeb2D, it is ignored in VisioWeb
		mapviewer.highlight(shop, 0xFFFFFF - shop.vg.originalColor, {opacity: 0.5});
		highlighted_shop = shop;
	}
}

function resetHighlightedShop()
{
	if (highlighted_shop !== null)
	{
		mapviewer.removeHighlight(highlighted_shop);
		highlighted_shop = null;
	}
}

// place can be string or Place object
function openPlaceBubble(placeOrPOI)
{
	var result = false;
	if (typeof(placeOrPOI) != 'undefined' && placeOrPOI !== false)
	{
		if (typeof(placeOrPOI) == 'string')
		{
			placeOrPOI = mapviewer.getPlace(placeOrPOI);
			if (placeOrPOI === false)
			{
				return result;
			}
		}
		// destroy previous bubble.
		closePlaceBubble();
		var id;
		var position;
		var floor;
		if (typeof(placeOrPOI.vg.id) !== 'undefined')
		{
			id = placeOrPOI.vg.id;
			position = placeOrPOI.vg.position;
			floor = placeOrPOI.vg.floor;
		}
		else if (placeOrPOI.vg.poi)
		{
			id = placeOrPOI.options('id');
			position = placeOrPOI.options('position');
			floor = placeOrPOI.options('floor');
		}
		else
		{
			return;
		}

		// alignment, bottom middle
		place_poi = mapviewer.addPOI({selector: '#place_bubble', floor: floor, position: position, alignment: {x: 0, y: 1.0}});
		// console.log('addPOI floor '+place.vg.floor+ ' position '+place.vg.position.x + ', '+place.vg.position.y);
		jQuery('#place_bubble_title').html('ID: '+id);
		if (mapviewer.getRoutingNode(id) !== false)
		{
			// node is routable
			jQuery('#place_bubble_set_origin').attr('vg_id', id).prop('disabled', false).css('opacity', '1.0');
			jQuery('#place_bubble_set_destination').attr('vg_id', id).prop('disabled', false).css('opacity', '1.0');
			jQuery('#place_bubble_set_waypoint').attr('vg_id', id).prop('disabled', false).css('opacity', '1.0');
		}
		else
		{
			// node is not routable
			jQuery('#place_bubble_set_origin').attr('vg_id', '').prop('disabled', true).css('opacity', '0.4');
			jQuery('#place_bubble_set_destination').attr('vg_id', '').prop('disabled', true).css('opacity', '0.4');
			jQuery('#place_bubble_set_waypoint').attr('vg_id', '').prop('disabled', true).css('opacity', '0.4');
		}
		result = true;
	}
	return result;
}

function closePlaceBubble()
{
	if (place_poi)
	{
		place_poi.remove();
		place_poi = false;
	}
}

// element can be a Place or a POI
function onObjectMouseOver(event, element)
{
	// console.log('onObjectMouseOver  '+((element.vg.poi) ? element.options('id') : element.vg.id) + ' isPoi? '+element.vg.poi);
	// We'll be notified of highlighting for all objects.
	// console.log('mouse over ' + element);

	// We avoid highlighting POIs that don't have a Place with the same ID.
	if (element.vg && element.vg.poi)
	{
		// element is a POI (it should have options() method)
		element = element.options && mapviewer.getPlace(element.options('id'));

		if (!element)
		{
			return false;
		}
	}

	// console.log('mouseover '+element.vg.id);
	// var id = false;
	// var isPlace = false;
	// if (element.vg && typeof(element.vg.id)!=='undefined')
	// {
	// 	id = element.vg.id;
	// 	isPlace = true;
	// }
	// else if (element.options && typeof(element.options('id')) !=='undefined')
	// {
	// 	id = element.options('id');
	// }

	// if (id.match(/CUT/) !== null || id.match(/VP/) !== null)
	// {
	//	// ignore certain ids, for example CUT and VP
	//	return;
	// }

	if (statusbar_timeout!==null)
	{
		// console.log('*** clear');
		clearTimeout(statusbar_timeout);
		statusbar_timeout = null;
	}

	jQuery('#vg_statusbar').animate({
		top: '-100px'
	});

	// console.log('*** ObjectOver '+element.vg.id);
	setHighlightedShop(element);

	var html = '';
	if (typeof(vg_ids)!='undefined' && typeof(vg_ids.labels[element.vg.id])!='undefined')
	{
		var labels = vg_ids.labels[element.vg.id];
		html += '<h4>Element name='+labels[1]+'</h4>';
	}
	else
	{
		html += '<h4>Element ID='+element.vg.id+'</h4>';
	}
	jQuery('#vg_statusbar .info').html(html);
}

// We dismiss status bar on any mouse out event.
function onObjectMouseOut(event, element)
{
    // console.log('onObjectMouseOut  '+((element.vg.poi) ? element.options('id') : element.vg.id) + ' isPoi? '+element.vg.poi);

	if (statusbar_timeout===null)
	{
		var dismissStatusBar = true;

		if (dismissStatusBar)
		{
			statusbar_timeout = setTimeout(function() {
				// console.log('*** hide');
				jQuery('#vg_statusbar').clearQueue().animate({
					top: '70px'
				}, {
					complete: function() {
						jQuery('#vg_statusbar .info').html('');
					}
				});
			}, 1000);
		}
		else
		{
			jQuery('#vg_statusbar .info').html('');
		}
	}

	// console.log('*** ObjectOut on '+element.vg.id);
	resetHighlightedShop();
}

function doRouting(shop_src, shop_dst)
{
	var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};

	// if no parameters use values on combobox
	if (shop_src === undefined || shop_src === false)
	{
		var jc = jQuery( '#vg_route_from' )[0];
		if (typeof(jc) === 'undefined' || jc.selectedIndex == -1)
		{
			return;
		}
		var opt = jc[jc.selectedIndex];
		var value = opt.value;
		shop_src = value;
	}
	if (shop_dst === undefined)
	{
		jc = jQuery( '#vg_route_to' )[0];
		if (jc.selectedIndex == -1)
		{
			return;
		}
		opt = jc[jc.selectedIndex];
		value = opt.value;
		shop_dst = value;
	}


	if (shop_src == '' || shop_dst == '' ||
		shop_src === false || shop_dst === false ||
		(jQuery.isArray(shop_dst) && shop_dst.length == 1 && shop_dst[0] === false))
	{
		return;
	}

	var lRouteRequest = {};
	lRouteRequest.src = shop_src;// lLastSelectedPlace;
	lRouteRequest.dst = shop_dst;// lSelectedPlace;

	lRouteRequest.routingParameters = {};
	if (handicap_routing)
	{
		// NOTE: make sure the map has these attributes (with the exact case and spelling)
		lRouteRequest.routingParameters.excludedAttributes = ['escalator', 'stairway'];
	}

	// If you did not want to display anything special with a modalityParameters
	// lRouteRequest.routingParameters.remapResultingModality: {'Travelator': 'pedestrian'}

	lRouteRequest.computeNavigation = true;

	// Override certain navigation parameters
	lRouteRequest.navigationParameters = lRouteRequest.navigationParameters || {};
	lRouteRequest.navigationParameters.modalityParameters = lRouteRequest.navigationParameters.mModalityParameters || {};
	lRouteRequest.navigationParameters.modalityParameters.shuttle = lRouteRequest.navigationParameters.modalityParameters.shuttle || {};
	lRouteRequest.navigationParameters.modalityParameters.shuttle.straightAngleThreshold = lRouteRequest.navigationParameters.modalityParameters.shuttle.straightAngleThreshold || 180.0;
	lRouteRequest.navigationParameters.modalityParameters.shuttle.distanceFromCouloirThreshold = lRouteRequest.navigationParameters.modalityParameters.shuttle.distanceFromCouloirThreshold || 1000.0;
	// Uncomment below if you don't want to use the defaults.
	// lRouteRequest.navigationParameters.algorithm = 'auto';
	// lRouteRequest.navigationParameters.algorithm = 'intersectionAlgorithm';
	// make fisrtNodeAsIntersection to be true if you would like a turn right/left instruction when exiting a POI
	// assuming the routing network is accessNode, then a node that is on a hallway...


	if (typeof(query.firstnode) !== 'undefined')
	{
		lRouteRequest.navigationParameters.firstNodeAsIntersection = true;
	}


	/*
	var defaultStraightAngleThreshold = 30.0;
	var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};
	if (query.angle)
	{
		defaultStraightAngleThreshold = query.angle;
	}

	// Changed default straightAngleThreshold
	var modalities = mapviewer.getRoutingModalities();
	var modalityParameters = lRouteRequest.navigationParameters.modalityParameters;
	for (var i in modalities)
	{
		var modality = modalities[i];
		modalityParameters[modality] = modalityParameters[modality] || {};
		modalityParameters[modality].straightAngleThreshold = modalityParameters[modality].straightAngleThreshold || defaultStraightAngleThreshold;
		// modalityParameters[modality].nearPlacesThreshold = 10;
	}
	*/
	// Use default (on 1.7.17 default changed to mergeFloorChangeInstructions -> true)
    // old behavior with false: 2 instructions: 1) go straight, 2) go up (or you have arrived)
    //               with true: 1 instruction:  1) go straight then go up (you will have arrived)
	// lRouteRequest.navigationParameters.mergeFloorChangeInstructions = false;

	if (typeof(query.nomerge) !== 'undefined')
	{
		lRouteRequest.navigationParameters.mergeFloorChangeInstructions = false;
	}
	if (typeof(query.language) !== 'undefined')
	{
		lRouteRequest.language = query.language;
	}

	// reset start end pins
	if (routeStartEnd != null)
	{
		routeStartEnd.remove();
	}

	mapviewer.computeRoute(lRouteRequest)
	.fail(function(pRouteRequest)
	{
		alert('Sorry, there are problems with Routing Server');
	})
	.done(function(pRouteRequest, pRouteData)
	{
		// alert('Success '+ pRouteData);

		if (currentRoute != null)
		{
			currentRoute.remove();
		}
		if (currentNavigation != null)
		{
			currentNavigation.remove();
		}

		if (pRouteData.status && pRouteData.status != 200)
		{
			alert('Sorry, no route available between ' + pRouteRequest.src + ' and ' + pRouteRequest.dst + '.');
			return;
		}

		currentRoute = new MyRoute(mapviewer, pRouteData);
		if (currentRoute.isValid())
		{
			currentRoute.show();

			var startRouteAtFirstShop = true;
			if (startRouteAtFirstShop)
			{
				// selectShop(shop_src);
			}
			else
			{
				setActiveShop(mapviewer.getPlace(shop_src));
				var viewpoint = currentRoute.getInitialViewpointPosition();
				var floorname = currentRoute.getInitialFloor();
				gotoFloorAndPosition(floorname, viewpoint);
			}

			if (useNavigation)
			{
				currentNavigation = new MyNavigation(mapviewer, pRouteData, vg_ids);
				instructions_overlay_visible = true;
				updateToggleInstructions();
			}
		}
		else
		{
			alert('Problems rendering the route between '+pRouteRequest.src + ' and ' + pRouteRequest.dst + '.');
		}
	});
}

function onCommonLoadCompleted()
{
	jQuery('#progress').hide();

	jQuery('#vg_footer').on('click', '.change_floor', function() {
		var target_floor = jQuery(this).attr('data-floor');
		mapviewer.changeFloor(target_floor, {animationDuration: changeFloorAnimationDuration});
		return false;
	});

	jQuery('#vg_sidebar').on('mouseenter', '.shop_link', function() {
		var shop_id = jQuery(this).attr('data-id');
		// console.log('LinkMouseEnter '+shop_id);
		var shop = mapviewer.getPlace(shop_id);
		setHighlightedShop(shop);

		return false;
	});

	jQuery('#vg_sidebar').on('mouseleave', '.shop_link', function() {
		// var shop_id = jQuery(this).attr('data-id');
		// console.log('LinkMouseLeave '+shop_id);
		resetHighlightedShop();

		return false;
	});

	jQuery('#vg_sidebar').on('click', '.shop_link', function() {
		var shop_id = jQuery(this).attr('data-id');
		selectShop(shop_id);

		return false;
	});

	// If there is a route_clear button
	var $route_clear = jQuery('#route_clear');
	// uses new API in mapviewer web/web2d 1.7.14
	if ($route_clear.length == 1 && typeof(mapviewer.on) == 'function')
	{
		mapviewer.on('routeComputed', function(ev) {
			jQuery('#route_clear').show();
		});
		jQuery('#route_clear').on('click', function() {
			clearRouting();
		});
	}

	// Setup Change floor buttons.

	// No need to empty at beginning, and allows to add other things.
	// jQuery('#change_floor').empty();
	var floors = mapviewer.getFloors();
	for (var i in floors)
	{
		var floor = floors[i];
		createFloorLabel(floor.name);
	}
	jQuery('#floor_container').show();

	// select first floor by default
	updateActiveFloorLabel(mapviewer.getCurrentFloor());

	// Start the rendering of the map.
	mapviewer.start();

	jQuery(window).resize(function(event) {
		mapviewer.resize(jQuery('#container').width(), jQuery('#container').height());
	});

	setupInitialPosition();

	var fill_comboboxes = function()
	{
		var $vg_search = jQuery('#vg_search');
		var $vg_route_from = jQuery('#vg_route_from');
		var $vg_route_to = jQuery('#vg_route_to');

		if ($vg_search.length == 0 &&
			$vg_route_from.length == 0 &&
			$vg_route_to.length == 0)
		{
			return;
		}

		var allPlaces = mapviewer.getAllPlaces();
		var additional_content = [];
		for (var id in allPlaces)
		{
			var name = id;
			if (typeof(vg_ids)!='undefined' && vg_ids.labels)
			{
				var labels = vg_ids.labels[id];
				if (typeof(labels)!='undefined')
				{
					name = labels[1];
				}
			}
			additional_content.push('<option value="', id, '">', name, '</option>');
		}
		if (additional_content.length > 0)
		{
			var allOptions = additional_content.join('');

			$vg_search.append(allOptions);
			$vg_route_from.append(allOptions);
			$vg_route_to.append(allOptions);
		}
	};

	// Routing will work on remote URLs and on local bundles, if a routing URL has been set.
	if (mapviewer.getRoutingURL()!='')
	{
		jQuery( '#vg_route_to' ).bind('comboboxselected', function(event, data, c) {
			doRouting();
		});
		jQuery( '#vg_route_from' ).bind('comboboxselected', function(event, data, c) {
			doRouting();
		});

		jQuery( '#vg_route_to' ).bind('comboboxcleared', function(event, data, c) {
			clearRouting();
			routeEndID = false;
		});
		jQuery( '#vg_route_from' ).bind('comboboxcleared', function(event, data, c) {
			clearRouting();
			routeStartID = false;
		});
		// Firefox clear combobox bug
		// There should be a better solution, this is somewhat heavy.
		jQuery( '#vg_route_to ~ span > a > span.ui-icon-close' ).on('mouseup', function(event, data, c) {
			clearRouting();
			routeEndID = false;
			return false;
		});
		jQuery( '#vg_route_from ~ span > a > span.ui-icon-close' ).on('mouseup', function(event, data, c) {
			clearRouting();
			routeStartID = false;
			return false;
		});

		// NAVIGATION
		if (useNavigation)
		{
			jQuery('#instructions_prev_button').on('click', null, function() {
				if (typeof(currentNavigation) == 'object' && currentNavigation !== null)
				{
					currentNavigation.displayPrevInstruction();
				}
				return false;
			});
			jQuery('#instructions_next_button').on('click', null, function() {
				if (typeof(currentNavigation) == 'object' && currentNavigation !== null)
				{
					currentNavigation.displayNextInstruction();
				}
				return false;
			});
			jQuery('#toggle_instructions').on('click', null, function() {
				instructions_overlay_visible = !instructions_overlay_visible;
				if (currentRoute != null)
				{
					updateToggleInstructions();
				}
				return false;
			});
		}
		jQuery('#selectors #route').show();
		jQuery('#vg_sidebar_routing').show();
		jQuery('#clear_route_button').show();
	}
	else
	{
		jQuery('#vg_sidebar_routing').hide();

		closePlaceBubble = function() {};
		openPlaceBubble = function() {};
	}


	jQuery('#place_bubble_set_origin').on('click', null, function() {
		var id = jQuery(this).attr('vg_id');

		routeStartID = id;
		routeWaypointIDs = [];
		// preselect comboboxes if exist
		var srcBox = jQuery('#vg_route_from');
		if (srcBox.length == 1)
		{
			var srcIndex = jQuery('option[value="'+id+'"]', srcBox).index();
			if (srcIndex != -1)
			{
				var srcBox0 = srcBox[0];
				srcBox0.selectedIndex = srcIndex;

				jQuery('#vg_route_from-input').val(jQuery(srcBox0[srcIndex]).val());
			}
		}
		closePlaceBubble();
		if (routeStartEnd == null)
		{
			routeStartEnd = new MyRoute(mapviewer);
		}
		if (routeStartEnd != null)
		{
			var place = mapviewer.getPlace(id);
			if (place)
			{
				var position = {x: place.vg.position.x, y: place.vg.position.y, z: 3};
				routeStartEnd.remove();
				routeStartEnd.addStartPOI(place.vg.floor, position);
			}
		}

		doRouting(routeStartID, routeWaypointIDs.concat(routeEndID));
		return false;
	});
	jQuery('#place_bubble_set_destination').on('click', null, function() {
		var id = jQuery(this).attr('vg_id');

		routeEndID = id;

		// preselect comboboxes if exist
		var dstBox = jQuery('#vg_route_to');
		if (dstBox.length == 1)
		{
			var dstIndex = jQuery('option[value="'+id+'"]', dstBox).index();
			if (dstIndex != -1)
			{
				var dstBox0 = dstBox[0];
				dstBox0.selectedIndex = dstIndex;
				jQuery('#vg_route_to-input').val(jQuery(dstBox0[dstIndex]).val());
			}
		}
		closePlaceBubble();

		if (routeStartEnd == null)
		{
			routeStartEnd = new MyRoute(mapviewer);
		}
		if (routeStartEnd != null)
		{
			var place = mapviewer.getPlace(id);
			if (place)
			{
				var position = {x: place.vg.position.x, y: place.vg.position.y, z: 3};
				routeStartEnd.remove();
				routeStartEnd.addEndPOI(place.vg.floor, position);
			}
		}
		doRouting(routeStartID, routeWaypointIDs.concat(routeEndID));
		return false;
	});
	jQuery('#place_bubble_set_waypoint').on('click', null, function() {
		var id = jQuery(this).attr('vg_id');

		routeWaypointIDs.push(id);

		closePlaceBubble();

		if (routeStartEnd == null)
		{
			routeStartEnd = new MyRoute(mapviewer);
		}
		if (routeStartEnd != null)
		{
			var place = mapviewer.getPlace(id);
			if (place)
			{
				var position = {x: place.vg.position.x, y: place.vg.position.y, z: 3};
				// routeStartEnd.remove();
				routeStartEnd.addWaypointPOI(place.vg.floor, position);
			}
		}
		return false;
	});

	jQuery('#place_bubble_close_button').on('click', null, function()
	{
		closePlaceBubble();
		return false;
	});


	var doSelectShop = function()
	{
	  // console.log('doSelectShop');
	  var jc = jQuery( '#vg_search' )[0];
	  var opt = jc[jc.selectedIndex];
	  var value = opt.value;
	  if (value != '')
	  {
		selectShop(value);
		// mapviewer.camera.goTo(value);
	  }
 	};
 	jQuery( '#vg_search' ).bind('comboboxselected', doSelectShop);
 	jQuery( '#vg_search' ).bind('comboboxcleared', function() {
		// console.log('clear shop');
		resetActiveShop();
	});
	// Firefox clear combobox bug
	// There should be a better solution, this is somewhat heavy.
	jQuery( '#vg_search ~ span > a > span.ui-icon-close' ).on('mouseup', function(event, data, c) {
		resetActiveShop();
		return false;
	});

	// moved to mapviewer.common.js


	// needs to be called after comboboxes have been filled.
	// this method is complicated by the fact that we want to update the UI
	// and that the doRouting() function uses the UI for its parameters
	function doRoutingFromURLParameters()
	{
		// Compute routing is passed as parameter
		var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};
		if (typeof query.src != 'undefined' && typeof query.dst != 'undefined')
		{
			routeStartID = query.src;
			routeEndID = query.dst;


			// preselect comboboxes if exist
			var srcBox = jQuery('#vg_route_from');
			var dstBox = jQuery('#vg_route_to');

			if (srcBox.length == 1 && dstBox.length == 1)
			{
				var srcIndex = jQuery('option[value="'+query.src+'"]', srcBox).index();
				var dstIndex = jQuery('option[value="'+query.dst+'"]', dstBox).index();
				if (srcIndex != -1 && dstIndex != -1)
				{
					var srcBox0 = srcBox[0];
					var dstBox0 = dstBox[0];
		  			srcBox0.selectedIndex = srcIndex;
		  			dstBox0.selectedIndex = dstIndex;

		  			jQuery('#vg_route_from-input').val(jQuery(srcBox0[srcIndex]).val());
		  			jQuery('#vg_route_to-input').val(jQuery(dstBox0[dstIndex]).val());
				}
			}
			// do actual routing.
			if (typeof query.waypoint !== 'undefined')
			{
	  			doRouting(query.src, [query.waypoint, query.dst]);
			}
			else
			{
	  			doRouting(query.src, query.dst);
			}
		}
	}

	// Display shop list.
	var lLoadIDs = true;

	var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};
	var debug_ids_on_error = false;
	// debuglabels
	if (typeof(query.debuglabels) !== 'undefined')
	{
		debug_ids_on_error = true;
		lLoadIDs = false;
	}


	if (lLoadIDs)
	{
		jQuery.ajax(labelsURL, {
			dataType: 'json',
			success: function(data, textStatus, jqXHR) {
				if (data!=null)
				{
					vg_ids = data;
					var shoplist = [];

					var add_spaces = false;
					var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};
					if (typeof(query.addspaces) != 'undefined')
					{
						add_spaces = true;
					}
					var $shopList = jQuery('#vg_shops');
					for (var i in vg_ids.labels)
					{
						var id = vg_ids.labels[i][0];
						var label = vg_ids.labels[i][1];
						var shop = mapviewer.getPlace(id);
						var floornumber = '';
						if (shop !== false)
						{
							floornumber += ' ('+id+'/'+shop.vg.floor+')';
						}
						else
						{
							floornumber += ' ('+id+'+/missing)';
						}

						if (!doNotUseSetPlaceName)
						{
							if (add_spaces)
							{
								// This is only supported in VisioWeb2D.
								label = label.replace(/ /g, '<br>');
							}
							mapviewer.setPlaceName(id, {
								text: label
								// textTextureHeight: 20, // for low memory consomption, only applicable to VisioWeb
								// visibilityRampStartInvisible: 800, // compatible with VisioWeb and VisioWeb2D.
								// visibilityRampFullyInvisible: 1000 // only applicable to VisioWeb
								// for VisioWeb all options used by mapviewer.addPOI are applicable (except .model and .icon)
							});
						}
						shoplist.push('<a href="#" class="shop_link" data-id="', id, '">', label, floornumber, '</a><br/>');
					}
					if ($shopList.length == 1)
					{
						$shopList.append(shoplist.join(''));
					}
					// combo boxes needs to be called after filling vg_ids so it can use the real shop/place name on the menu.
					fill_comboboxes();
				}
				// we do it after filling comboboxes so it can preselect the values
				// test to see if src/dst were passed as parameters
				doRoutingFromURLParameters();
			},
			error: errorLoadIDsFunction
		});
	}
	else
	{
		errorLoadIDsFunction();
	}

	function errorLoadIDsFunction()
	{
		// This is sample code to set the placename to be the same as its id.
		// One can change the style of setPlaceName for (VisioWeb2D only) text via the class .vg-setplacename
		// jQuery('.vg-setplacename').css('font-size', '18px')
		if (debug_ids_on_error && !doNotUseSetPlaceName)
		{
			var places = mapviewer.getAllPlaces();
			for (var placename in places)
			{
				// Use small textTextureHeight if there are many labels (>1000) for low memory speed, and fast setup time.
				mapviewer.setPlaceName(placename, {
					text: placename
					// textTextureHeight: 20, // for low memory consomption, only applicable to VisioWeb
					// visibilityRampStartInvisible: 800, // compatible with VisioWeb and VisioWeb2D.
					// visibilityRampFullyInvisible: 1000 // only applicable to VisioWeb
					// for VisioWeb all options used by mapviewer.addPOI are applicable (except .model and .icon)
				});
			}
		}
		fill_comboboxes();
		// we do it after filling comboboxes so it can preselect the values
		// test to see if src/dst were passed as parameters
		doRoutingFromURLParameters();
	}
}


/*
 * removes currentRoute
 * removes currentNavigation
 * resets start/end route points.
 */
function clearRouting()
{
	// remove current Route
	if (currentRoute != null)
	{
		currentRoute.remove();
		currentRoute = null;
	}
	// hide navigation instructions
	if (useNavigation)
	{
		instructions_overlay_visible = false;
		updateToggleInstructions();
		if (currentNavigation != null)
		{
			currentNavigation.remove();
			currentNavigation = null;
		}
	}


	var srcBox = jQuery('#vg_route_from');
	if (srcBox.length == 1)
	{
		srcBox[0].selectedIndex = -1;
		jQuery('#vg_route_from-input').val('');
	}
	routeStartID = false;

	var dstBox = jQuery('#vg_route_to');
	if (dstBox.length == 1)
	{
		dstBox[0].selectedIndex = -1;
		jQuery('#vg_route_to-input').val('');
	}
	routeEndID = false;
	routeWaypointIDs = [];

	jQuery('#route_clear').hide();
}

function createFloorLabel(target_floor)
{
		var floor_button_id = 'floor_link'+target_floor;

		// var html = '<a href="#" class="change_floor" data-floor="'+target_floor+'" id="'+floor_button_id+'">Floor '+target_floor+'</a> ';
		var html = '<button class="vg_button change_floor" type="button" data-floor="'+target_floor+'" id="'+floor_button_id+'">'+target_floor+'</button> ';
		jQuery('#change_floor').append(html);
		floor_button_ids['floor'+target_floor] = '#'+floor_button_id;
}

function updateActiveFloorLabel(target_floor)
{
	for (var i in floor_button_ids)
	{
		jQuery(floor_button_ids[i]).removeClass('selected');
	}
	jQuery(floor_button_ids['floor'+target_floor]).addClass('selected');
}

function selectShop(shopName)
{
	// console.log("LinkClick "+shop_id);
	var shop = mapviewer.getPlace(shopName);
	resetActiveShop();
	if (shop!==false)
	{
		gotoFloorAndPosition(shop.vg.floor, shop, function() { setActiveShop(shop); });
	}
}

// Tested Windows Phone 10, iOS 9, Android 4.4, for Windows 8 you would need to use MS pointer events.
document.addEventListener('touchstart', checkMoreThanTwoTouches, false);
function checkMoreThanTwoTouches(event)
{
	if (event && event.touches && event.touches.length > 2)
	{
		// update this alert with your own message or framework.
		alert('For best user experience, use only two fingers');
		// Only warn the user once.
		document.removeEventListener('touchstart', checkMoreThanTwoTouches);
	}
}
