<nav>
        <!-- style for my icon -->
        <div class="icon" style="background-color:">
        <div class="icon">
        <b style="color: #004d00;">UR</b><b style="color: #ff9900;">Vo</b><b style="color: #0000b3;">te</b>
        </div>
        </div>
        <!-- my search box -->
        <div class="search-box">
        <input type="text" placeholder="Search...">
        <a href="#">
        <i class="fas fa-search"></i>
        </a>
        </div>
		<!-- link to my different pages in my nav bar -->
        <ul class="links">
        <li><a href="home.php">Home</a></li>
        <li><a href="contact.php">Contact</a></li>
		<!--  my drop down whn i click i wil see all below pages -->
	    <li class="dropdown">
        <a href="#" class="dropbtn">ADMIN</a>
        <div class="dropdown-content">
        <ul><!-- link to my javscript and enter passcode when user onclick on these pages they should recievs prompt to enter pin -->
        <a href="javascript:void(0);" onclick="enterPinAndNavigate('question.php')">Question</a>
        <a href="javascript:void(0);" onclick="enterPinAndNavigate('MCQ.php')">Multiple Choice</a>
        <a href="javascript:void(0);" onclick="enterPinAndNavigate('report.php')">Report</a>
        <a href="javascript:void(0);" onclick="verifyPinAndRedirect('reportMCQ.php')">Report MCQ</a>
       
    </li>
 </ul>
        </div>
        <!-- using javascript to given my drop down nav bar pin -->
<script>
        <!-- function to enter pin  -->          <!-- a prompt allowing user to enter passcode-->
        function enterPinAndNavigate(pageUrl) {const pass = prompt("please enter passcode to acces this page:");
        <!-- passcode-->
        const rightPass = "8175"; 
        <!-- when user correct pass should go the page url  or messege invalid pass-->
        if (pass === rightPass) { window.location.href = pageUrl; }
        else {alert("Please enter the correct passcode.");}
}       <!-- closing script-->
</script>
		
        <li><a href="vote.php">Vote</a></li>
        <li><a href="voteMCQ.php">Vote MCQ</a></li>
        <li><a href="user.php">user</a></li>
        
         <li><a href="login.php">Logout</a></li>
        <label for="" class="bar">
        <span class="fas fa-times" id="times"></span>
        </label>
		<!-- end of my nav bar-->
</nav>            


<?php
include("db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"]; $email = $_POST["email"]; $topic = $_POST["topic"]; $message = $_POST["msg"];

    // insersrting my contact table 
    $query = "INSERT INTO contact (name, email, topic, message) VALUES (?, ?, ?, ?)";

     // preparing and getting the fields and  excuting them and give messege if it was done sucessfully
    if ($stmt = $conn->prepare($query)) {$stmt->bind_param("ssss", $name, $email, $topic, $message);
        $stmt->execute(); echo "successfully  Submitted we will get back soon !."; $stmt->close();
    } 
	
	   else {echo "failed to send your queries please contact us .";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>

    <p>Complete the form below with any inquiries, and we will be in touch with you as soon as possible.</p>

   <!-- starting my form -->
   <div class="box-form">
      
        <form action="user.php" method="POST" class="form-container">
         
		 
		     <!--labeling my fields  -->
                <label for="user">First/Last Name:</label><br></br>
                <input type="text" name="name" id="First/Last Name"><br></br>
          
               
                <label for="mail">Contact Email:</label> <br></br>
				
				 <!-- allow user to input in my field  -->
                <input type="mail" name="email" id="Contact Email"> <br></br>
          
          
                <label for="mod">Topic:</label> <br></br>
                <input type="txt" name="topic" id="Topic"> <br></br>
       
            
                <label for="msg">Description or Issue:</label> <br></br>
                <textarea name="msg" id="msg"></textarea> <br></br>
          
		  
		   <!-- button to submit  -->
            <input type="submit" value="SUBMIT QUERIES" class="button">
        </form>
  

</body>
</html>
<!-- reference  -->
<!-- https://stackoverflow.com/questions/55798300/how-to-execute-onclick-before-navigating-to-a-different-page -->
<!-- https://daily-dev-tips.com/posts/vanilla-javascript-four-digit-pincode-field/
     https://webdeveloper.com/community/174451-pin-entry-to-a-webpage/
	 https://www.quora.com/How-do-you-pass-a-variable-from-one-page-to-another-in-JavaScript-and-jQuery#:~:text=The%20easiest%20way%20to%20do,put%20it%20in%20the%20input.
     https://www.w3schools.com/html/html_forms_attributes.asp
	 https://www.raghwendra.com/blog/how-to-connect-html-to-database-with-mysql-using-php-example/
	 https://www.youtube.com/watch?v=fIYyemqKR58

-->