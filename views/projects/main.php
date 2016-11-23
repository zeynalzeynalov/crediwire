<?php foreach ($projects as $project): ?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?= $project->Project_Title ?></h3>
  </div>
  <div class="panel-body">
    <?= 
  
    'Project: ' . $project->Project_ID . ' : ' . $project->Project_Title . ' : ' . $project->Project_Slug . ' : ' . $project->Project_Created_Date 
    
    
    ?>


    
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample_<?= $project->Project_ID ?>" aria-expanded="false" aria-controls="collapseExample">
 Show/Hide working details:
</a>
<div class="collapse" id="collapseExample_<?= $project->Project_ID ?>">
  <div class="well">
    <p> <span id="txtHint<?= $project->Project_ID ?>"></span></p>
  </div>
</div>
    
    
        <input class="btn btn-<?= $project->Project_State == "Start working"? "success" : "danger" ?>" type="button" id="btnAjax_<?= $project->Project_ID ?>" value="<?= $project->Project_State ?>" onclick="showHint(this.id, 'getProjectTimeRecords')">
    
    
    
    
  </div>
</div>
      
<?php endforeach; ?>
