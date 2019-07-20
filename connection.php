<?php
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );

 $DBHOST="localhost";
 $DBUSER="root";
 $DBPASS= "";
 $DBNAME="project";
 $con=mysqli_connect($DBHOST,$DBUSER,$DBPASS,$DBNAME);
?>