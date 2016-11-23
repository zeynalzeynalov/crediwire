<?php
  class Project {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $Project_ID;
    public $Project_Title;
    public $Project_Slug;
    public $Project_Created_Date;

    public function __construct($Project_ID,$Project_Title,$Project_Slug,$Project_Created_Date)
    {
      $this->Project_ID = $Project_ID;
      $this->Project_Title = $Project_Title;
      $this->Project_Slug = $Project_Slug;
      $this->Project_Created_Date = $Project_Created_Date;
    }

    public static function all() {
      $projectList = [];
      $con = dbConnection::connectToDB();
     
 $results = pg_query($con,'SELECT * FROM public."Project" ORDER BY "Project_ID" ASC') or die('Query failed: ' . pg_last_error());
 
      echo '------>'.count( $results );
      while ($row = pg_fetch_assoc($results))
      {
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Slug'], $row['Project_Created_Date']);
      }

      
      
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
