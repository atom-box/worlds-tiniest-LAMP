<?php

// in browser, errors show
ini_set("display_errors", 1);
error_reporting(E_ALL);

require("./DBTransaction.php");
echo "<h1>Good day there, Mr. Gypsy King</h1>";
// echo "In the file orders.php:\n";

/*
__              _           _ _   _                
/_ |            (_)         (_) | (_)               
 | |  _ __  _ __ _ _ __ ___  _| |_ ___   _____  ___ 
 | | | '_ \| '__| | '_ ` _ \| | __| \ \ / / _ \/ __|
 | | | |_) | |  | | | | | | | | |_| |\ V /  __/\__ \
 |_| | .__/|_|  |_|_| |_| |_|_|\__|_| \_/ \___||___/
     | |                                            
     |_|                                            
*/


// config
$db_host = "database_host"; // e.g. 127.0.0.1
$db_name = "database_name"; // example_store
$db_user = "database_user"; // mister romney
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
  
  /*
    ___     _           _ _     _   _   _            _ _                 
   |__ \   | |         (_) |   | | | | | |          | (_)                
      ) |  | |__  _   _ _| | __| | | |_| |__   ___  | |_ _ __   ___  ___ 
     / /   | '_ \| | | | | |/ _` | | __| '_ \ / _ \ | | | '_ \ / _ \/ __|
    / /_   | |_) | |_| | | | (_| | | |_| | | |  __/ | | | | | |  __/\__ \
   |____|  |_.__/ \__,_|_|_|\__,_|  \__|_| |_|\___| |_|_|_| |_|\___||___/
  */
  // gonna need to touch two tables and do these insertions in them
// SHOULD BE 3 LINES NOT 4  $order_query = "insert into orders (order_id, customer_id, order_date, order_total) values(:order_id, :customer_id, :order_date, :order_total)";
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

  $product_query = "insert into orders_products (order_id, product_id, price, quantity) values(:order_id, :product_id, :price, :quantity)";
  
  // save the ORDER, THEN ASK THE SQL WHICH SERIAL ID WAS IT?
  $transaction->insertQuery($order_query, [
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
  
//     /*
//     ____                 _ _   _        _                     
//    |___ \               | | | | |      (_)                      
//      __) |   _ __  _   _| | | | |_ _ __ _  __ _  __ _  ___ _ __ 
//     |__ <   | '_ \| | | | | | | __| '__| |/ _` |/ _` |/ _ \ '__|
//     ___) |  | |_) | |_| | | | | |_| |  | | (_| | (_| |  __/ |   
//    |____/   | .__/ \__,_|_|_|  \__|_|  |_|\__, |\__, |\___|_|   
//             | |                            __/ | __/ |          
//             |_|                           |___/ |___/           
//     */
    $transaction->startTransaction();
    $result = $transaction->submitTransaction();
  
  
//   // all good?
    if ($result) {
      echo "Records successfully submitted";
  } else {
      echo "There was an error.";
  }
  
  
  
  ?>