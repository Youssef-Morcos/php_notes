<!DOCTYPE html>

<html>

<head>
<?php /*
	Youssef Morcos
	
*/
?>
<title>New Note</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="author" content="Youssef">
<script>
function customReset()
{
    document.getElementById("subject").value = "";
    document.getElementById("note").value = "";
}
</script>
</head>

<body>


<div class="container" >

<?php

if (isset($_POST['submit'])) { 
    if (empty($_POST['subject']) || empty($_POST['note'])){

        echo "Please give the note a subject and write your note in the text area!";
        $Subject = ""; 
        $Note = "";

    } else {
       
    $Subject = stripslashes($_POST['subject']); 
    $Note = stripslashes($_POST['note']); 

    include("inc_db_localconnection.php");
    $TableName = $_GET['table'];
    $SQLstring = "INSERT INTO $TableName " .
                " (Subject, Note) " . 
                " VALUES( '$Subject', '$Note')";
    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
    }

    if ($QueryResult === FALSE) {
        echo "<p>Unable to save your note " . 
        " information. Error code " . 
        mysqli_errno($DBConnect) . ": " .
         mysqli_error($DBConnect) . "</p>\n";
        ++$errors;
        } 

    }
else{
    $Subject = ""; 
    $Note = "";

} 
?>

<h1>Post New Note</h1> <hr /> 
<form action="PostNote.php?table=<?php echo $_GET['table']; ?>" method="POST"> 
<span style="font-weight:bold">Subject:</span>
<input type="text" name="subject" id="subject" required value="<?php echo $Subject; ?>" /> <br>
<br /> 
<textarea name="note" id="note" required  rows="6" cols="80" ><?php echo $Note; ?></textarea><br /> 
<input type="submit" name="submit" value="Save note" /> 
<input type="button" name="reset" value="Clear" id="reset" onclick="customReset();"/> </form>
<hr /> <p> <a href="NoteBoard.php?table=<?php echo $_GET['table']; ?>">View Notes</a> </p>



	
</div>


</body>
</html>