<?php


function makeConnection()
{
	/*** mysql hostname ***/
	$hostname = 'localhost';

	/*** mysql username ***/
	$username = 'root';

	/*** mysql password ***/
	$password = 'borntoowin';

	try {
	    $dbh = new PDO("mysql:host=$hostname;dbname=mydb", $username, $password);
	    /*** show successful message ***/
	    echo 'Connected to database<br/><br/>';
	return $dbh;
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
	    echo '<br/><br/>Connection closed';
}

function fetch($dbh,$mode)
{

	$sql="select * from user";
	$stmt=$dbh->query($sql);
	$result = $stmt->fetch($mode);
	foreach($result as $key=>$val)
	{
	 echo $key.' - '.$val.'<br />';
	}
}

$dbh= makeConnection();

echo "FETCH_ASSOC mode:<br/>";
$mode=PDO::FETCH_ASSOC;
fetch($dbh,$mode);

echo "<br/>FETCH_NUM mode:<br/>";
$mode=PDO::FETCH_NUM;
fetch($dbh,$mode);

closeConnection();


?>
