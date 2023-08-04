<?php
##load webpage UI
echo file_get_contents("html/header.html");
 echo file_get_contents("html/queryBody.html"); ?>

<?php
//Connect to database
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'root', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if (isset($_POST['submitQuery'])) {
 $query = $pdo->query('show tables');
 $extractedData = $query->fetch();
}
$htmlQuery = $_POST['dbQuery'];

$query = $htmlQuery;
$result = $pdo->query($query);

function display_data($data) {
 $output = "<table>";
 foreach($data as $key => $var) {
  //$output .= '<tr>';
  if($key===0) {
   $output .= '<tr>';
   foreach($var as $col => $val) {
    $output .= "<td>" . $col . '</td>';
   }
   $output .= '</tr>';
   foreach($var as $col => $val) {
    $output .= '<td>' . $val . '</td>';
   }
   $output .= '</tr>';
  }
  else {
   $output .= '<tr>';
   foreach($var as $col => $val) {
    $output .= '<td>' . $val . '</td>';
   }
   $output .= '</tr>';
  }
 }
 $output .= '</table>';
 echo $output;
}
display_data($result);
echo $htmlQuery;








//Create copy write
    $query = $pdo->query('SHOW VARIABLES like "version"');
    $row = $query->fetch();
    echo 'MySQL version:' . $row['Value'];

//load webpage UI footer
echo file_get_contents("html/footer.html"); ?>