<!DOCTYPE html>

<html>

<head>
<?php /*
	Youssef Morcos
	
*/
?>
<title>My Notes - Log in</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="author" content="Youssef">
</head>

<body>


<div class="container" >

<h1>My Notes</h1>
 <h2>Register / Log In</h2> 
 <p>New user, please complete the top form to register as a user. Returning users, please complete the second form to log in.</p> 
 <hr />

 <h3>New User Registration</h3> 
 <form method="post" action="Register.php"> 
    <p>Enter your name: First <input type="text" name="first" />
    Last: <input type="text" name="last" /></p> 
    <p>Enter your e-mail address:<input type="text" name="email" /></p> 
    <p>Enter a password for your account: <input type="password" name="password" /></p> 
    <p>Confirm your password: <input type="password" name="password2" /></p> 
    <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p> 
    <input type="reset" name="reset" value="Reset Registration Form" /> 
    <input type="submit" name="register" value="Register" /> 
</form> 
<hr />

<h3>Returning User Login</h3> 
<form method="post" action="VerifyLogin.php"> 
    <p>Enter your e-mail address:<input type="text" name="email" /></p> 
    <p>Enter your password: <input type="password" name="password" /></p> 
    <p><em>(Passwords are case-sensitive and must be at least 6 characters long)</em></p> 
    <input type="reset" name="reset"value="Reset Login Form" /> 
    <input type="submit" name="login" value="Log In" /> 
</form> <hr />





<?php

?>


	
</div>


</body>
</html>