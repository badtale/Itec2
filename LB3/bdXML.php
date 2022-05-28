<?php
include("bd.php");
$q = $_GET['q'];

	$res = $mysqli->query("SELECT DISTINCT a.name FROM book_authors JOIN literature as a ON book_authors.FID_Book = a.ID_Book JOIN authors ON book_authors.FID_Authors = authors.ID_Authors WHERE authors.name='".$q."'");
		$res->data_seek(0);
			$dom = new DomDocument('1.0', 'UTF-8'); 
	$cars = $dom->createElement('LESSONS');
	while ($myrow = $res->fetch_assoc())
	{
		$root = $dom->createElement('LESSON');
		$child_node_name = $dom->createElement('name', $myrow["name"]);
		$root->appendChild($child_node_name);
		$child_node_text = $dom->createElement('author', $q);
		$root->appendChild($child_node_text);
		$cars->appendChild($root);
	}

	$dom->appendChild($cars);
    $dom->formatOutput = true; // set the formatOutput attribute of domDocument to true

    // save XML as string or file 
    $test1 = $dom->saveXML(); // put string in test1
    $dom->save('data.xml'); // save as file


		echo "Ready";
?>