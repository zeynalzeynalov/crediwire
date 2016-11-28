<script>
	// Load the Visualization API and the piechart package.
	google.charts.load('current', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);

	function drawChart()
	{
		var jsonData = $.ajax({
		url: "restfulapi/getjson.php/getTotalProjectDurations/index.php",
		dataType: "json",
		async: false
		}).responseText;

		// Create our data table out of JSON data loaded from server.
		var data = new google.visualization.DataTable(jsonData);

		var options = {
		  title: 'Project execution summary %',
		  is3D: true,
		  width: 360,
		  height: 250
		};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">New project</h4>
			</div>
			<form>    
				<div class="modal-body">

					<div class="form-group">
					<label for="tb-project-title" class="control-label">Project title:</label>
					<input type="text" class="form-control" id="tb-project-title">
					</div>

				</div>
				
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

				<input class="btn btn-success" type="button" id="btnAddProject" data-dismiss="modal" value="Save project" onclick="processAjaxRequestAddNewProject(document.getElementById('tb-project-title').value)">

				</div>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="panel-group">

		<div class="alert alert-info" role="alert" id="message-alert-box">
			<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<span id="save-result">Hey Bob! Let's start coding!</span>
		</div>

		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+ New Project</button>
		
		<br>
		<br>
		

		<div id="chart_div" style="width: 360px; height: 250px;"></div>

		
		<br>

		<?php foreach ($projects as $project): ?>

			<div class="panel panel-primary">
			<div class="panel-heading">
			<h3 class="panel-title">Project Name: <?= $project->project_title ?></h3>
			</div>
			<div class="panel-body">

			Project created on: <?= $project->project_created_date ?>
			<br>

			Total spent time: <span id="ajaxResponseTotalProjectTimeContainer<?= $project->project_id ?>"><?= $project->total_time_diff_text ?></span>
			<br>
			<input class="<?= $project->getButtonStringCssClassForProjectState() ?>" type="button" id="btnAjax_<?= $project->project_id ?>" value="<?= $project->getButtonStringForProjectState() ?>" onclick="processAjaxRequest(this.id)">

			<br />
			<br />
			<a class="btn btn-default btn-sm" role="button" data-toggle="collapse" href="#collapseExample_<?= $project->project_id ?>" aria-expanded="true" aria-controls="collapseExample">
			Show / hide time record details
			</a>

			<div class="collapse" id="collapseExample_<?= $project->project_id ?>">
			<div class="well">
				<p>
				<span id="ajaxResponseContainer<?= $project->project_id ?>">

				<?php foreach ($project->project_execution_record as $timeRecord): ?>

				<span><?= $timeRecord->starting_time_stamp ?> - <?= $timeRecord->ending_time_stamp ?> = <?= $timeRecord->time_diff_text ?> </span><br>

				<?php endforeach; ?>

				</span>
				</p>
			</div>
			</div>

			</div>
			</div>
			<br>

		<?php endforeach; ?>
	</div>
</div>
