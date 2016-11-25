<?php echo count($projects);  echo "id=".$projects[0]->Project_id ?>

<?php foreach ($projects as $project): ?>

<div class="container">
  <div class="panel-group">
      <div class="panel panel-primary">
      <div class="panel-heading">
      <h3 class="panel-title">Project Name: <?= $project->Project_Title ?></h3>
      </div>
      <div class="panel-body">
        
      Project created on: <?= $project->Project_Created_Date ?>
        <br>
      <input class="<?= $project->getButtonStringCssClassForProjectState() ?>" type="button" id="btnAjax_<?= $project->Project_id ?>" value="<?= $project->getButtonStringForProjectState() ?>" onclick="processAjaxRequest(this.id)">

      <br />
      <br />
      <a class="btn btn-default btn-sm" role="button" data-toggle="collapse" href="#collapseExample_<?= $project->Project_id ?>" aria-expanded="true" aria-controls="collapseExample">
      Show/hide
      </a>
        

      <div class="collapse" id="collapseExample_<?= $project->Project_id ?>">
      <div class="well">
      <p> <span id="ajaxResponseContainer<?= $project->Project_id ?>">
        
        <?php foreach ($project->Project_Execution_Record as $timeRecord): ?>
            
        <span class="label label-info"><?= $timeRecord->Starting_Time_Stamp ?> - <?= $timeRecord->Ending_Time_Stamp ?> Total spent time = <?= $timeRecord->Time_Diff_Text ?> </span><br>
                        
        <?php endforeach; ?>
        
        
        </span></p>
      </div>
      </div>

      </div>
      </div>
  </div>
</div>
<?php endforeach; ?>
