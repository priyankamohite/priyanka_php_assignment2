<?php

class MyClass
{
	function makeConnection()
	{
		$hostname = 'localhost';
		$username = 'root';
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
	
	function capitalize()
	{
		return converttoupper($this->user_name);
	}

	function fetch($dbh,$mode)
	{

		$sql="select * from user";
		$stmt=$dbh->query($sql);
		if($mode==PDO::FETCH_ASSOC || $mode==PDO::FETCH_BOTH || $mode==PDO::FETCH_NUM)
		{
			$result = $stmt->fetch($mode);
			foreach($result as $key=>$val)
			{
			 echo $key.' - '.$val.'<br />';
			}
		}
		else if($mode==PDO::FETCH_OBJ)
		{
			$obj = $stmt->fetch($mode);
			echo $obj->user_id.'<br />';
			echo $obj->user_name;

		}
	}
	
	function fetchLazy($dbh,$mode)
	{
	$sql = "select * from user";
	$stmt = $dbh->query($sql);
	$result = $stmt->fetch($mode);
	foreach($result as $key=>$val)
	    {
	    echo $key.' - '.$val.'<br />';
	    }

	}

	/*function getLastInsertId($dbh)
	{	
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("insert into user(user_id,user_name)values('4', 'nishant')");
	        echo $dbh->lastInsertId();
	}*/

	function errorHandle($dbh)
	{
		
	try {
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		    $sql = "select name from user";
		
		    foreach ($dbh->query($sql) as $row)
			{
		
			print $row['user_id'] .' - '. $row['user_name'] . '<br />';
			}

	    }
	catch(PDOException $e)
	    {
	    echo $e->getMessage();
	    }
	}

	function fetchClass($dbh)
	{
	   
	    $sql = "select * from user";
	    $stmt = $dbh->query($sql);
	    $obj = $stmt->fetchALL(PDO::FETCH_CLASS);
	   foreach($obj as $user)
		{
			print_r($user);		  
		} 
		
	}

	function preparedStatement($dbh)
	{

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$user_id = 1;
	$stmt = $dbh->prepare("select * from user where user_id =1;");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
		{
		echo $row['user_id'].'<br />';
		}

	}
	
	/*function myTransaction($dbh)
	{
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
	$dbh->beginTransaction();

	   
	    $table = "CREATE TABLE books ( book_id MEDIUMINT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	    book_type VARCHAR(25) NOT NULL,
	    book_name VARCHAR(25) NOT NULL 
	    )";
	    $dbh->exec($table);
	    $dbh->exec("INSERT INTO books (book_type, book_name) VALUES ('comic', 'champak')");
	    $dbh->exec("INSERT INTO books (book_type, book_name) VALUES ('story', 'raja_rani')");
	    $dbh->exec("INSERT INTO books (book_type, book_name) VALUES ('story', 'pushpak')");
	    $dbh->commit();
	    echo 'Data entered successfully<br />';
	}
	catch(PDOException $e)
	    {
	    $dbh->rollback();
	    echo $sql . '<br />' . $e->getMessage();
	    }
	}*/
}
	/*ini_set('error_reporting', E_ALL);
	ini_set('display_errors',1);*/

	$obj=new MyClass();
	$dbh= $obj->makeConnection();

	echo "FETCH_ASSOC mode:<br/>";
	$mode=PDO::FETCH_ASSOC;
	$obj->fetch($dbh,$mode);

	echo "<br/>FETCH_NUM mode:<br/>";
	$mode=PDO::FETCH_NUM;
	$obj->fetch($dbh,$mode);

	echo "<br/>FETCH_BOTH mode:<br/>";
	$mode=PDO::FETCH_BOTH;
	$obj->fetch($dbh,$mode);

	echo "<br/>FETCH_OBJ mode:<br/>";
	$mode=PDO::FETCH_OBJ;
	$obj->fetch($dbh,$mode);
	
	echo "<br/>FETCH_LAZY mode:<br/>";
	$mode=PDO::FETCH_BOTH;
	$obj->fetchLazy($dbh,$mode);

	echo "<br/>FETCH_CLASS mode:<br/>";
	$obj->fetchClass($dbh);
   
   	echo "<br/><br/>Error handle:<br/>";
	$obj->errorHandle($dbh);

	echo "<br/><br/>Prepared statement<br/>";
	$obj->preparedStatement($dbh);
	
	/*echo "<br/>Transaction<br/>";
	$obj->myTransaction($dbh);*/
	
	/*echo "<br/>Get last inserted id:<br/>";
	$obj->getLastInsertId($dbh);*/
	
	
	$obj->closeConnection();


?>
