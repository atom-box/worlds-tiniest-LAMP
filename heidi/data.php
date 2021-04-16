<?php


require_once '../dbconfig.inc.php';

$user = USER;
$password = SECRET;
$database = NAMEOFDATABASE;  
// NOT CONNECTING.  BUT MAYBE IT SHOULD NOT IF NOT IN LOCALHOST. BUT WHY SILENT FAIL?FDATABASE;
$table = 'sessions';
echo "<h1>This is the data.php page.</h1>";
try {
  $db = new \PDO("mysql:host=localhost;dbname=$database", $user, $password);
  if (is_null($db)){
    var_dump($db); die;
  }
  echo "<h2>SESSIONS</h2><ol>\n\n"; 
  foreach($db->query("SELECT content FROM $table") as $row) {
    echo "<li>" . $row['content'] . "</li>";
  }
  echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


// next action 

// LINE 12 ?  
// NOT CONNECTING.  BUT MAYBE IT SHOULD NOT IF NOT IN LOCALHOST. BUT WHY SILENT FAIL?