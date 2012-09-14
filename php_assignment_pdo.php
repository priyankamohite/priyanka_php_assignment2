<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'borntoowin';

function makeConnection()
{
	try {
	    $dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
	    /*** show successful message ***/
	    echo 'Connected to database<br/>';
	    }
	catch(PDOException $e)
	    {
	    /*** show error message when fails to connect ***/
	    echo $e->getMessage();
	    }
}

function closeConnection()
{
  	    /*** closed the database connection ***/
	    $dbh=null;
	    echo 'connection closed';
}
?>
