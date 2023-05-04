<!DOCTYPE html>

<html>

<head>
<?php /*
	Youssef Morcos
	
*/
?>
<title>Verify User Login</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="author" content="Youssef">
</head>

<body>


<div class="container" >

<h1>Verify User Login</h1> 

<?php

include("inc_db_localconnection.php");


    $TableName = "Users"; 
    if ($errors == 0) {
        $SQLstring = "SELECT UserID, first, last FROM $TableName"
        . " where email='" . stripslashes($_POST['email']) . "' and password_md5='" . 
        md5(stripslashes($_POST['password'])) . "'";
        $QueryResult = @mysqli_query($DBConnect, $SQLstring); 
        if ($QueryResult=== FALSE) {
            echo "<p>The e-mail address/password " . 
            " combination entered is not valid. 
            </p>\n";
            ++$errors;
            }
            else {
                $Row = mysqli_fetch_assoc($QueryResult);
                $UserID = $Row['UserID']; 
                $UserName = $Row['first'] . " " . 
                $Row['last'];
                echo "<p>Welcome back, $UserName!</p>\n";
                }
            }
        
        if ($errors > 0) { echo "<p>Please use your browser's BACK button to return " . 
            " to the form and fix the errors indicated.</p>\n";
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