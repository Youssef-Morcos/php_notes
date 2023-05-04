<!DOCTYPE html>

<html>

<head>
<?php /*
	Youssef Morcos
	
*/
?>
<title>Register User</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="author" content="Youssef">
</head>

<body>


<div class="container" >
<h1>User Registration</h1> 

<?php

$errors = 0; 
$email = ""; 
if (empty($_POST['email'])) {
    ++$errors; 
    echo "<p>You need to enter an e-mail address.</p>\n";
}
else {
    $email = stripslashes($_POST['email']); 
    if (preg_match("/^\\S+@\\S+\\.\\S+$/",
$email) == 0) { 
    ++$errors;
    echo "<p>You need to enter a valid " . "e-mail address.</p>\n";
    $email = "";
}
}

if (empty($_POST['password'])) { 
    ++$errors;
    echo "<p>You need to enter a password.</p>\n"; $password = "";
    }
    else
$password = stripslashes($_POST['password']); 
if (empty($_POST['password2'])) {
    ++$errors; echo "<p>You need to enter a confirmation
    password.</p>\n"; 
    $password2 = " ";
} else
$password2 = stripslashes($_POST['password2']); 
if ((!(empty($password))) && (!(empty($password2)))) {
    if (strlen($password) < 6) { 
        ++$errors;
        echo "<p>The password is too short.</p>\n"; 
        $password = ""; 
        $password2 = "";
        } 
        if ($password <> $password2) {
        ++$errors; echo "<p>The passwords do not match.</p>\n"; 
        $password = ""; 
        $password2 = "";
        }
}

        if ($errors == 0) { 
            include("inc_db_localconnection.php");

        }

        $TableName = "users"; 
        if ($errors == 0) {
            $SQLstring = "SELECT * FROM $TableName where email='$email'";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);
            if ($QueryResult !== FALSE) { 
                $Row = @mysqli_fetch_row($QueryResult); 
                if ($Row != NULL) {
                    echo "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
                ++$errors;
                }
            }
        }

        if ($errors > 0) { echo "<p>Please use your browser's BACK button
            to return" . " to the form and fix the errors indicated.</p>\n";
            }
         

            if ($errors == 0) { 
                $first = stripslashes($_POST['first']); 
                $last = stripslashes($_POST['last']); 
                $SQLstring = "INSERT INTO $TableName " .
                " (first, last, email, password_md5) " . 
                " VALUES( '$first', '$last', '$email', " . 
                " '" . md5($password) . "')";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);

            if ($QueryResult === FALSE) {
                echo "<p>Unable to save your registration " . 
                " information. Error code " . 
                mysqli_errno($DBConnect) . ": " .
                 mysqli_error($DBConnect) . "</p>\n";
                ++$errors;
                } 
                else {
                    $UserID = mysqli_insert_id($DBConnect); 
                }
                
            }
        
        if ($errors == 0) { 
            $UserName = $first . " " . $last; 
            echo "<p>Thank you, $UserName. "; 
            echo "Your new User ID is <strong>" .
                $UserID . "</strong>.</p>\n";
                }

        if ($errors == 0) {
            $SQLcreateTable = "CREATE TABLE notes_".$UserID.  "(NoteID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, Subject VARCHAR(40), Note LONGTEXT)";
            $QueryResult = @mysqli_query($DBConnect, $SQLcreateTable);

            if ($QueryResult === FALSE) {
                echo "<p>Unable to create a note board " . 
                " information. Error code " . 
                mysqli_errno($DBConnect) . ": " .
                 mysqli_error($DBConnect) . "</p>\n";
                ++$errors;
                } 
                mysqli_close($DBConnect);
            }

        
        
        
                
    if ($errors == 0) { 
        echo "<div>
        <a href='PostNote.php?table=notes_" . $UserID . "'> Post New Note</a></span><br/>
        <a href='NoteBoard.php?table=notes_" . $UserID . "'>View Notes</a>
        </div>\n";
        }


?>


	
</div>


</body>
</html>