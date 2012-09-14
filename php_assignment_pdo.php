<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'borntoowin';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
    /*** show successful message ***/
    echo 'Connected to database';
    }
catch(PDOException $e)
    {
    /*** show error message when fails to connect ***/
    echo $e->getMessage();
    }

?>
