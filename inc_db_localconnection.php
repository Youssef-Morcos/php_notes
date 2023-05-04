<?php 
$errors = 0; 
 $DBConnect = mysqli_connect("localhost:3306", "root", "");
 if ($DBConnect === FALSE) {
     echo "<p>Unable to connect to the database server. " .
     "Error code " . mysql_errno() . ": " .
     mysql_error() . "</p>\n";
     ++$errors;
} else { 
$DBName = "noteuser"; 
$result = @mysqli_select_db($DBConnect, $DBName); 
if ($result === FALSE) {
echo "<p>Unable to select the database. " .
"Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) .
"</p>\n"; ++$errors;
    }
}
?>