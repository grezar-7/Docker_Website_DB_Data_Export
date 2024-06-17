<?php echo file_get_contents("html/header.html"); ?>
<?php echo file_get_contents("html/body.html"); ?>
<?php
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'root', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// When the submit button is clicked
if (isset($_POST['submit'])) {
    $query = $pdo->query('show tables');
    $extractedData = $query->fetch();
    $tableExists = $extractedData == null;
    if($tableExists == 1){
        $query = $pdo->query('CREATE TABLE users(user_id INT NOT NULL AUTO_INCREMENT, email VARCHAR(100) NOT NULL, fName VARCHAR(100) NOT NULL, lName VARCHAR(100) NOT NULL, PRIMARY KEY (user_id))');
    }
    //$query = $pdo->query('DROP TABLE users');
    // Creating variables and
    // storing values in it
    $email = $_POST['email'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];

    $query = $pdo->query("SELECT fName FROM users WHERE email = '$email'");
    $extractedData = $query->fetch();
    if($extractedData == null){
        echo 2;
        $query = $pdo->query("INSERT INTO users (email, fName, lName) VALUES ('$email','$f_name','$l_name')");
    }
    if( $f_name != "" or $l_name != ""){
        if( $f_name == "" and $l_name != "") {
            $query = $pdo->query("UPDATE users SET lName = '$l_name' WHERE email = '$email'");
        }
        elseif ( $f_name != "" and $l_name == "") {
            $query = $pdo->query("UPDATE users SET fName = '$f_name' WHERE email = '$email'");
        }

    else{
        $query = $pdo->query("UPDATE users SET fName = '$f_name', lName = '$l_name' WHERE email = '$email'");
    }
    }
    $query = $pdo->query("SELECT fName FROM users WHERE email = '$email'");
    $extractedFName = $query->fetch();
    $fNameSQL = $extractedFName[0];
    $query = $pdo->query("SELECT lName FROM users WHERE email = '$email'");
    $extractedLName = $query->fetch();
    $lNameSQL = $extractedLName[0];
    echo "<h1><i> Good Morning, $fNameSQL $lNameSQL </i></h1>";
}


//change query csv and download
// When the submit button is clicked
$fileName = "books.csv";
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

$bits = 8 * PHP_INT_SIZE;
echo "(Info: This script is running as $bits-bit.)\r\n\r\n";
echo"<br>";}}
?>

<a href="books.csv" download>
 <img src="image_2023_11_03T18_24_20_170Z.png" alt="alt_text">
</a>


$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version:' . $row['Value'];
?>
<?php echo file_get_contents("html/footer.html"); ?>


