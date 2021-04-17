<?php

// in browser, show errors if any
ini_set("display_errors", 1);
error_reporting(E_ALL);

require("./DBTransaction.php");

$customer_id = random_int(1000, 9999);

// ordering three items
$products[] = [
    'product_id' => 1,
    'price' => 25.50,
    'quantity' => random_int(1,4)
  ];
  $products[] = [
    'product_id' => 2,
    'price' => 13.90,
    'quantity' => random_int(1,4)
  ];
  $products[] = [
    'product_id' => 3,
    'price' => 45.30,
    'quantity' => random_int(1,4)
  ];
  $dollarsTotal = $products[0]['quantity'] * $products[0]['price'] + $products[1]['quantity'] * $products[1]['price'] + $products[2]['quantity'] * $products[2]['price'];
  
  // ping the db: you there?  make me an object
  $transaction = new DBTransaction();

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
    'order_total' => $dollarsTotal
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