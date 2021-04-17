<?php

// in browser, show errors if any
ini_set("display_errors", 1);
error_reporting(E_ALL);

require("./DBTransaction.php");

// config
$db_host = "database_host"; // e.g. 127.0.0.1
$db_name = "database_name"; // example_store
$db_user = "database_user"; // misterromney
$db_password = "PASSWORD";  // 50000000000soooooooooosecret

$customer_id = 2;

// ordering three items
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
  
  // ping the db: you there?  make me an object
  $transaction = new DBTransaction($db_host, $db_user, $db_password, $db_name);

  // gonna need to touch two tables and do these insertions in them
$order_query = "
insert into orders 
(
    customer_id, 
    order_date, 
    order_total
) values(
    :customer_id, 
    :order_date, 
    :order_total)
";

  $product_query = "
  insert into orders_products 
    (
      order_id, 
      product_id, 
      price, 
      quantity
    ) values(
        :order_id, 
        :product_id, 
        :price, 
        :quantity
    )";
  
  // save the ORDER, THEN ASK THE SQL WHICH SERIAL ID WAS IT?
  $transaction->insertQuery(
    $order_query, 
    [
    'customer_id' => $customer_id,
    'order_date' => date("Y-m-d H:i:s", time()),
    'order_total' => 157.8
    ]);
  
  $order_id = $transaction->last_insert_id;
  
  //  now that you know that serial id, write the order lines
  foreach ($products as $product) {
      $transaction->insertQuery($product_query, [
        'order_id' => $order_id,
        'product_id' => $product['product_id'],
        'price' => $product['price'],
        'quantity' => $product['quantity']
      ]);
    }
 
    $transaction->startTransaction();
    $result = $transaction->submitTransaction();
  
  
    //   all good?
    if ($result) {
      echo "Records successfully submitted";
    } else {
      echo "There was an error.";
  }
  
  
  
  ?>