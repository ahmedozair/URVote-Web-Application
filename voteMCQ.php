
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
session_start(); // Start

require("db.php");  // connetion db 

// my vote question 
if (!isset($_SESSION['voted_questions'])) {$_SESSION['voted_questions'] = []; }

// Checking if vote is submitted and process of and exit 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SUBMIT'])) { processVote($con); header("Location: " . $_SERVER['PHP_SELF']);  exit; }

// FETCHING question that are not voted  and defining the the processes of vot
$questions = fetchAvailableQuestions($con);
function processVote($con) {
    
	// using mysqli real escape which it help of sql injection attacks also keep data save 
    $question = $_POST['question']; $name = mysqli_real_escape_string($con, $_POST['name']); $selectedAnswer = mysqli_real_escape_string($con, $_POST['selectedAnswer']);
    $typeof_user = mysqli_real_escape_string($con, $_POST['typeof_user']); $date = mysqli_real_escape_string($con, $_POST['date']);

   
    // Checking if the question is voted 
    if (!in_array($question, $_SESSION['voted_questions'])) { $query = "INSERT INTO result_question(question, name, date, selectedAnswer, typeof_user) VALUES (?, ?, ?, ?, ?)";
		
		// using bind parm same i used i begining of website 
        if ($stmt = mysqli_prepare($con, $query)) { mysqli_stmt_bind_param($stmt, "sssss", $question, $name, $date, $selectedAnswer, $typeof_user);
          
            if (mysqli_stmt_execute($stmt)) { $_SESSION['voted_questions'][] = $question;  $_SESSION['Thanking'] = "Thank you or voting!"; } 
			else {  $_SESSION['fails'] = "you failed to submit your please contact us : " . mysqli_stmt_error($stmt); }
           
            mysqli_stmt_close($stmt);
        } else {  $_SESSION['fails'] = "in a proceess setting error: " . mysqli_error($con);
        }
    } else { $_SESSION['thanking '] = "you have all ready voted thanks .";
    }
}

// fetching and selecting my question  and returining result 
function fetchAvailableQuestions($con) { $query = "SELECT question, answer1, answer2, answer3, answer4 FROM result_question";
  $result = mysqli_query($con, $query); return $result; }


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


// Checking my questiong to process and also question that fetch from database using loop while
if ($questions && mysqli_num_rows($questions) > 0) { while ($row = mysqli_fetch_assoc($questions)) {

        // making sure if question is voted  
        if (!in_array($row['question'], $_SESSION['voted_questions'])) { $questionHtml = htmlspecialchars($row['question']); ?>
		
		
		<!-- starting my container fellow with my question  -->
            <div class='question-container'><h3><?php echo $questionHtml; ?></h3>
		<!-- is the question and what i will input -->
                <form method='POST'>
				
                    <input type='hidden' name='Question' 
					value='<?php echo $questionHtml; ?>'>
					
					<label>ENTER FIRST AND LAST NAME </label>
                    <input type='Name' name='Name' 
					required placeholder='please enter  name '>
					
					<label>ENTER USER </label>
                    <input type='text' name='typeof_user' 
					required placeholder='type user '>
					
					<label>ENTER TODAY DATE</label> 
                    <input type='date' name='date' 
					required placeholder='YYYY-MM-DD'>
					
            <?php
			
            //  ANSWER any question 1 -4 
			
            for ($i = 1; $i <= 4; $i++) { $answerKey = "answer" . $i; if (isset($row[$answerKey])) { $answerValue = htmlspecialchars($row[$answerKey]); ?>
                    
					
					<div class='answer-container'>
					<!-- selecting answer --> 
					
                        <input type='radio' name='selectedAnswer' 
						value='<?php echo $answerValue; ?>' id='answer<?php echo $i; ?>' required>  <label for='answer<?php echo $i; ?>'><?php echo $answerValue; ?></label> </div>
                    <?php
                }
            }
            ?>
			
			
                    <input type='submit' value='Submit Your Vote' name='submitVote' class='btn'>
                </form>
            </div>
            <?php
        }
    }
} else { echo "<p>there is no question for vote .</p>";
}

$content = ob_get_clean(); echo $content;
?>
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
    https://www.youtube.com/watch?v=fj81o4bqoNw
	https://stackoverflow.com/questions/24306486/multiple-choice-list-to-php-request

->