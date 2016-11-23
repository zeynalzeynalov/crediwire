<?php
  class Project {

    public $Project_ID;
    public $Project_Title;
    public $Project_Slug;
    public $Project_Created_Date;
    public $Project_State;

    public function __construct($Project_ID,$Project_Title,$Project_Slug,$Project_Created_Date,$Project_State)
    {
        $this->Project_ID = $Project_ID;
        $this->Project_Title = $Project_Title;
        $this->Project_Slug = $Project_Slug;
        $this->Project_Created_Date = $Project_Created_Date;
        $this->Project_State = $Project_State;
    }

    public static function all()
    {
        $projectList = [];
        $con = dbConnection::connectToDB();
        $results = pg_query($con,'SELECT * FROM public."Project" P LEFT JOIN
(SELECT "Project_ID", count(*) "Project_Open_Record_Count" FROM public."Project_Execution_Record" WHERE "Is_Completed" = FALSE GROUP BY "Project_ID") TMP 
ON P."Project_ID" = TMP."Project_ID" 
ORDER BY P."Project_ID" ASC') or die('Query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Slug'], $row['Project_Created_Date']);

        return $projectList;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $post = $req->fetch();

      return new Post($post['id'], $post['author'], $post['content']);
    }
  }
?>
