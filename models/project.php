<?php
  class Project {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $Project_ID;

    public function __construct($Project_ID) {
      $this->Project_ID      = $Project_ID;
    }

    public static function all() {
      $projectList = [];
      $con = dbConnection::connectToDB();
     
 $results = pg_query($con,'SELECT * FROM public."Project" ORDER BY "Project_ID" ASC') or die('Query failed: ' . pg_last_error());
 
      echo '------>'.count( $results );
      while ($row = pg_fetch_row($result))
      {
          $projectList[] = new Project($row[0]);
        
        echo $row[1];
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
