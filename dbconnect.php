<?php

 // this will avoidmysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO ormysql.
 
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'hostel');
 
 $conn =mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon =mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " .mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " .mysql_error());
 }