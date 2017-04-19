<html>
    <head>
	<title>Testing</title>
        <link href="MyCSS.css" rel="stylesheet">
    </head>
    <body>



<?php

echo "<table style  = 'border: solid 1px black;'>";
echo "<tr><th>ID</th><th>Type </th><th>Name</th></tr>";

class TableRows extends RecursiveIteratorIterator
{
   function  __construct($you) {

       parent::__construct($you, self::LEAVES_ONLY);

   }

   function current()
   {
       return "<td style = 'width:15px;border:10x solid black;'>".parent::current()."</td>";
   }

   function beginChildren()
   {
       echo "<tr>";
   }

   function endChildren()
   {
       echo "</tr>" ."\n";
   }
}



$server = "localhost";
$username = "root";
$password = "";
$dbname = "academycity";

try
{
    $connection = new PDO("mysql:host=$server;dbname=$dbname", $username, $password); //connection to the database

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo"</br>";
    echo"</br>";
    echo "Welcome". "<br/>";
    echo "<br/>";
    echo "<br/>";

    $sth = $connection->prepare("SELECT user_id,user_fullname,user_email FROM users"); //a query statement to select fro the database
    $sth->execute();

    $row = $sth->setFetchMode(PDO::FETCH_ASSOC); //fetch data fro database
    foreach(new TableRows(new RecursiveArrayIterator($sth->fetchAll()))as $k=>$v)
        {
            echo $v; //display the data

        }

    /*$result = $sth->fetchAll();
    print_r($result);*/

}
catch(PDOException $error)
{
    echo "Connection Failed : ". $error->getMessage();
}

echo "</table>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

$connection = null; //close the connection

?>

   
 

        </body>

    
</html>