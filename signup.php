<?php

session_start();

     // the db.php is my database class where i have connected my pages to the database tables
    include("db.php");

    //the POST is  making sure for sending user below requirment to my data
    if (isset($_POST['fname'], $_POST['lname'], $_POST['workplace'], $_POST['email'], $_POST['password'], $_POST['typeof_user'])) {
	
    // collecting the first name , last name etc and inputing to my data
    $fname = $_POST['fname']; $lname = $_POST['lname']; $workplace = $_POST['workplace']; $email = $_POST['email']; $password = $_POST['password'];

    // making sure my email and psssword are inputted and also email is not numric so it use string 
    if (!empty($email) && !empty($password) && !is_numeric($email)) {
	//inserting my fields to my data base 
     $query = "INSERT INTO form (fname, lname, workplace, email, password) VALUES (?, ?, ?, ?, ?)";
		
		
	// using the sql statment here which also it protect of sql injection attack and also binding varaible 
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $fname, 
	$lname, $workplace, $email, $password, $typeof_user);  mysqli_stmt_execute($stmt);


    // comments if they are success to sign up 
    echo "Thanks Your Successfully Registered";
    } 

    // comments if they are unsuccess to sign up 
	else {
        echo "Please input all the above requirment ";
    }
}


?>


<!-- my html -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Signup page</title>
	<!-- link to my css class -->
    <link rel="stylesheet" href="stylesignup.css">
</head>
<body>


    <!-- begin of my div container -->
    <div class="container">
         
        <form id="signup" method="POST">
		<h1> SIGN UP</h1>
	    <!--label or naming my input, placehoder appear before writing anythin 
		and fname is what is called in my table with required which must be there -->
        <div class="inputBox">
        <label>First Name</label>
        <input type="First Name" 
		placeholder="Enter First name"
   		name="fname" required><br><br>
        </div>
				
				
        <div class="inputBox">
        <label>Last Name</label>
        <input type="Last Name" 
		placeholder="Enter Last name"
		name="lname" required><br><br>
        </div>


        <div class="inputBox">
        <label>Workplace</label>
        <input type="workplace" 
		placeholder="Enter Workplace"
		name="workplace" required><br><br>
        </div>
				
       <div class="inputBox">
        <label>Email</label>
         <input type="email"
		placeholder="Enter Email" 
		name="email" required><br><br>
         </div>
				
        <div class="inputBox">
        <label>Password</label>
        <input type="password" 
		placeholder="Enter Password" 
		name="password" required><br><br>
       </div>
               
        <div class="inputBox"><button type="submit">SUBMIT</button><br><br></div>
		<!-- linking back to my login page --> 
        <div class="inputBox"><a href="login.php">LOGIN</a><br></br></div>
				
				
        </form><!-- closing my form -->
		<!-- closing my div -->
        
         </div>
	
	    <!-- closing my body and html -->
</body>
</html>

<!-- reference  -->
<!-- 
	 https://www.quora.com/How-do-you-pass-a-variable-from-one-page-to-another-in-JavaScript-and-jQuery#:~:text=The%20easiest%20way%20to%20do,put%20it%20in%20the%20input.
     https://www.w3schools.com/howto/howto_css_login_form.asp
	 https://www.simplilearn.com/tutorials/php-tutorial/php-login-form
	 https://www.youtube.com/watch?v=JDn6OAMnJwQ
	 https://www.youtube.com/watch?v=H-BKTz8QNyQ
	 https://www.youtube.com/watch?v=1C8lGN-1Sq0
	 https://www.youtube.com/watch?v=HN4rmD-9aYY
	 https://www.youtube.com/watch?v=1zXqo2WcOew
	 https://www.geeksforgeeks.org/signup-form-using-php-and-mysql-database/

-->