<div class="container">
  <div class="panel-group">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Technical documentation of developed Project Time Management App.</h3>
      </div>
      <div class="panel-body">
      
      <pre>
      DATABASE:
      Server:     PostgreSQL VERSION 9.5.5
      Host:       ec2-54-217-213-203.eu-west-1.compute.amazonaws.com
      Database:   dcreosvnjcrc0o
      User:       phueqmfbfolrhb
      Port:       5432
      Password:   A2vfu6M2r5LhhxAdBA63VWCi6U
      URI:        postgres://phueqmfbfolrhb:A2vfu6M2r5LhhxAdBA63VWCi6U@ec2-54-217-213-203.eu-west-1.compute.amazonaws.com:5432/dcreosvnjcrc0oHeroku
      CLI:        heroku pg:psql DATABASE_URL --app cready

      <pre>
      TABLES [2]:
        <b>- project</b>
            <span>Columns:
                  <b>project_id integer (PK)</b>,
                  project_title character varying,
                  project_created_date date,
            </span>
        
        <b>- project_execution_record</b>
            <span>Columns:
                  <b>project_execution_record_id integer (PK)</b>,
                  starting_time_stamp timestamp,
                  ending_time_stamp timestamp,
                  is_completed boolean,
                  project_id integer (FK),
                  final_execution_time bigint,
            </span>
        </pre>
        <pre>
        FUNCTIONS [2]:
        <b>check_project_state( project_id integer )</b>
              Check that indicated project is Closed or Open.
        
        <b>get_timestamp_diff( project_id integer )</b>
              Get time interval between ending and starting time stamps in format of 'HH24:MI:SS'.
        </pre>

      </pre>
      
      <pre>
      APPLICATION:
        Language:     PHP
        Markup:       CSS, Bootstrap v3.3.7
        Frontend:     Javascript, AJAX, Json
        Pattern:      MVC
        APIs design:  RESTful
        
        <b>Directory structure:</b>
            root/
                config/
                      configuration.php
                controllers/
                      help_controller.php
                      projects_controller.php
                includes/
                      dbconnection.php
                      starter.php
                models/
                      project.php
                public_app/
                      js/
                          mainscript.js
                      .htaccess
                      index.php
                restfulapi/
                      getjson.php
                      performaction.php
                views/
                      projects/
                          main.php
                          error.php
                      template.php
                      help.php
                      error.php
                .htaccess
                index.php
        </pre>
        
      </div>
    </div>

  </div>
</div>  
