<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//require_once '/root/vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
$m = new MongoClient();
$db = $m->selectDB("dbforlab");
$rent =$db->rent;
$collections = $db->listCollections();

$cursor = $rent->find(
    [
        'brand' => 'Opel Astra',
    ]
);

foreach ($cursor as $item) {
   //var_dump($item);
   echo $item["brand"]; 

   echo "<br>";
};
echo "<br><br><br><br>";

foreach ($collections as $collection) {
echo "amount of documents in $collection: ";
echo $collection->count(), "\n";
echo $collection->getName();
}

$collection= $m -> trening->
students;
print_r($collection->findOne());
print_r($m -> listDBs());
$m ->close();
?>