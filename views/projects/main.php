<center><h4>Let's start completing waiting projects!</h4></center>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+ New Project</button>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New project</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="tb-project-title" class="control-label">Project title:</label>
            <input type="text" class="form-control" id="tb-project-title">
          </div>
          <div class="alert alert-info" role="alert">
          <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          <span id="save-result">New project added!</span>
        </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save-project">Save</button>
        
          <button type="button" id="myButton" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off">
            Loading state
          </button>

      </div>
    </div>
  </div>
</div>

<script>
  $('#myButton').on('click', function () {
    var $btn = $(this).button('loading')
    alert('hoppa');
    $btn.button('reset')
  })
</script>



<?php foreach ($projects as $project): ?>

<div class="container">
  <div class="panel-group">
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
  </div>
</div>
<?php endforeach; ?>
