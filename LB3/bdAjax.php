<!DOCTYPE html>
<html>
<head>
<link href="external.css" rel="stylesheet">
</head>
<body>

<?php
include("bd.php");
$q = $_GET['q'];
//echo $vendorToShow;



//$stmt = $mysqli->prepare("SELECT Name FROM vendors");
if ($stmt = $mysqli->prepare("SELECT name,year,ISBN,quantity FROM literature WHERE literature.publisher=?")) {

$stmt->bind_param("s", $q);
$stmt->execute();
//var_dump($stmt);
$stmt->bind_result($name,$year,$isbn,$quantity);
while ($stmt->fetch()) {
	//printf($district1);
	$table=$table."<tr><td>".$name."</td><td>".$year."</td><td>".$q."</td><td>".$isbn."</td><td>".$quantity."</td></tr>";
}
$stmt->fetch(); //printf("%s находится в %s\n", $city, $district);
$stmt->close();
}

echo "<table id='myTable' class='table_dark'>
   <tr>
    <th>Name</th>
    <th>Year</th>
    <th>Publisher</th>
    <th>ISBN</th>
    <th>Quantity</th>
   </tr>";
echo $table;
echo "</table>";

?>
</body>
</html>