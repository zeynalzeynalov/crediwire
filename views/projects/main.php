<?php foreach ($projects as $project): ?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Project Name: <?= $project->Project_Title ?></h3>
  </div>
  <div class="panel-body">
    Project created on: <?= $project->Project_Created_Date ?>
    
    <input class="btn btn-<?= $project->Project_State == "Start working"? "success" : "danger" ?>" type="button" id="btnAjax_<?= $project->Project_ID ?>" value="<?= $project->Project_State ?>" onclick="showHint(this.id, 'getProjectTimeRecords')">
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample_<?= $project->Project_ID ?>" aria-expanded="false" aria-controls="collapseExample">
    Show/hide time records:
    </a>
    <div class="collapse" id="collapseExample_<?= $project->Project_ID ?>">
      <div class="well">
        <p> <span id="txtHint<?= $project->Project_ID ?>"></span></p>
      </div>
    </div>

  </div>
</div>
      
<?php endforeach; ?>
