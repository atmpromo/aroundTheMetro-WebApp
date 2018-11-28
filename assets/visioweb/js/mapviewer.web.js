/* eslint-disable max-len, brace-style, no-mixed-spaces-and-tabs, comma-dangle, no-var, guard-for-in, new-cap, camelcase, require-jsdoc */
/*
	mapviewer sample.
*/

var mapviewer;

var bundleName = 'visioglobe_island_web';

// The labels URL is local
var labelsURL = '../data.bundles/'+bundleName+'/ids.json';

// VisioIsland mapHash (available since 1.7.15)
// var mapHash = 'k89a486ab0c1842a7d247febebfe67af625fda483';
// var mapServerURL = 'https://mapserver.visioglobe.com/';
// var mapDescriptorName = '/descriptor.json';
// var mapURL = mapServerURL + mapHash + mapDescriptorName;
// uncomment the four lines above, and comment the mapURL below

// Uses new descriptor.json for more robustness (checks sdk comptability)
// For the multibuilding example, this value is set in mapviewer.web.multibuilding.html
var mapURL = mapURL || '../data.bundles/'+bundleName+'/descriptor.json';

// You could use the direct URL at your own risk if you are absolutely certain about versions
// it sames one RTT, but it will be less robust if the map is misconfigured.
// var mapURL =  '../data.bundles/'+bundleName+'/map.json';

// passes this paramter to mapviewer.initialize to select the initial floor.
var initialFloorName = '';

// activate the turn by turn navigation if available
var useNavigation = true;

// On IE10 and IE11, mapviewer.setPlaceName can take a very long time.
// with parsimony
var doNotUseSetPlaceName = false;

var changeFloorAnimationDuration = 500; // change floor animation duration in ms.
// var changeFloorAnimationDuration = 0; // test immediate change
var sample_poi; // reference to one of the sample_poi, you can do sample_poi.hide()/show()

// Shops that are currently highlighted.
var highlighted_shop = null;
var active_shop = null;
var floor_button_ids = {};
var statusbar_timeout = null;
var place_poi;

var use_mouseover = false;

// For IE10 and IE11 we do not use setPlaceName (or use it very little)
// Using Trident/7.0 user agent to detect IE11
// if (navigator && navigator.userAgent && (
// 			navigator.userAgent.indexOf('Trident/7.0') != -1 ||
// 			navigator.userAgent.indexOf('MSIE 9') != -1 ||
// 			navigator.userAgent.indexOf('MSIE 10') != -1))
// {
// 	doNotUseSetPlaceName = true;
// }

/*
 * Customizes how the map looks at the beginning.
 */
function setupInitialPosition()
{
	// Shops that are highlighted at the start/load of the page.
	// this value could come from an external parameter. (used to be 114)
	setActiveShop(mapviewer.getPlace('UL0-ID0014'));

    mapviewer.camera.maxPitch = -6;
    // if you wanted to start on another floor, do it here or pass parameter initialFloor to mapviewer.initialize()
    // mapviewer.camera.rotation = 10;
    // mapviewer.camera.pitch = -48;
    // mapviewer.camera.goTo({x: 16, y: 20, radius: 100},{animationDuration: 100});
    // updateActiveFloorLabel('1');

    // add POI on another floor (used to be 161)
    /* var p = mapviewer.getPlace('UL1-ID0064');
    if (p)
    {
    	// we dont modify directly p.vg.position
    	// or do NOT do sample_pos = p.vg.position; sample_pos.z = 10, since javascript copies the reference.
    	var sample_poi_position = { x: p.vg.position.x, y: p.vg.position.y, z: 3};
	    sample_poi = mapviewer.addPOI({selector: '#test', floor: p.vg.floor, position: sample_poi_position});
    }*/

	// Top left corner of shop 161. {lat: 48.78295439400996, lon: 2.222107906181293}
	// Top left corner of Museum {lat: 45.74230960774532, lon: 4.884392885060976}
	/*
	var pos = mapviewer.convertLatLonToPoint( {lat: 45.74230960774532, lon: 4.884392885060976} );
	mapviewer.addPOI({selector: '#testNE', floor: '0', position: pos, alignment: {x:1,y:1}});
	mapviewer.addPOI({selector: '#testSE', floor: '0', position: pos, alignment: {x:1,y:-1}});
	mapviewer.addPOI({selector: '#testSW', floor: '0', position: pos, alignment: {x:-1,y:-1}});
	mapviewer.addPOI({selector: '#testNW', floor: '0', position: pos, alignment: {x:-1,y:1}});
	mapviewer.addPOI({selector: '#testMiddleTop', floor: '0', position: pos, alignment: {x:0,y:1}});*/

    // example of setPlaceIcon
    // mapviewer.setPlaceIcon('UL0-ID0077','../media/test.png',{width: '64px',height: '64px'});

    /* VisioWeb2D (not VisioWeb, this note is in the case you use BOTH SDKs) maps initial radius shows the whole map on 256x256 pixels of the map view.
       to make it more responsive, we normalize by the current map view size
    var mapViewSizeFactor = Math.min(jQuery('#container').width(), jQuery('#container').height()) / 256.0;
    var pos = mapviewer.camera.position;
    pos.radius = pos.radius / mapViewSizeFactor;
    mapviewer.camera.position = pos;
    */
    // to set specific camera start position (you can control intitial floor via variable initialFloorName)
    // var pos = mapviewer.convertLatLonToPoint( {lat: 48.78295439400996, lon: 2.222107906181293});
	// pos.radius = 1000;
    // mapviewer.camera.position = pos;

    // Footprints can be used for many purposes:
    // determining what region is point is on
    // highlighting a non-physical place
    // there is also mapviewer.getPoint as well...
    // You could choose to set your start position such that a given portion of the map is visible
    // or at a exact point.  The advantage of the former, is that it will work on any screen size and
    // aspect ratio.
    /*
    var footprint = mapviewer.getFootprint('vg-start-position');
    if (footprint)
    {
	    jQuery.each(footprint.points,function(i,e) { e.z = 0});
	    var footprintPath = mapviewer.addRoutingPath({points: footprint.points,color: 0xff0000});

	    var viewpoint = mapviewer.getViewpointFromPositions({points: footprint.points});
	    mapviewer.camera.position = viewpoint;
    }
    var startPositionPoint = mapviewer.getPoint('vg-start-position');
    if (startPositionPoint)
    {
    	var cameraStartPosition = {x: startPositionPoint.x, y: startPositionPoint.y, radius: 500};
   		mapviewer.addPOI({url: '../media/test.png',
   			scale: 8,
   			floor: '0',
   			position: cameraStartPosition,
   			alignment: {x:0,y:1},
   			overlay: false
   		});
    	//mapviewer.camera.position = cameraStartPosition;
    }
    */
}

// code here moved to mapviewer.common.js

function onObjectMouseUp(event, element)
{
	// On VisioKiosk (now named VisioWeb) 1.7.17, the events were cleaned up.  You only receive ONE event per mouse up
	// with a Place or POI for the closest overlay object, if none, the closest object.

	// it is not guaranteed for element to have .vg, it could be an icon or poi...
	if (element.vg && typeof(element.vg.id)!=='undefined')
	{
		jQuery('#vg_search-input').val(element.vg.id);
	}
	// console.log('*** ObjectUp on '+element.vg.id);

	// we don't need to potentially call change floor as we are guaranteed to be on the same floor
	openPlaceBubble(element);
	setActiveShop(element);

	// mapviewer.camera.goTo(element);


	// conserve altitude
	// var target_position = {
	//	x: element.vg.position.x,
	//	y: element.vg.position.y,
	//	radius: mapviewer.camera.position.radius
	// };
	// mapviewer.camera.goTo(target_position);
}

/*
 * Go to that shop.  change floor if needed
 */

function gotoFloorAndPosition(floorname, position, postFunction)
{
	var gotoFunction = function()
	{
		mapviewer.camera.goTo(position, {animationDuration: 500}).done(function()
			{
				if (typeof(postFunction) === 'function')
				{
					postFunction();
				}
			});
	};

	if (mapviewer.getCurrentFloor() == floorname)
	{
		gotoFunction();
	}
	else
	{
		mapviewer.changeFloor(floorname, {animationDuration: changeFloorAnimationDuration}).done(gotoFunction());
	}
}

// Check if WebGL is supported, if so, load and display map.
if (isWebGLSupported())
{
	jQuery(document).ready(function() {
		if (typeof(vg) == 'undefined')
		{
			console.log('ERROR: Missing VisioWeb SDK...probably missing script file vg.mapviewer.web.js or not loaded yet');
			return;
		}

		if ((navigator.platform.indexOf('iPhone') != -1) ||
				(navigator.platform.indexOf('iPad') != -1) ||
				(navigator.platform.indexOf('iPod') != -1) ||
				(navigator.userAgent.indexOf('ndroid') != -1))
		{
			// to prevent rubberband scrolling on mobile safari.
			document.body.addEventListener('touchmove', function(event) {
				// FIXME: change shop_list with name of all comboboxes
				if (event.target != jQuery('#shop_list')[0])
				{
					event.preventDefault();
				}
			}, false);
		}

		if (jQuery().combobox !== undefined)
 		{
			jQuery('.combobox').combobox();
		}

		// prepare progress bar
 		if (jQuery().knob !== undefined)
 		{
	 		jQuery('.knob').knob();
			// fgColor bar as it fills up, bgColor, bar, inputColor: color of text (number)
			// jQuery('.knob').trigger('configure',{fgColor: '#ff0000', bgColor: '#00ff00', inputColor: '#0000ff'});
 		}

		var map = mapURL;
		var query = (jQuery.deparam && jQuery.deparam.querystring()) || {};
		if (query.bundle)
		{
			// map =  '../data.bundles/'+query.bundle+'/map.svg';
			map = '../data.bundles/'+query.bundle+'/map.json';
		}
		else if (query.url)
		{
			map = query.url;
			map = map.replace('https:', '');
			map = map.replace('http:', '');
		}
		else if (query.hash)
		{
			map = 'https://mapserver.visioglobe.com/'+query.hash+'/descriptor.json';
		}

		// Allows to pass labelsURL as a URL parameter &ids=/../ids.json for testing.
		if (query.ids)
		{
			labelsURL = query.ids;
		}
		if (typeof(query.mouseover) !== 'undefined')
		{
			use_mouseover = true;
		}

		if (typeof(query.initialfloor) != 'undefined')
		{
			initialFloorName = query.initialfloor;
		}

		mapviewer = new vg.mapviewer.Mapviewer();


		// Add handler to update floor button
		// available since VisioKiosk (now named VisioWeb) 1.7.14
		mapviewer.on('floorChanged', function(ev) {
			var targetFloorName = ev.args.target;
			updateActiveFloorLabel(targetFloorName);
		});

		var mapviewer_parameters = {
			logoPosition: 'TOP_RIGHT',
			path: map,
			antialias: query.antialias,
			initialFloorName: initialFloorName,
			onObjectMouseUp: onObjectMouseUp
		};

		// set use_mouseover to have the status bar on mouseover
		// the VisioWeb mapviewer will have higher performance without mouseover
		if (use_mouseover)
		{
			mapviewer_parameters.onObjectMouseOver = onObjectMouseOver;
			mapviewer_parameters.onObjectMouseOut = onObjectMouseOut;
		}

		/*
		 * On WP 8.1 OS version 8.10.12393.890 does not display map.
		 * it works in more recent versions. (#6877)
		 * If you ever encounter this problem comment the line below
		 * The application of this patch does not affect other browsers
		 */
		// mapviewer_parameters.bugWP81 = true;

		/*
		* The load time for old map.svg maps is long due to certain load time computations.
		* setting parameters.optimizations = {load1: true} can speed up the load time at the expense of some POIs not being at correct altitude
		* for a very large map it can make a big difference in load time.
		* even better is to ask your account manager to update your map output to 1.7.14 (it will download a map.json instead of map.svg file)
		*/
		// mapviewer_parameters.optimizations = {load1: true};

        var isLoading = false;
        var loaded = false;
        var animationOffset;
        var animationValue;
        mapviewer.initialize(jQuery('#container')[0], mapviewer_parameters)
		.done(function() {
                loaded = true;
				onCommonLoadCompleted();

				// Hook into multifloor sample if it exists.
				if (typeof(setupMultifloor) == 'function')
				{
					setupMultifloor(mapURL);
				}
				if (typeof(MyMultiBuildingView) !== 'undefined' && typeof(MyMultiBuildingView.setupMultiBuilding) == 'function')
		        {
		            MyMultiBuildingView.setupMultiBuilding(mapviewer);
		        }
            })
		.fail(function(result)
		{
			loaded = true;
            var message = 'Unknown map initialize error';
			if (typeof(result)!=='undefined' && typeof(result.message)!=='undefined')
			{
				message = 'Map initialize error: ' + result.message;
			}
			alert(message);
		}) // chaining
		.progress(function(percentage)
		{
			jQuery('#progress').show();
			if (percentage===false)
            {
                // @todo Enable animation when loading (and disable them once loading is achieved).
                /* jQuery('#progress input.knob').val(20).trigger('change');
                var animateOffset = function() {
                    if (loaded)
                    {
                        return;
                    }
                    //console.log('animateOffset');
                    animationOffset = jQuery({angleOffset: 0}).animate({angleOffset: 360}, {
                        duration: 1000,
                        easing: 'linear',
                        step: function(now, fx) {
                            jQuery('#progress input.knob').trigger('configure', {'angleOffset': now});
                        },
                        complete: function() {
                            //console.log('complete');
                            animateOffset();
                        }
                    });
                };
                var animateValue = function(forward) {
                    if (loaded)
                    {
                        return;
                    }
                    //console.log('animateValue');
                    var start = {};
                    var end = {};
                    var startValue = 20;
                    var endValue = 80;
                    if (forward)
                    {
                        start.val = startValue;
                        end.val = endValue;
                    }
                    else
                    {
                        start.val = endValue;
                        end.val = startValue;
                    }
                    animationValue = jQuery(start).animate(end, {
                        duration: 1000,
                        easing: 'swing',
                        step: function(now, fx) {
                            //console.log('animate.progress', arguments);
                            jQuery('#progress input.knob').val(now).trigger('change');
                        },
                        complete: function() {
                            //console.log('complete');
                            animateValue(!forward);
                        }
                    });
                };
                if (!isLoading)
                {
                    //jQuery('#progress input.knob').trigger('configure', {'displayInput': false});
                    //jQuery('#progress input.knob').hide();
                    animateOffset();
                    animateValue(true);
                    isLoading = true;
                }/**/
            }
            else
            {
                if (animationValue || animationOffset)
                {
                    // jQuery('#progress input.knob').show();
                    // jQuery('#progress input.knob').trigger('configure', {'displayInput': true});
                    jQuery('#progress input.knob').trigger('configure', {'angleOffset': 0});
                }
                if (animationValue)
                {
                    animationValue.stop();
                    animationValue = undefined;
                }
                if (animationOffset)
                {
                    animationOffset.stop();
                    animationOffset = undefined;
                }
                var percent_text = (percentage * 100).toFixed(2);
                jQuery('#progress input.knob').val(percent_text).trigger('change');
            }
		});
	});
}
else
{
	alert('Your browser does not have WebGL support, update or try another browser, no map will be loaded or displayed');
}

// We could use isWebGLSupported to know if we can use VisioWeb.
function isWebGLSupported()
{
	var result = false;
	if (window.WebGLRenderingContext)
	{
		var cvsEl;
		var ctx;
	    cvsEl = document.createElement('canvas');
	    ctx = cvsEl.getContext('webgl') || cvsEl.getContext('experimental-webgl');

	    if (ctx) {
	    	result = true;
	        // This makes sure the Browser supports WebGL and that it can create the WebGL context
	    }
	}
	return result;
}
