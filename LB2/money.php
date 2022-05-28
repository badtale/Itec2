<?php
require_once __DIR__ . '/vendor/autoload.php';
$m = new MongoClient();
$db = $m->selectDB("dbforlab");
$rent =$db->rent;
$collections = $db->listCollections();

$cursor = $rent->find(
    [
    ]
);
$dateToShow=$_POST['dateToShow'];
$timeToShow= strtotime($dateToShow);
//echo $timeToShow;
foreach ($cursor as $item) {
   //var_dump($item);
   if ($dateToShow!=""){
				if (($item["rentStart"]<=$timeToShow+86400)&&($item["rentEnd"]>=$timeToShow)){
					$allRentTime=$item["rentEnd"]-$item["rentStart"]."<br>";
					$allRentTime=$allRentTime*1.0;
					$costPerSec=$item["cost"]/$allRentTime;
					//echo $costPerSec."<br>";
					//$moneyPerDay=$costPerSec*60*60*24;
					if ($timeToShow>=$item["rentStart"]){
						$startDay=$timeToShow;
					}else{
						$startDay=$item["rentStart"];
						
					}
					if ($timeToShow+86400<=$item["rentEnd"]){
						$endDay=$timeToShow+86400;
					}else{
						$endDay=$item["rentEnd"];
						
					}
					$secRentDay=$endDay-$startDay;
					$moneyPerDay=$secRentDay*$costPerSec;
					$table=$table."<tr><td>".$item['brand']."</td><td>".$moneyPerDay."</td></tr>";
					$allCost=$allCost+$moneyPerDay;
					//echo $myrow['Date_start']."-".$myrow['Date_end']."=".($myrow['Date_end']-$myrow['Date_start'])."<br>";
				}
				
			}
   //echo $item["brand"]; 

   //echo "<br>";
};

		if ($dateToShow!=""){
			
			$table="<tr><th>All</th><th>".$allCost."</th></tr>".$table;
		}

		//echo $table;
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 2(Прибыль)</title>
  <link href="external.css" rel="stylesheet">
 </head>
 <body>

<div class="navigation">
<form action="money.php" method="post">
<a style="margin-left: 50px;">Выберите дату:</a><br>
<input name="dateToShow" style="background-color: #2980b9; border-radius: 10px;" type=date>
<input class="btn third" type="submit" value="Загрузить" />

</form>
<table id="myTable" class="table_dark">
   <?php echo $table; ?>
</table><br>
<?php echo $out;?>
</div>

 </body>
</html>
