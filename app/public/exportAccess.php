<?php echo file_get_contents("html/header.html"); ?>
<?php echo file_get_contents("html/exportAccess.html"); ?>
<?php
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'root', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);



// When the submit button is clicked
if (isset($_POST['exportQuery'])) {
	$sql =  $_POST['dbExport'];
    if($sql == null){
    //function does nothing if there is no query
    }
    else{
$connection = mysqli_connect('mysql', 'root', 'secret', 'tutorial') or die("Connection Error " . mysqli_error($connection));
$result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('books.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);
mysqli_close($connection);
echo $sql;
echo"<br>";
$bits = 8 * PHP_INT_SIZE;
echo "(Info: This script is running as $bits-bit.)\r\n\r\n";
echo"<br>";}}

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version:' . $row['Value'];
?>
<a href="books.csv" download>
 <img src="image_2023_11_03T18_24_20_170Z.png" alt="alt_text">
</a>

<?php echo file_get_contents("html/footer.html"); ?>
