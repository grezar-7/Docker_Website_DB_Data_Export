<?php
##load webpage UI
echo file_get_contents("html/header.html");
echo file_get_contents("html/queryBody.html"); ?>

<?php
//Connect to database
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'root', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);



//will show php info. Use only to check that things are connected
phpinfo();









//Create copy write
$query = $pdo->query('SHOW VARIABLES like "version"');
$row = $query->fetch();
echo 'MySQL version:' . $row['Value'];

//load webpage UI footer
echo file_get_contents("html/footer.html"); ?>