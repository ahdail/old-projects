<?php
    //$DBCONF["as400_ibase"]["db"] = "128.1.1.11:/opt/interbase/data/GUANA_AS400.GDB";
    //$DBCONF["as400_ibase"]["user"] = "sysdba";
    //$DBCONF["as400_ibase"]["pw"]   = "masterkey";


	//$DBCONF["user"] = "root";
	//$DBCONF["pw"]   = "";
	
    // CONEX�O AO CLASSE CONT�BIL
    $DBCONF["host"] = "localhost";
    $DBCONF["user"] = "classe";
    $DBCONF["pw"]   = "idcphone=3";
    $DBCONF["db"]   = "CLASSE";

	// CONEX�O � INFORM�TICA
    $DBCONF2["host"] = "localhost";
    $DBCONF2["user"] = "classe";
    $DBCONF2["pw"]   = "idcphone=3";
    $DBCONF2["db"]   = "INFORMATICA";


    include "database.inc.php";
    include "_mysql.inc.php";
?>