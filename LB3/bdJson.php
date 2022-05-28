<?php
include("bd.php");
$arrayMoney = array();
$q = $_GET['q'];

	$res = $mysqli->query("SELECT DISTINCT a.name FROM book_authors JOIN literature as a ON book_authors.FID_Book = a.ID_Book JOIN authors ON book_authors.FID_Authors = authors.ID_Authors WHERE authors.name='".$q."'");
		$res->data_seek(0);
	while ($myrow = $res->fetch_assoc())
	{
		array_push($arrayMoney, $myrow['name']);
		array_push($arrayMoney, $q);
	}

		echo json_encode($arrayMoney);
//echo 1;
?>
