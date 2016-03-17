<?php
$servername = "localhost";
$username = "username";
$password = "password";
$database = "database";

//infromatie van de form:

try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$naam = $_POST['naam'];
$Email = $_POST['email'];
$bericht = $_POST['bericht'];
$IP = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare("INSERT INTO data (naam, email, bericht, ip) 
    VALUES (:naam, :email, :bericht, :ip)");
    
	$stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':email', $Email);
	$stmt->bindParam(':bericht', $bericht);
    $stmt->bindParam(':ip', $IP);
	
	
	

	
if ($stmt->execute())
{
	$sql = $conn->prepare("SELECT * FROM data");
	$sql->execute();
  echo("Done\n\n");
	var_dump($sql->fetchAll(PDO::FETCH_ASSOC));
while($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
    print $row['naam'] + '\n <br />';
    print $row['email'] + '\n <br />';
    print $row['bericht'] + '\n <br />';
}

}
else {
  echo("Failed.\n\n");
}
echo "Connected successfully";
$conn = null;
}

catch(PDOException $e)
{
echo "Connection failed: \n" . $e->getMessage();
}
?>