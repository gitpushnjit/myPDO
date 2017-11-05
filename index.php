<?php
$hostname = "sql.njit.edu";
$username = "pg395";
$password = "r4Matf7xW";
$conn = NULL;
try
  {
      $conn = new PDO("mysql:host=$hostname;dbname=pg395",
    $username, $password);
  //$myHandle = new PDO("sql.njit.edu")
//	$myHandle->myAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }   catch(PDOException $pe)
      {
		echo "server gave error as:".$pe->getMessage()."</br>";
		die();
      }
	  
	  
echo 'Connection Successful..!! </br>';	 



$myQuerry = $conn->prepare('SELECT * FROM accounts where id<6');
$myQuerry->execute();

$r = $myQuerry->fetchAll();
echo "Total number of results are: ".count($r)."</br>";
echo "<table border=\"1\"><tr><th>id</th><th>email</th><th>fname</th><th>lname</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th></tr>";
foreach($r as $temp){
//echo "<span>".$temp["id"]."</span>&nbsp &nbsp <span>".$temp["fname"]."</span>";
echo "<tr><td>".$temp["id"]."</td><td>".$temp["email"]."</td><td>".$temp["fname"]."</td><td>".$temp["lname"]."</td><td>".$temp["phone"]."</td><td>".$temp["birthday"]."</td><td>".$temp["gender"]."</td><td>".$temp["password"]."</td></tr>";
//echo 'yes';
}
//echo '<pre>', print_r($r), '</pre>';



?>