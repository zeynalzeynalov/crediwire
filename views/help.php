<div class="container">
  <div class="panel-group">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Technical documentation of developed Project Time Management App.</h3>
      </div>
      <div class="panel-body">

      <pre>
      APPLICATION:
      
        This demo is working version of coding assigment. I tried to use Ajax requests in order to prevent postbacks to the server side
        if there is a button click. And also design is responsive that it is adaptive to mobile devices.  
        API module of application also useful for integration posibilities (please use top API menu to test demo Json API).
        Pattern design is MVC.
      
        Language:     PHP
        Markup:       HTML, CSS, <a href="http://getbootstrap.com/" target="_blank">Bootstrap 3</a>
        Frontend:     Javascript, AJAX, Json, Google charts
        Pattern:      MVC
        APIs design:  RESTful
        Development enviroment: <a href="https://www.heroku.com/" target="_blank">Heroku: Cloud Application Platform</a>
        
        <b>Directory structure:</b>
            <a href="https://github.com/zeynalzeynalov/project-mng-app" target="_blank">root/</a>
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

      <img src="https://project-mng-app.herokuapp.com/images/db_er_diagram.png">

      <pre>
      TABLES [2]:
        <b> project</b>
            <span>Columns:
                  <b>project_id integer (PK)</b>,
                  project_title character varying (30),
                  project_created_date date,
            </span>
        
        <b> project_execution_record</b>
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
        PostgreSQL FUNCTIONS [2]:
        <b> check_project_state( project_id integer )</b>
              Check that indicated project is Closed or Open.
        
        <b> get_timestamp_diff( 	start timestamp, end timestamp) RETURNS character varying</b>
              Get time interval between ending and starting time stamps in format of 'HH24:MI:SS'.
        </pre>
        
        <pre>
        <b>Database SQL Script:</b>
            
            <pre>
            -- Table: public.project
            -- DROP TABLE public.project;

            CREATE TABLE public.project
            (
                project_id integer NOT NULL DEFAULT nextval('"Project_Project_ID_seq"'::regclass),
                project_title character varying(30) COLLATE pg_catalog."default" NOT NULL,
                project_created_date date NOT NULL,
                CONSTRAINT "Project_pkey" PRIMARY KEY (project_id)
            )
            WITH (
                OIDS = FALSE
            )
            TABLESPACE pg_default;

            ALTER TABLE public.project
                OWNER to phueqmfbfolrhb;
            COMMENT ON TABLE public.project
                IS 'Project list';
            </pre>  
            
            <pre>
            -- Table: public.project_execution_record
            -- DROP TABLE public.project_execution_record;

            CREATE TABLE public.project_execution_record
            (
                project_execution_record_id integer NOT NULL DEFAULT nextval('"Project_Execution_Record_Project_Execution_Record_ID_seq"'::regclass),
                starting_time_stamp timestamp without time zone NOT NULL,
                ending_time_stamp timestamp without time zone,
                is_completed boolean NOT NULL DEFAULT false,
                project_id integer NOT NULL,
                final_execution_time bigint,
                CONSTRAINT "Project_Execution_Record_pkey" PRIMARY KEY (project_execution_record_id),
                CONSTRAINT "Project_Execution_Record_Project_ID_fkey" FOREIGN KEY (project_id)
                    REFERENCES public.project (project_id) MATCH SIMPLE
                    ON UPDATE NO ACTION
                    ON DELETE NO ACTION
            )
            WITH (
                OIDS = FALSE
            )
            TABLESPACE pg_default;

            ALTER TABLE public.project_execution_record
                OWNER to phueqmfbfolrhb;
            </pre>
        
            <pre>
            -- FUNCTION: public.check_project_state(integer)
            -- DROP FUNCTION public.check_project_state(integer);

            CREATE OR REPLACE FUNCTION public.check_project_state(
              project_id integer)
                RETURNS character varying
                LANGUAGE 'sql'
                COST 100.0
                VOLATILE NOT LEAKPROOF 
            AS $function$

            with myResult as
            (
                SELECT
                CASE WHEN coalesce(Is_Completed, FALSE) = FALSE 
                THEN 'OPEN' 
                ELSE 'CLOSED' END  
                Project_State
                FROM public.Project_Execution_Record
                WHERE Project_ID = $1
                ORDER BY Project_Execution_Record_ID desc limit 1
            )

            select * from myResult
            union
            select 'CLOSED' from Project
            where (select count(*) from myResult) = 0

            $function$;

            ALTER FUNCTION public.check_project_state(integer)
                OWNER TO phueqmfbfolrhb;

            COMMENT ON FUNCTION public.check_project_state(integer)
                IS 'Check project state: running / stopped';
            </pre>
            
            <pre>
            -- FUNCTION: public.get_timestamp_diff(timestamp without time zone, timestamp without time zone)
            -- DROP FUNCTION public.get_timestamp_diff(timestamp without time zone, timestamp without time zone);

            CREATE OR REPLACE FUNCTION public.get_timestamp_diff(
              start timestamp without time zone,
              "end" timestamp without time zone)
                RETURNS character varying
                LANGUAGE 'sql'
                COST 100.0
                VOLATILE NOT LEAKPROOF 
            AS $function$

            SELECT
              TO_CHAR(concat(EXTRACT(EPOCH FROM ($2 - $1)) , ' second')::interval, 'HH24:MI:SS') TimeDiff
            FROM
              public.project_execution_record;

            $function$;

            ALTER FUNCTION public.get_timestamp_diff(timestamp without time zone, timestamp without time zone)
                OWNER TO phueqmfbfolrhb;

            COMMENT ON FUNCTION public.get_timestamp_diff(timestamp without time zone, timestamp without time zone)
                IS 'Get timestamp diff in hours and minutes';
            </pre>
        
        </pre>
      </pre>
        
      </div>
    </div>

  </div>
</div>  
