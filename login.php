<?php

session_start();
include("db.php");

        //checking the server request or th http     // here checking my email and password also set to poet oce user enter the email and password
        if ($_SERVER['REQUEST_METHOD'] == "POST") {  if (isset($_POST['email'], $_POST['password'])) {
	     // here setting my email and password 
        $email = $_POST['email'];  $password = $_POST['password'];

//here i am querying and selecting from my table called form the email and pass
$query = "SELECT * FROM form WHERE email = ? AND password = ?";  $stmt = mysqli_prepare($con, $query);
  
		// using to statement to perpare email password to be string 'ss' //carrying my statment // using prepare in the above and bind here it prvent sql injection 
        mysqli_stmt_bind_param($stmt, "ss", $email, $password); mysqli_stmt_execute($stmt);
		// getting result entered which excute statement 
        $result = mysqli_stmt_get_result($stmt);

      // making sure result contain or have one row     //getiing the row for result 
        if ($result && mysqli_num_rows($result) == 1) { $row = mysqli_fetch_assoc($result);
         // now bring user to home page if the entered correct details
            $_SESSION['email'] = $email . ' ' . $row['password'];  header('location: home.php'); exit;
        } 
		 // message for incorrect details
        }else { echo 'Invalid email or password. Please sign up if you are not registered!';}
          
        } 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>

    <div class="container">
       
        <form id="login" method="POST">
		<!-- my h1 or heading -->
                <h1>Login</h1>
            <div class="box-form login">
			
				<!-- input the email  -->
                <div class="inputBox">
                    <label>Email</label>
                    <input type="email" placeholder="Enter Email" 
					name="email" required><br><br>
                </div>
				
                <div class="inputBox">
                    <label>Password</label>
                    <input type="password" placeholder="Enter Password"
					name="password" required><br><br>
                </div>
				<!-- login button -->
                <div class="inputBox">
                    <button type="submit">LOGIN</button><br><br>
                </div>
				<!-- signup button link to my register page  -->
                <div class="inputBox">
                    <a href="signup.php">SIGNUP</a><br><br>
				<!--	closing tags  -->
                </div>
            </div>
        </form>
    </div>
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
	 

-->