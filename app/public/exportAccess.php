<?php echo file_get_contents("html/header.html"); ?>
<?php echo file_get_contents("html/exportAccess.html"); ?>
<?php
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'root', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// When the submit button is clicked
if (isset($_POST['exportQuery'])) {
$bits = 8 * PHP_INT_SIZE;
echo "(Info: This script is running as $bits-bit.)\r\n\r\n";

$connStr = 
        'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};' .
        'Dbq=C:\Users\Mic\source\repos\Docker_Website_DB_Data_Export;';

$dbh = new PDO($connStr);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 
        "SELECT AgentName FROM Agents " .
        "WHERE ID < ? AND AgentName <> ?";
$sth = $dbh->prepare($sql);

// query parameter value(s)
$params = array(
        5,
        'Homer'
        );

$sth->execute($params);

while ($row = $sth->fetch()) {
    echo $row['AgentName'] . "\r\n";
}
}

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version:' . $row['Value'];
?>
<?php echo file_get_contents("html/footer.html"); ?>