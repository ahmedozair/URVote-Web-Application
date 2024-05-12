


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
session_start();
include("db.php");



    // adding my question and inserting it to my sql table 
    if (isset($_POST['addQuestionBtn'])) {
    $question = $_POST['question']; $name = $_POST['name'];$answer1 = $_POST['answer1'];$answer2 = $_POST['answer2']; 
	$answer3 = $_POST['answer3'];$answer4 = $_POST['answer4']; $date = $_POST['date']; $typeof_user = $_POST['typeof_user'];
	$correct_ans = $_POST['correct_ans'];

    $query = "INSERT INTO result_question (question, name, answer1, answer2, answer3, answer4, date, typeof_user, correct_ans) 
    VALUES (TRIM('$question'), TRIM('$name'), TRIM('$answer1'), TRIM('$answer2'), TRIM('$answer3'), TRIM('$answer4'), '$date',
	TRIM('$typeof_user'), '$correct_ans')";


    if (mysqli_query($con, $query)) { echo "<p>successfully  submitted Thank you for youe Question  !</p>"; } else {
     
        echo "<p>Fail to submit question please contact us .</p>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Vote</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>
    <div class="container">
	
	<!-- my form and adding question for user -->
	
        <form id="voteForm" method="POST" class="form-container">
		
            <div class="form-group">
                <input type="text" name="question" 
				placeholder="Question for vote" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="name" 
				placeholder="Your Name" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="answer1" 
				placeholder="Answer 1" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="answer2"
				placeholder="Answer 2" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="answer3" 
				placeholder="Answer 3" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="answer4"
				placeholder="Answer 4" required>
            </div>
			
			<div class="form-group">
                <input type="date" name="date" 
				placeholder="date" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="typeof_user" 
				placeholder="Type of User" required>
            </div>
			
            <div class="form-group">
                <input type="text" name="correct_ans" 
				placeholder="correct answer (e.g., 1, 2, 3, or 4)" required>
            </div>
			
			
            <input type="submit" value="Add MCQ Vote" 
			 name="addQuestionBtn" class="btn">
			
        </form>
    </div>
      
	
</body>
</html>

<!-- reference  -->
<!-- https://stackoverflow.com/questions/55798300/how-to-execute-onclick-before-navigating-to-a-different-page -->
<!-- https://daily-dev-tips.com/posts/vanilla-javascript-four-digit-pincode-field/
     https://webdeveloper.com/community/174451-pin-entry-to-a-webpage/
	 https://www.quora.com/How-do-you-pass-a-variable-from-one-page-to-another-in-JavaScript-and-jQuery#:~:text=The%20easiest%20way%20to%20do,put%20it%20in%20the%20input.
-    https://www.youtube.com/watch?v=PwWHL3RyQgk
     https://www.youtube.com/watch?v=GdrbE-s5DgQ
	 https://www.w3schools.com/php/php_mysql_connect.asp
	 https://www.youtube.com/results?search_query=php+connecting+form+
	 https://www.youtube.com/watch?v=4b0Ewmy0ffE&list=PLsdZGHZMYvk3fMDmqy12KKiHvdWWmmHxI
	 https://www.sanfoundry.com/1000-php-questions-answers/
	 https://www.placementpreparation.io/mcq/css/
	 https://www.placementpreparation.io/mcq/css/
	 https://stackoverflow.com/questions/68134621/add-multiple-choice-questions-to-php-web-form


->
