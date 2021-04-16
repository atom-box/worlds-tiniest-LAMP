 <?php

 ini_set("display_errors", 1);
 error_reporting(E_ALL);

echo "<h2>PHP is Fun!</h2>";
echo "Hello world!<br>";
require("DBTransaction.php");

echo "I'm about to learn PHP!<br>";
echo "This ", "string ", "was ", "made ", "with multiple parameters.";

echo(pi()); // returns 3.1415926535898


?>  