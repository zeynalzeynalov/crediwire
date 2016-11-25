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
      <input class="<?= $project->getButtonStringCssClassForProjectState() ?>" type="button" id="btnAjax_<?= $project->project_id ?>" value="<?= $project->getButtonStringForProjectState() ?>" onclick="processAjaxRequest(this.id)">

      <br />
      <br />
      <a class="btn btn-default btn-sm" role="button" data-toggle="collapse" href="#collapseExample_<?= $project->project_id ?>" aria-expanded="true" aria-controls="collapseExample">
      Show/hide
      </a>
        

      <div class="collapse" id="collapseExample_<?= $project->project_id ?>">
      <div class="well">
      <p> <span id="ajaxResponseContainer<?= $project->project_id ?>">
        
        <?php foreach ($project->project_execution_record as $timeRecord): ?>
            
        <span><?= $timeRecord->starting_time_stamp ?>    -    <?= $timeRecord->ending_time_stamp ?>     Spent time: <?= $timeRecord->time_diff_text ?> </span><br>
                        
        <?php endforeach; ?>
        
        </span></p>
      </div>
      </div>

      </div>
      </div>
  </div>
</div>
<?php endforeach; ?>
