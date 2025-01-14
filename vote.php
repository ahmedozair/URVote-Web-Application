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

    // set vote if the need and remove the session as user voted already
    if (isset($_POST['hideVotes'])) { unset($_SESSION['voted']); }

    // add question 
    if (isset($_POST['addQuestionBtn'])) {
    
    $fname = $_POST['fname'];  $lname = $_POST['lname']; $typeof_user = $_POST['typeof_user'];
    $vote_option = $_POST['vote_option'] === 'Other' ? $_POST['other_option'] : $_POST['vote_option']; $vote_question = $_POST['vote_question'];

    // inserting to my question table 
    $query = "INSERT INTO question(vote_question, fname, lname, typeof_user, vote_option) VALUES ('$vote_question', '$fname', '$lname', '$typeof_user', '$vote_option')";

 
    if (mysqli_query($con, $query)) {
	    // mark the question and thanking for voting the back to vote page
        $_SESSION['voted'][$vote_question] = true;  $_SESSION['Thank You'] = "Thank you for voting!"; header("Location: vote.php "); exit;
    
	// else will be given error if fail
	} else {echo "Error: " . mysqli_error($con);}
}

     // query  and select from my table 
    $query = "SELECT * FROM question"; $result = mysqli_query($con, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Vote on Questions</title>
     <link rel="stylesheet" href="stylevotes.css">
</head>
<body>
     <div class="container">
  <?php

  // Checking the session for appreciation and removing it after it's set
if (isset($_SESSION['Thnks'])) {
?>
    <p><?= $_SESSION['Thanks'] ?></p>
<?php
    unset($_SESSION['Thanks']);
}

    // Check if the query result has one or more rows
    if (isset($result) && mysqli_num_rows($result) > 0) {
    // using loop along rows
    while ($row = mysqli_fetch_assoc($result)) {
     // Assign the 'vote_question' field value to a variable
    $vote_question = $row['vote_question'];

    // Checking if the question has been voted yet
    if (!isset($_SESSION['voted'][$vote_question])) {
?>
    <!-- div starting with question container -->
    <div class='question-container'>
			
    <h3><?= htmlspecialchars($vote_question) ?></h3>
				
    <form method='POST'>
				
    <input type='hidden' name='vote_question' 
	value='<?= htmlspecialchars($vote_question) ?>'>
     <!-- inputing my details for voting and submit my vote -->               
     <label for='fname'>First Name:</label>
     <input type='text' id='fname' name='fname' 
	placeholder='First Name' required >
                    
    <label for='lname'>Last Name:</label>
    <input type='text' id='lname' name='lname' 
	placeholder='Last Name' required >
                    
    <label for='typeof_user'>Type of User:</label>
    <input type='text' id='typeof_user' name='typeof_user'
	placeholder='Type of User' required >
                    
	<!-- here is where my vote process for yes no and other and it wiill display option   -->
    </div>
     <div class="form-group">
    <select name="vote_option" id="vote_option" 
	onchange="showOtherInput();" required>
    <option value="">Select an option</option>
     <option value="Yes">Yes</option>
     <option value="No">No</option>
    <option value="Other">Other</option>
    </select>
    </div>

    <div id="otherInput" style="display: none;">
    <label for="other_input">Other:</label>
    <input type="text" id="other_input" name="other_input" placeholder="Enter your vote">
    </div>
     
    <!-- my button which submit the vote -->
     <input type='submit' value='Submit Vote' name='addQuestionBtn' class='btn'>
     </form><!-- closing form and container -->
    </div><br>
<?php
        }
    }
	// displaying messege if there is no question avaible 
    }else {echo "No questions available for vote";
}
?>
   




	<!-- using javascript for my option giving it toggle when the user hover over the button they will be able to see the option -->
	<script>
     function showOtherInput() {
	// getting back html for vote option and other option 
    var selectBox = document.getElementById('vote_option'); var otherInputDiv = document.getElementById('otherInput');
	// or else it will not display anything for not select other 
    therInputDiv.style.display = selectBox.value === 'Other' ? 'block' : 'none';
        
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
	 https://www.youtube.com/results?search_query=php+connecting+form+
	 https://www.youtube.com/watch?v=4b0Ewmy0ffE&list=PLsdZGHZMYvk3fMDmqy12KKiHvdWWmmHxI
	 https://www.sanfoundry.com/1000-php-questions-answers/
	 https://www.placementpreparation.io/mcq/css/
	 https://www.placementpreparation.io/mcq/css/
	 https://stackoverflow.com/questions/68134621/add-multiple-choice-questions-to-php-web-form
    https://www.youtube.com/watch?v=fj81o4bqoNw
	

->