<?php
$mileage=$_POST['mileage'];
require_once __DIR__ . '/vendor/autoload.php';
$m = new MongoClient();
$db = $m->selectDB("dbforlab");
$rent =$db->car;
$collections = $db->listCollections();

$cursor = $rent->find(
    [
    ]
);
//echo $timeToShow;
foreach ($cursor as $item) {
	if ($item["mileage"]<$mileage){
		$table=$table."<tr><td>".$item['brand']."</td><td>".$item['mileage']."</td><td>".$item['condition']."</td></tr>";
	}
	
}
		//echo $table;
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 1(Сортировка по пробегу)</title>
  <link href="external.css" rel="stylesheet">
 </head>
 <body>

<div class="navigation">
<form action="mileage.php" method="post">
<a style="margin-left: 50px;">Укажите пробег меньше:</a><br>
<input name="mileage"  type="text" value="Пробег" />
<input class="btn third" type="submit" value="Загрузить" />
</form>
<table id="myTable" class="table_dark">
   <tr>
    <th>Машина</th>
    <th>Пробег</th>
	<th>Состояние</th>
   </tr>
   <?php echo $table; ?>
</table><br>
<?php echo $out;?>
</div>

 </body>
</html>
