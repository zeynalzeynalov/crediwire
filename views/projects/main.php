<?php foreach ($projects as $project): ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?= $project->Project_Title ?></h3>
  </div>
  <div class="panel-body">
    <?= 'Project: ' . $project->Project_ID . ' : ' . $project->Project_Title . ' : ' . $project->Project_Slug . ' : ' . $project->Project_Created_Date
  </div>
</div>
      
<?php endforeach; ?>
