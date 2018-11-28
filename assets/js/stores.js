
$(document).ready(function() {
    if ($("#storesview").length <= 0) {
        return;
    }

    var curpagenum = "1";
    var pagecount = 0;
    var searchurl = "https://api.swiftype.com/api/v1/engines/montreal-souterrain/document_types/stores/search.json";
    var mallcnt = parseInt( $('#mallcnt').html() );
    var metrocnt = parseInt( $('#metrocnt').html() );

    var i;
    for (i=1; i<=mallcnt; i++) {
        $('#mall'+i.toString()).click(function() {
            search(curpagenum);
        });
    }

    for (i=1; i<=metrocnt; i++) {
        $('#metro'+i.toString()).click(function() {
            search(curpagenum);
        });
    }

	search(1);
    
    $("#search").click(function() {
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

    $("#keyword").keyup(function() {
        search(curpagenum);
    });
    
    function search(pagenum) {
    	curpagenum = pagenum;
        var mallcnt = parseInt( $('#mallcnt').html() );
        var malls = new Array();
        var i;
        for (i=1; i<=mallcnt; i++) {
            if ( $('#mall'+i.toString()).is(":checked") ) {
                malls.push( $('#mall'+i.toString()).val() );
            }
        }

        var metrocnt = parseInt( $('#metrocnt').html() );
        var metros = new Array();
        var i;
        for (i=1; i<=metrocnt; i++) {
            if ( $('#metro'+i.toString()).is(":checked") ) {
                metros.push( $('#metro'+i.toString()).val() );
            }
        }

        if (malls.length == 0 || metros.length == 0) {
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
        params['per_page'] = 15;

        var typestr = $('#title').html();
        typestr = typestr.substring(0, typestr.length-2).trim();
        typestr = typestr.replace("&amp;", "&");
        params.filters = { stores : {mallname_en : malls, metroname_en : metros, type_en : typestr} };
        
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
    			var curpage = data.info.stores.current_page;
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
        			template = template + "		<div class=\"grid-item-inner\">";
        			template = template + "			<div class=\"grid-img-thumb\">";
                    if (data.records.stores[i].featured == '1') {
					   template = template + "				<div class=\"ribbon\"><span>Featured</span></div>";
                    }
					template = template + "	<a href=\"" + $("#prefix").html() + "/" + data.records.stores[i].external_id + "\"><img src=\"" + data.records.stores[i].coverphotourl + "\" alt=\"1\" class=\"img-responsive\" /></a>";
					template = template + "				</div>";
					template = template + "				<div class=\"grid-content\">";
					template = template + "					<div class=\"grid-text\">";
					template = template + "						<div class=\"place-name\">" + data.records.stores[i].name + "</div>";
					template = template + "						<div class=\"travel-times\">";
					template = template + "							<h4 class=\"pull-left\">" + data.records.stores[i].type_en + "</h4>";
					template = template + "								<span class=\"pull-right\">";
					template = template + "									<i class=\"fa fa-star\"></i>";
					template = template + "									<i class=\"fa fa-star\"></i>";
                    template = template + "									<i class=\"fa fa-star\"></i>";
                    template = template + "									<i class=\"fa fa-star\"></i>";
					template = template + "									<i class=\"fa fa-star\"></i>";
					template = template + "								</span>";
					template = template + "							</div>";
					template = template + "						</div>";
					template = template + "					</div>";
					template = template + "				</div>";
					template = template + "			</div>";
					template = template + "		</div>";
					template = template + "</div>";

        			$("#datas").append(template);
        		}
    		}
        }).error(function(data) {
            $("#datas").append("<div class=\"title\" style=\"height:100px\"><h3> Cannot connect to the server! </h3></div>");
        });
    }
});