<?php

require("./DBTransaction.php");

$db_host = "database_host";
$db_name = "database_name";
$db_user = "database_user";
$db_password = "PASSWORD";

$customer_id = 2;

$products[] = [
  'product_id' => 1,
  'price' => 25.50,
  'quantity' => 1
];

$products[] = [
  'product_id' => 2,
  'price' => 13.90,
  'quantity' => 3
];

$products[] = [
  'product_id' => 3,
  'price' => 45.30,
  'quantity' => 2
];

$transaction = new DBTransaction($db_host, $db_user, $db_password, $db_name);