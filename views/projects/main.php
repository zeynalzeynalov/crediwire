<?php foreach ($projects as $project): ?>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?= $project->Project_Title ?></h3>
  </div>
  <div class="panel-body">
    <?= 
  
    'Project: ' . $project->Project_ID . ' : ' . $project->Project_Title . ' : ' . $project->Project_Slug . ' : ' . $project->Project_Created_Date 
    
    
    ?>

    <input class="btn btn-success" type="button" id="btnAjax_<?= $project->Project_ID ?>" value="<?= $project->Project_State ?>" onclick="showHint(this.id, 'getProjectTimeRecords')">
    
    <p>Suggestions: <span id="txtHint<?= $project->Project_ID ?>"></span></p>
    <button type="button" class="btn btn-success">Start stopwatch</button>
    <button type="button" class="btn btn-danger">Stop stopwatch</button>
  </div>
</div>
      
<?php endforeach; ?>
