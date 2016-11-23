<?php
  class Project {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;

    public function __construct($id) {
      $this->id      = $id;
    }

    public static function all() {
      $projectList = [];
      $con = dbConnection::connectToDB();
      $req = $con->query();

      
      $query = 'SELECT * FROM Projects';
 $results = pg_query($con, 'SELECT * FROM posts') or die('Query failed: ' . pg_last_error());
 
      
      // we create a list of Post objects from the database results
      foreach( $results->fetchAll() as $project) {
        $projectList[] = new Project($project['Project_ID']);
      }

      return $list;
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
