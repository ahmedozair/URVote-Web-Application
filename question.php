
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

if (isset($_POST['addQuestionBtn'])) {
  
    $vote_question = $_POST['vote_question'];   $fname = $_POST['fname']; $lname = $_POST['lname'];
    $date = $_POST['date'];  $typeof_user = $_POST['typeof_user']; $vote_option = $_POST['vote_option'];

    // i am querying all field and inserting so it will be save in the question table in my database 
    $query = "INSERT INTO question (vote_question, fname, lname, date, typeof_user, vote_option) VALUES ('$vote_question', '$fname', '$lname', '$date', '$typeof_user', '$vote_option')";

    $result = mysqli_query($con, $query);

    // Checking if the vote is submitted or not 
    if ($result) {
        echo "Question submitted successfully!";
    } else {
        echo "Unable to submit question.";
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
 <script>
        function showOtherInput() {
        var selectBox = document.getElementById('vote_option');
         var otherInputDiv = document.getElementById('otherInput');
        otherInputDiv.style.display = selectBox.value === 'Other' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="button-question">
        <button id="questionBtn" class="btn btn-primary">ADD QUESTION FOR VOTE</button>
    </div>
    
    <form id="voteForm" method="POST" class="form-container">
	
    <div class="form-group">
	<label> Question </label>
     <input type="text" name="vote_question" 
	placeholder="Question for vote" required>
    </div>
		
    <div class="form-group">
	<label> First Name </label>
    <input type="text" name="fname" 
	placeholder="First Name" required>
    </div>
		
    <div class="form-group">
	<label> Last Name </label>
    <input type="text" name="lname" 
	placeholder="Last Name" required>
     </div>
		
    <div class="form-group">
	<label> Voting Date </label>
    <input type="date" name="date" required>
    </div>
		
     <div class="form-group">
	 <label> User / admin </label>
    <input type="text" name="typeof_user" 
	placeholder="Type of User" required>
    </div>


    <div class="form-group">
    <label> Select your option for vote </label>
    <select name="vote_option" id="vote_option" onchange="showOtherInput();" required>
    <option value="">Select an option</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
     <option value="Other">Other</option>
     </select>
    </div>

    <div id="otherInput" style="display: none;">
    <label for="other_input">Other:</label>
    <input type="text" id="other_input" name="other_input" 
	placeholder="Enter your vote">
    </div>

    <input type="submit" value="Add Vote" name="addQuestionBtn" class="btn">
    </form>
	
<!-- toggle button when user that the question will be display -->
<!-- vote form which is my question form that i add for my vote when i click at the button the question is form will be display and when i click it back it will disapear -->
   

<script>
    document.getElementById('questionBtn').addEventListener('click', function() {
    var voteForm = document.getElementById('voteForm'); if (voteForm.style.display === 'none') {
    voteForm.style.display = 'block';
    } else { voteForm.style.display = 'none'; } 
});
</script>

   
  
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
	 https://www.youtube.com/watch?v=UHnqP6MjBQQ
	 https://stackoverflow.com/questions/28638630/php-select-yes-or-no-yes-causes-a-new-input-to-appear
	 https://stackoverflow.com/questions/40479768/create-a-quiz-using-form-from-html-and-javascript/40479914
	 https://www.sitepoint.com/simple-javascript-quiz/
	 https://www.youtube.com/watch?v=hIRjlG-gbuI
	 https://www.youtube.com/watch?v=83TeR8zOrjY 
	 -->