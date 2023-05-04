<!DOCTYPE html>

<html>

<head>
<?php /*
	Youssef Morcos
	
*/
?>
<title>Note Board</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="author" content="Youssef">
</head>

<body>


<div class="container" >

<h1>Notes Board</h1>

<?php 

include("inc_db_localconnection.php");
$TableName = $_GET['table'];
$MessageArray = array();

$SQLstring = "SELECT * FROM $TableName";
$QueryResult = @mysqli_query($DBConnect, $SQLstring);



if (isset($_GET['action'])) { 
    
        switch ($_GET['action']) { 

            case 'Delete Note': 
                if (isset($_GET['id'])){
                    $deleteSubject = $_GET['id'];
                    $SQLdeleteSubject = "DELETE FROM $TableName WHERE noteid=$deleteSubject";
                    $deleteSubjectResult = @mysqli_query($DBConnect, $SQLdeleteSubject);
                    if($deleteSubjectResult === FALSE){
                        echo 'Unable to delete the selected note';
                    } else {
                        $SQLstring = "SELECT * FROM $TableName";
                        $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    }
                    };
                    break;

            case 'Delete All': 
                $SQLdeleteSubject = "DELETE FROM $TableName";
                $deleteSubjectResult = @mysqli_query($DBConnect, $SQLdeleteSubject);
                if($deleteSubjectResult === FALSE){
                    echo 'Unable to delete all notes';
                }else {
                    $SQLstring = "SELECT * FROM $TableName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                };
            break;

            
            case 'Sort Ascending': 
                $SQLAscending = "SELECT * FROM `$TableName` ORDER BY `$TableName`.`Subject` ASC";
                $QueryResult = @mysqli_query($DBConnect, $SQLAscending);
                if($QueryResult === FALSE){
                    echo 'Unable to sort the notes';
                };
            break;

            case 'Sort Descending': 
                $SQLDescending = "SELECT * FROM `$TableName` ORDER BY `$TableName`.`Subject` DESC";
                $QueryResult = @mysqli_query($DBConnect, $SQLDescending);
                if($QueryResult === FALSE){
                    echo 'Unable to sort the notes';
                };            
                break;
        }

    
}



    if ($QueryResult !== FALSE) { 

        while ($row = mysqli_fetch_row($QueryResult)) {
        array_push($MessageArray, $row);
                }
                
        }

if (count($MessageArray)==0) {
    echo "There is no notes to be displayed";
} else { 
    echo "<table style=\"background-color:lightgray\" border=\"1\" width=\"100%\">\n"; 
       
    $Index = 1;
        
    foreach($MessageArray as $Message) {
    
    echo "<tr>\n"; echo "<td width=\"5%\" style=\"text-align:center; font-weight:bold\">" . $Index . "</td>\n";
    echo "<td width=\"85%\"><span style=\"font-weight:bold\">Subject: </span> " . htmlentities($Message[1]) . "<br />\n";
    echo "<span style=\"font-weight:bold\">Note ID: </span> " . htmlentities($Message[0]) . "<br />\n";
    echo "<span style=\"text-decoration:underline; font-weight:bold\"> Note </span><br />\n" . htmlentities($Message[2]) . "</td>\n";
    echo "<td width=\"10%\" style=\"text-align:center\">" . "<a href='NoteBoard.php?" . "action=Delete%20Note&" . "id=" . $Message[0] . "&table=" .$TableName."'>Delete This Message</a>" . "</td>\n";
    echo "</tr>\n";
    ++$Index; 

    }
    echo "</table>\n";
}



?> 

<p>
<a href="PostNote.php?table=<?php echo $TableName; ?>"> Post New Note</a><br/> 
<a href= "NoteBoard.php?action=Sort%20Ascending&table=<?php echo $TableName; ?>"> Sort Subjects A-Z</a><br />
<a href= "NoteBoard.php?action=Sort%20Descending&table=<?php echo $TableName; ?>"> Sort Subjects Z-A</a><br />
<a href= "NoteBoard.php?action=Delete%20All&table=<?php echo $TableName; ?>"> Delete ALL Notes</a><br />


</p>





	
</div>


</body>
</html>