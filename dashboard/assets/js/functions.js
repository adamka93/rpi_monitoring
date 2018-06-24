function openTab(evt, cityName) {
	// Declare all variables
	var i, tabcontent, tablinks;

	// Get all elements with class="tabcontent" and hide them
	tabcontent = document.getElementsByClassName("tcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}

	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(cityName).style.display = "block";
	if(evt){
		evt.currentTarget.className += " active";
	}
	//https://github.com/jtblin/angular-chart.js/issues/29
	window.dispatchEvent(new Event('resize'));
}

function gauges() {
	$( ".gauge" ).each(function( index ) {
		var val = $(this).data("value");
		var ceil = $(this).data("ceil");
		var d = 0;

		if (val > ceil) {
			d = 180;
		} else {
			d = Math.round(val*180/ceil);
		}		

		var $elem = $(this).find(".gauge-indicator");
		var $counter = $(this).find(".gauge-cnt");
		var $ceil_indicator = $(this).find(".gauge-ceil");
		$ceil_indicator.text("∞ "+ceil);

		$({deg: -180}).animate({deg: d-180}, {duration: 2000, step: function(now) {
				$elem.css({transform: 'rotate(' + now + 'deg)'});
			}
		});

		$({vis: 0}).animate({vis: val}, {duration: 2000, step: function(vis_now) {				
				$counter.text( Math.round(vis_now));
			}
		});		

	});
} //gauges


function updateDiagram(diagramObj, start, end, dataUrl, index) {
	$.ajax({
		dataType: "json",
		url: dataUrl + "?start=" + start + "&end=" + end,
		success: function(data){
			let toSet;
			if(data[index]["before"].length){
				toSet = [data[index]["before"][0], ...data[index]["data"]];
			} else {
				toSet = [...data[index]["data"]];
			}
			diagramObj.setData(toSet);
		}
	});
}

function initAllPage(url, diagramms){
	var start = $("#datetimepicker6 input").val();
	var end = $("#datetimepicker7 input").val();
	if(start && end){
		//diagramms.forEach(function(k, v){
		for(var index in diagramms) {
			updateDiagram(diagramms[index], start, end, url, index);
		}
	}
}