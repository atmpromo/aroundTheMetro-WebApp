
$(document).ready(function() {
	if ($("#homeview").length <= 0) {
        return;
    }

	var curpagenum = "1";
	var pagecount = 0;
	var searchurl = "https://api.swiftype.com/api/v1/engines/montreal-souterrain/document_types/stores/search.json";
	showMainContent(false);
    
    $("#search").click(function() {
    	showMainContent(true);
    	search(curpagenum);
    });

    $(".previous").click(function() {
    	console.log(curpagenum);
    	if (parseInt(curpagenum) > 1) {
    		search( (parseInt(curpagenum) - 1).toString() );
    	}
    });

    $(".next").click(function() {
    	if (parseInt(curpagenum) < pagecount) {
    		search( (parseInt(curpagenum) + 1).toString() );
    	}
    });

    $("#restocheck").click(function() {
      curpage = 1;
    	search(curpagenum);
    });

    $("#boutiquecheck").click(function() {
      curpage = 1;
    	search(curpagenum);
    });

    $("#beautyhealthcheck").click(function() {
      curpage = 1;
    	search(curpagenum);
    });

    $("#attractioncheck").click(function() {
      curpage = 1;
    	search(curpagenum);
    });

    function showMainContent(isSearch) {
    	//if ($("#keyword").val() != undefined && $("#keyword").val().length != 0) {
    	if (isSearch) {
    		$("#main-content").hide();
    		$("#searchresult").show();
    	} else {
    		$("#main-content").show();
    		$("#searchresult").hide();
    	}
    }

    var curpage = 1;

    function search(pagenum) {
    	curpagenum = pagenum;

    	var types = new Array();
    	if ( $('#restocheck').is(":checked") ) { types.push("Restaurant"); }
    	if ( $('#boutiquecheck').is(":checked") ) { types.push("Boutique"); }
    	if ( $('#beautyhealthcheck').is(":checked") ) { types.push("Beauty & Health"); }
    	if ( $('#attractioncheck').is(":checked") ) { types.push("Attraction"); }

        if (types.length == 0) {
        	$("#datas").empty();
        	$("#pagecontrol").empty();
        	$("#datas").append("<div class=\"title\" style=\"height:100px\"><h3> No results found </h3></div>");
        	$("#pagercomp").hide();
        	return;
        }

        params = {};
        var keyword = $("#keyword").val();
        if (keyword.length > 0) { params['q'] = keyword; }
        params['engine_key'] = "8M4TRfsJrAXiYfkLXQar";
        if (pagenum > 0)
          params['page'] = pagenum;
        else 
          params['page'] = 1;
        params['per_page'] = 9;
        params['filters'] = {'stores' : {'type_en' : types}};

        $.ajax({
            url: 'https://api.swiftype.com/api/v1/public/engines/search.json',
            data: params,
            type: "GET",
            dataType: "jsonp", 
        }).success(function(data) {
            $("#datas").empty();
            $("#pagecontrol").empty();
            if (data.records.stores.length == 0) {
              $("#datas").append("<div class=\"title\" style=\"height:100px\"><h3> No results found </h3></div>");
              $("#pagercomp").hide();
            } else {
              $("#pagercomp").show();
              pagecount = data.info.stores.num_pages;
              curpage = data.info.stores.current_page;
              var i;
              var pagelimit = 5, midpos = Math.ceil(pagelimit/2);
              var startindex = 1, endindex = pagelimit;
              if (pagecount <= pagelimit) {
                startindex = 1;
                endindex = pagecount;
              } else if (curpage <= midpos) {
                startindex = 1;
                endindex = pagelimit;
              } else {
                if (curpage > pagecount-(pagelimit-midpos)) {
                  endindex = pagecount;                  
                } else {
                  endindex = curpage + (pagelimit - midpos);
                }
                startindex = endindex - pagelimit + 1;
              } 
              for (i=startindex; i<=endindex; i++) {
                var page = "";
                if (i == curpage) {
                  page = "<li id=\"pagebtn" + i +"\" class=\"active\"><a>" + i + "</a></li>";
                } else {
                  page = "<li id=\"pagebtn" + i +"\"><a>" + i + "</a></li>";
                }
                
                $("#pagecontrol").append(page);
                $("#pagebtn"+i).on('click', function() {
                  var pageselected = (this).id.replace("pagebtn", "");
                  curpagenum = pageselected;
                  search(pageselected);
                });
              }

              for (i=0; i<data.records.stores.length; i++) {
                var template = "";
                template = template + "<div class=\"col-md-4 col-sm-6 col-xs-12 grid-item\">";
                template = template + "   <div class=\"grid-item-inner\">";
                template = template + "     <div class=\"grid-img-thumb\">";
                if (data.records.stores[i].featured == '1') {
                  template = template + "        <div class=\"ribbon\"><span>Featured</span></div>";
                }
                template = template + "  <a href=\"" + $("#prefix").html() + "/" + data.records.stores[i].external_id + "\"><img src=\"" + data.records.stores[i].coverphotourl + "\" alt=\"1\" class=\"img-responsive\" /></a>";
                template = template + "        </div>";
                template = template + "        <div class=\"grid-content\">";
                template = template + "          <div class=\"grid-text\">";
                template = template + "            <div class=\"place-name\">" + data.records.stores[i].name + "</div>";
                template = template + "            <div class=\"travel-times\">";
                template = template + "              <h4 class=\"pull-left\">" + data.records.stores[i].type_en + "</h4>";
                template = template + "                <span class=\"pull-right\">";
                template = template + "                  <i class=\"fa fa-star\"></i>";
                template = template + "                  <i class=\"fa fa-star\"></i>";
                template = template + "                  <i class=\"fa fa-star\"></i>";
                template = template + "                  <i class=\"fa fa-star\"></i>";
                template = template + "                  <i class=\"fa fa-star\"></i>";
                template = template + "                </span>";
                template = template + "              </div>";
                template = template + "            </div>";
                template = template + "          </div>";
                template = template + "        </div>";
                template = template + "      </div>";
                template = template + "    </div>";
                template = template + "</div>";

                $("#datas").append(template);
              }
            }
        }).error(function(data) {
          alert("failure");
        });
     }
});




      //   $.post(searchurl, postdata, function(data, status){
      //    if (status == "success") {
      //      $("#datas").empty();
      //      $("#pagecontrol").empty();
      //      if (data.records.stores.length == 0) {
      //        $("#datas").append("<div class=\"title\" style=\"height:100px\"><h3> No results found </h3></div>");
      //        $("#pagercomp").hide();
      //      } else {
      //        $("#pagercomp").show();
      //        pagecount = data.info.stores.num_pages;
      //        var curpage = data.info.stores.current_page;
      //        var i;
      //        for (i=1; i<=pagecount; i++) {
      //          var page = "";
      //          if (i == curpage) {
      //            page = "<li id=\"pagebtn" + i +"\" class=\"active\"><a>" + i + "</a></li>";
      //          } else {
      //            page = "<li id=\"pagebtn" + i +"\"><a>" + i + "</a></li>";
      //          }

      //          $("#pagecontrol").append(page);

      //          $("#pagebtn"+i).on('click', function() {
      //            var pageselected = (this).id.replace("pagebtn", "");
      //            curpagenum = pageselected;
      //            search(pageselected);
      //          });
      //        }
       //       for (i=0; i<data.records.stores.length; i++) {
       //         var template = "";
       //         template = template + "<div class=\"col-md-4 col-sm-6 col-xs-12 grid-item\">";
       //         template = template + "   <div class=\"grid-item-inner\">";
       //         template = template + "     <div class=\"grid-img-thumb\">";
            // template = template + "        <div class=\"ribbon\"><span>Featured</span></div>";
            // template = template 
            // + "  <a href=\"" + $("#prefix").html() + "/" + data.records.stores[i].external_id + "\"><img src=\"" + data.records.stores[i].coverphotourl + "\" alt=\"1\" class=\"img-responsive\" /></a>";
            // template = template + "        </div>";
            // template = template + "        <div class=\"grid-content\">";
            // template = template + "          <div class=\"grid-text\">";
            // template = template + "            <div class=\"place-name\">" + data.records.stores[i].name + "</div>";
            // template = template + "            <div class=\"travel-times\">";
            // template = template + "              <h4 class=\"pull-left\">" + data.records.stores[i].type_en + "</h4>";
            // template = template + "                <span class=\"pull-right\">";
            // template = template + "                  <i class=\"fa fa-star\"></i>";
            // template = template + "                  <i class=\"fa fa-star\"></i>";
      //                   template = template + "                  <i class=\"fa fa-star\"></i>";
      //                   template = template + "                  <i class=\"fa fa-star\"></i>";
            // template = template + "                  <i class=\"fa fa-star\"></i>";
            // template = template + "                </span>";
            // template = template + "              </div>";
            // template = template + "            </div>";
            // template = template + "          </div>";
            // template = template + "        </div>";
            // template = template + "      </div>";
            // template = template + "    </div>";
            // template = template + "</div>";

       //         $("#datas").append(template);
       //       }
      //      }
      //    } else {
      //      $("#datas").append("<div class=\"title\" style=\"height:100px\"><h3> Cannot connect to the server! </h3></div>");
      //    }
      //   });