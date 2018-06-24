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
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-datetimepicker-standalone.css" />
	<link rel="stylesheet" href="<?php echo asset_url(); ?>css/common.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/moment.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/functions.js"></script>
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
					<div class="row to_center">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<?php
								$data = array();
								$data["data"] = $last_temp[0]["temp"];
								$data["text"] = "CPU Temp";
							?>
							<?php $this->view('gauge', $data); ?>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<?php
								$data = array();
								$data["data"] = $last_memory[0]["memory"];
								$data["text"] = "Memory usage";
							?>
							<?php $this->view('gauge', $data); ?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<?php
								$data = array();
								$data["data"] = $last_disc[0]["disk"];
								$data["text"] = "Disc usage";
							?>
							<?php $this->view('gauge', $data); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="cpu" class="tcontent row">
			<div class="col-sm-12 box-header">
				<i class="fa fa-list " aria-hidden="true"></i>
				<span>CPU</span>
			</div>
			<div class="box-body outer">
				<img src="<?php echo asset_url(); ?>img/nothing-to-see-here-gif-1.gif">
			</div>
		</div>

		<div id="memory" class="tcontent row">
			<div class="col-sm-12 box-header">
				<i class="fa fa-signal " aria-hidden="true"></i>
				<span>MEMORY</span>
			</div>
			<div class="box-body outer">
				<img src="<?php echo asset_url(); ?>img/nothing-to-see-here-gif-1.gif">
			</div>
		</div>

		<div id="storage" class="tcontent row">
			<div class="col-sm-12 box-header">
				<i class="fa fa-file-o " aria-hidden="true"></i>
				<span>STORAGE</span>
			</div>
			<div class="box-body outer">
				<img src="<?php echo asset_url(); ?>img/nothing-to-see-here-gif-1.gif">
			</div>
		</div>
		<div id="all" class="tcontent row" style="display:block">
			<div class="col-sm-12 box-header">
				<i class="fa fa-inbox " aria-hidden="true"></i>
				<span>All hardware in time</span>
			</div>
			<div class="box-body outer">
				<div class="col-sm-12 box-header">
					<span>Select intervall</span>
				</div>
				<div class="box-body inner">
					<div class="row to_center">
						<div class="">
							<div class='col-md-5'>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker6'>
										<input type='text' class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class='col-md-5'>
								<div class="form-group">
									<div class='input-group date' id='datetimepicker7'>
										<input type='text' class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</div>
					 </div>
				</div>
				<div class="col-sm-12 box-header">
					<span>CPU usage by cores</span>
				</div>
				<div class="box-body inner">
					<div class="row to_center">
						<div id="area-line" ></div>
					</div>
				</div>
				<div class="col-sm-12 box-header">
					<span>CPU temp.</span>
				</div>
				<div class="box-body inner">
					<div class="row to_center">
						<div id="area-chart" ></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var morrisCPUtemp;
		var morrisCPUUsage;
		var morrisDiskUsage;
		var morrisMemoryUsage;

		var data = <?php echo $temps; ?>;
		config = {
			data: data,
			xkey: 'measure_date',
			ykeys: ['temp'],
			labels: ['CPU temperature'],
			fillOpacity: 0.6,
			hideHover: 'auto',
			behaveLikeLine: true,
			resize: true,
			pointFillColors:['#ffffff'],
			pointStrokeColors: ['black'],
			lineColors:['red','red'],
			pointSize: 0,
			smooth: true
		};
		config.element = 'area-chart';
		morrisCPUtemp = Morris.Area(config);

		LineConfig = {
			data: [{
					"measure_date": "2000-01-01 12:00:00",
					"cpu0": '0',
					"cpu1": '0',
					"cpu2": '0',
					"cpu3": '0'
				},
				{
					"measure_date": "2000-01-02 12:00:00",
					"cpu0": '0',
					"cpu1": '0',
					"cpu2": '0',
					"cpu3": '0'
				}],
			xkey: 'measure_date',
			ykeys: ['cpu0', 'cpu1', 'cpu2', 'cpu3'],
			labels: ['CPU0', 'CPU1', 'CPU2', 'CPU3'],
			fillOpacity: 1,
			hideHover: 'auto',
			behaveLikeLine: true,
			resize: true,
			pointFillColors:['#ffffff'],
			pointStrokeColors: ['black'],
			lineColors:['red','blue', 'green', 'orange'],
			pointSize: 0,
			smooth: true
		};
		LineConfig.element = 'area-line';
		morrisCPUUsage = Morris.Line(LineConfig);
	</script>
	<script type="text/javascript">
		$(function () {
			gauges();
			
			var diagramms = {
				"cpu" :morrisCPUtemp,
				"cpuu" : morrisCPUUsage,
				/*"hdd" : morrisDiskUsage,
				"ram" : morrisMemoryUsage,*/
			};

			var today = new Date();
			var last_week = new Date();
			last_week.setDate(last_week.getDate() - 7);

			$('#datetimepicker6').datetimepicker({
				defaultDate: moment(last_week).format("YYYY-MM-DD HH:mm:ss"),
				format: 'YYYY-MM-DD H:mm:ss'
			});
			$('#datetimepicker7').datetimepicker({
				defaultDate: moment(today).format("YYYY-MM-DD HH:mm:ss"),
				format: 'YYYY-MM-DD H:mm:ss',
				useCurrent: false //Important! See issue #1075
			});
			$("#datetimepicker6").on("dp.change", function (e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
				if(e.date){
					var start = $("#datetimepicker6 input").val();
					var end = $("#datetimepicker7 input").val();
					if(end){
						var url = '<?php echo base_url("welcome/allPage");?>';
						for(var index in diagramms) {
							updateDiagram(diagramms[index], start, end, url, index);
						}
						//updateDiagram(morrisCPUtemp, start, end, url, "cpu");
					}
				}
			});
			$("#datetimepicker7").on("dp.change", function (e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
				if(e.date){
					var start = $("#datetimepicker6 input").val();
					var end = $("#datetimepicker7 input").val();
					if(start){
						var url = '<?php echo base_url("welcome/allPage");?>';
						for(var index in diagramms) {
							updateDiagram(diagramms[index], start, end, url, index);
						}
						//updateDiagram(morrisCPUtemp, start, end, url, "cpu");
					}
				}
			});
			initAllPage('<?php echo base_url("welcome/allPage");?>', diagramms);
			openTab(null, "summary");
		});

	</script>
</body>
</html>
