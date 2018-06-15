<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
	<style>
		body{
			background-color: #EEEEEE;	
		}
		.margin-top-25{
			margin-top:25px;
		}
		.tablinks:hover{
			background-color: #2F3640!important;
		}
		.widget i{
			margin-bottom: 5px;
		}
		.widget{
			height: 74px;
			width: calc( (100% / 5) - 3.3px);
			display: inline-block;
			text-align: center;
			color:#fff;
			padding-top:12.5px;
			font-size: 14px;
			font-weight: lighter;
		}
		.widget.summary{
			background-color: #28b779;
		}
		.widget.list{
			background-color: #27a9e3;
		}
		.widget.chart{
			background-color: #da542e;
		}
		.widget.file{
			background-color: #2255a4;
		}
		.widget.all{
			background-color: #da542e;
		}
		.widgets{
			padding-bottom: 10px;
			border-bottom: solid 1px #ddd;
			margin-bottom: 50px
		}
		.tcontent{
			display:none;
			padding: 0px;
			font-family: 'Open Sans',sans-serif;
		}
		.modal-content{
			box-shadow: none;
			border-radius: 0px;
		}
		.box-header{
			border:solid 1px #cdcdcd;
			height: 36px;
			padding:0px;
			color: #666;
			font-size: 12px;
			line-height: 36px;
			font-weight: bold;
			background-color: #eee;
		}
		.box-header span{
			margin-left:10px;
		}
		.box-header i{
			display: inline;
			padding: 11px 12px;	
			height: 100%;
			/*border-right: solid 1px #cdcdcd;*/
		}
		.box-body{
			border:solid 1px #cdcdcd;
			background-color: #fff;
			padding:30px 15px;
		}
		.outer, .inner{
			padding: 60px 15px 30px 15px;
		}
		.inner{
			margin-bottom: 20px;
			display: flex;
		}
		#area-chart,
		#line-chart,
		#bar-chart,
		#stacked,
		#pie-chart{
			min-height: 250px;
		}

		.gauge {
			margin: 0 auto;
			font-family: Tahoma, Geneva, sans-serif;
			margin: 0 auto 2rem auto;
			height: 100px;
			width: 200px;
			position: relative;
			overflow: hidden;
		}
		.gauge .gauge-indicator {
			z-index: 3;
			position: absolute;
			top: 0;
			right: 0;
			left: 0;
			height: 100px;
			width: 200px;
			border-radius: 200px 200px 0 0;
			transform-origin: bottom center;
			backface-visibility: hidden;
			transform: rotate(-180deg);
		}
		.gauge .gauge-background {
			z-index: 2;
			position: absolute;
			top: 0;
			right: 0;
			left: 0;
			height: 100px;
			width: 200px;
			border-radius: 200px 200px 0 0;
			box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.2);
			background: #eeeeee;
		}
		.gauge .gauge-center {
			z-index: 4;
			position: absolute;
			bottom: 0;
			right: 20px;
			left: 20px;
			height: 80px;
			width: 160px;
			border-radius: 160px 160px 0 0;
			background: #ffffff;
		}
		.gauge .gauge-value {
			z-index: 5;
			position: absolute;
			bottom: 0;
			right: 0;
			left: 0;
			text-align: center;
			line-height: .8rem;
			font-size: .8rem;
		}
		.gauge .gauge-value span.gauge-cnt {
			display: block;
			font-size: 1.7rem;
			line-height: 2.1rem;
			font-style: italic;
		}
		.gauge .gauge-value span.gauge-ceil {
			display: block;
			color: #999999;
		}
		.gauge.red .gauge-indicator {
			background: #DC3546;
		}
		.gauge.green .gauge-indicator {
			background: green;
		}
		.gauge.orange .gauge-indicator {
			background: orange;
		}


		@keyframes slidein {
			from {
			transform: rotate(-180deg);
			}
			to {
			transform: rotate(-58deg);
			}
		}
		.to_center{
			margin: 0 auto;
		}
	</style>
</head>
<body>
<div class="container-fluid col-sm-8 col-sm-offset-2 margin-top-25" >
	<div class="widgets row">
		<div class="widget summary tablinks" onclick="openTab(event, 'summary')">
			<i class="fa fa-inbox fa-2x" aria-hidden="true"></i> <br>
			Summary
		</div>
		<div class="widget list tablinks" onclick="openTab(event, 'cpu')">
			<i class="fas fa-microchip fa-2x" aria-hidden="true"></i> <br>
			CPU
		</div>
		<div class="widget chart tablinks" onclick="openTab(event, 'memory')">
			<i class="fas fa-memory fa-2x" aria-hidden="true"></i> <br>
			Memory
		</div>
		<div class="widget chart tablinks" onclick="openTab(event, 'storage')">
			<i class="fas fa-hdd fa-2x" aria-hidden="true"></i> <br>
			Storage
		</div>
		<div class="widget all tablinks" onclick="openTab(event, 'all')">
			<i class="fa fa-th-large fa-2x" aria-hidden="true"></i> <br>
			All
		</div>
	</div>

	<div id="summary" class="tcontent row" style="display:block">
		<div class="col-sm-12 box-header">
			<i class="fa fa-inbox " aria-hidden="true"></i>
			<span>Summary</span>
		</div>
		<div class="box-body outer">
			<div class="col-sm-12 box-header">
				<span>CPU usage by cores <i>-<?php echo $last_cpu[0]["measure_date"]; ?></i></span>
			</div>
			<div class="box-body inner">
				<div class="row to_center">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<?php
							$data = array();
							$data["data"] = $last_cpu[0]["cpu0"];
							$data["text"] = "CPU 0";
						?>
						<?php $this->view('gauge', $data); ?>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<?php
							$data = array();
							$data["data"] = $last_cpu[0]["cpu1"];
							$data["text"] = "CPU 1";
						?>
						<?php $this->view('gauge', $data); ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<?php
							$data = array();
							$data["data"] = $last_cpu[0]["cpu2"];
							$data["text"] = "CPU 2";
						?>
						<?php $this->view('gauge', $data); ?>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
						<?php
							$data = array();
							$data["data"] = $last_cpu[0]["cpu3"];
							$data["text"] = "CPU 3";
						?>
						<?php $this->view('gauge', $data); ?>
					</div>
				 </div>
			</div>
			<div class="col-sm-12 box-header">
				<span>Summary</span>
			</div>
			<div class="box-body inner">
				<div id="area-chart" ></div>
			</div>
		</div>
	</div>

	<div id="cpu" class="tcontent row">
		<div class="col-sm-12 box-header">
			<i class="fa fa-list " aria-hidden="true"></i>
			<span>CPU</span>
		</div>
		<div class="box-body outer">
			<img src="nothing-to-see-here-gif-1.gif">
		</div>
	</div>

	<div id="memory" class="tcontent row">
		<div class="col-sm-12 box-header">
			<i class="fa fa-signal " aria-hidden="true"></i>
			<span>MEMORY</span>
		</div>
		<div class="box-body outer">
			<img src="nothing-to-see-here-gif-1.gif">
		</div>
	</div>

	<div id="storage" class="tcontent row">
		<div class="col-sm-12 box-header">
			<i class="fa fa-file-o " aria-hidden="true"></i>
			<span>STORAGE</span>
		</div>
		<div class="box-body outer">
			<img src="nothing-to-see-here-gif-1.gif">
		</div>
	</div>

	<div id="all" class="tcontent row">
		<div class="col-sm-12 box-header">
			<i class="fa fa-th-large " aria-hidden="true"></i>
			<span>ALL</span>
		</div>
		<div class="box-body outer">
			<img src="nothing-to-see-here-gif-1.gif">
		</div>
	</div>

</div>
<script >
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
	evt.currentTarget.className += " active";
} 
</script>
<script>
	var data = <?php echo $temps; ?>,
	config = {
		data: data,
		xkey: 'measure_date',
		ykeys: ['cpu_temp'],
		labels: ['CPU temperature'],
		fillOpacity: 0.6,
		hideHover: 'auto',
		behaveLikeLine: true,
		resize: true,
		pointFillColors:['#ffffff'],
		pointStrokeColors: ['black'],
		lineColors:['red','red']
	};
	config.element = 'area-chart';
	Morris.Area(config);
</script>
<script>
	$( document ).ready(function() {
		gauges();
	}); // END Document Ready

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
</script>
</body>
</html>
<?php 
	//print_r($last_temp);
	//print_r($last_cpu);
	//print_r($last_memory);
	//print_r($last_disc);
?>