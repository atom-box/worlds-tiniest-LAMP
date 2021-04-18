<?php

require_once '../dbconfig.inc.php';

// in browser, show errors if any
ini_set("display_errors", 1);
error_reporting(E_ALL);

$user = USER;
$password = SECRET;
$database = NAMEOFDATABASE;  
$host = "localhost";
$table = 'orders';

try {
  $db = new PDO("mysql:host=" . $host . ";dbname=" . $database, $user, $password);  // this is the only scary line in the entire file
  echo "<h1>Report</h1>";
  echo "<h2>orders</h2>"; 
  foreach($db->query("SELECT * FROM $table") as $row) {
    print $row['order_date'];
    print $row['order_total'];
    echo "<br>";
  }
  echo " done";
} catch (PDOException $e) {
  print "Whoa, error!: " . $e->getMessage() . "<br/>";
}

/*////
mysql> select * from orders;
+----------+---------------------+-------------+-------------+
| order_id | order_date          | customer_id | order_total |
+----------+---------------------+-------------+-------------+
|        1 | 2020-01-11 00:00:00 |           2 |       157.8 |
