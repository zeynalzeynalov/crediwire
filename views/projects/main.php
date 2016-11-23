<p>List of projects (main page):
    <?php
    foreach ($projects as $project)
        echo 'Project: ' . $project->Project_ID . ' : ' . $project->Project_Title . ' : ';// . $project->Project_Slug . ' : ' . $project->Project_Created_Date . "\n";
    ?>
<p>
