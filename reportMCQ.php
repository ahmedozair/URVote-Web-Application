


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
		<li><a href="javascript:void(0);" onclick="enterPinAndNavigate('user.php')">User</a></li>
		
		<!--  my drop down whn i click i wil see all below pages -->
	    <li class="dropdown">
        <a href="#" class="dropbtn">ADMIN</a>
        <div class="dropdown-content">
        <ul><!-- link to my javscript and enter passcode when user onclick on these pages they should recievs prompt to enter pin -->
        <a href="javascript:void(0);" onclick="enterPinAndNavigate('question.php')">Question</a>
        <a href="javascript:void(0);" onclick="enterPinAndNavigate('MCQ.php')">Multiple Choice</a>
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
        
        
         <li><a href="login.php">Logout</a></li>
        <label for="" class="bar">
        <span class="fas fa-times" id="times"></span>
        </label>
		<!-- end of my nav bar-->
</nav>            


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detailed Voting Results</title>
    <link rel="stylesheet" href="report.css">
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</head>
<body>
 <?php
    // Include the database connection script
    include("db.php");

    // Select everything in order from the table query and output
    $query = "SELECT DISTINCT question FROM result_question ORDER BY question";
    $result = mysqli_query($con, $query);
    $output = "";

    // Checking if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Loop through each question
        while ($row = mysqli_fetch_assoc($result)) {
            // Get the current question and encode it for use in IDs
            $currentQuestion = $row['question'];
            $encodedQuestion = urlencode($currentQuestion);

            // Selecting results for the current question
            $votesQuery = "SELECT name, typeof_user, answer1, answer2, answer3, answer4, date, selectedAnswer, correct_ans 
                           FROM result_question WHERE question = '{$currentQuestion}'";
            $votesResult = mysqli_query($con, $votesQuery);

            // Building the HTML for the table
            $output .= "<div id='form-{$encodedQuestion}' class='question-form'> <h2>{$currentQuestion}</h2> 
                        <div class='details-container'>
                        <button onclick='toggleVisibility(\"table-{$encodedQuestion}\")'>RESULT IN TABLE</button>
                        <div id='table-{$encodedQuestion}' class='table-section' style='display: none;'>
                        <table border='1'>
                        <tr>
                        <th>Name</th><th>Type of User</th><th>Answer 1</th><th>Answer 2</th><th>Answer 3</th>
                        <th>Answer 4</th><th>Date</th><th>Selected Answer</th><th>Correct Answer</th>
                        </tr>";

            // Fetching MY results for the current question
            while ($vote = mysqli_fetch_assoc($votesResult)) {
                $output .= "<tr>
                            <td>{$vote['name']}</td><td>{$vote['typeof_user']}</td><td>{$vote['answer1']}</td>
                            <td>{$vote['answer2']}</td><td>{$vote['answer3']}</td><td>{$vote['answer4']}</td>
                            <td>{$vote['date']}</td><td>{$vote['selectedAnswer']}</td><td>{$vote['correct_ans']}</td>
                            </tr>";
            }

            // Closing MY table and question sections
            $output .= "</table>
                        </div>
                        </div>
                        </div>";
        }
    } else {
        // No results found message
        $output .= "<p>No results found. Please contact for more information.</p>";
    }

    // Outputting the generated HTML
    echo $output;
?>

<!-- JavaScript function for toggling visibility -->
<script>
    function toggleVisibility(sectionId) {
        var section = document.getElementById(sectionId);
        section.style.display = (section.style.display === 'none' || section.style.display === '') ? 'block' : 'none';
    }
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
	 https://www.youtube.com/watch?v=dMoLQDudqI0
	 https://www.shecodes.io/athena/38917-how-to-display-the-current-date-and-time-in-javascript#:~:text=You%20can%20display%20the%20current,the%20date%20and%20time%20string.&text=In%20this%20code%2C%20we%20first,with%20an%20id%20of%20datetime%20.
	 https://canvasjs.com/
	 https://stackoverflow.com/questions/40333689/vote-counter-in-html-js
	 https://w3schools.invisionzone.com/topic/49596-javascript-voting-system/
	 https://www.codexworld.com/online-poll-voting-system-php-mysql/
	 https://www.sourcecodester.com/php/14690/online-voting-system-phpmysqli-full-source-code.html
	 https://www.youtube.com/watch?v=Ea3fL3C5xI0&list=PLpM5m9c7BI6Ij40Q4uAYrFnIvLyIBV71Q
	 https://www.youtube.com/watch?v=FDjGXTxAnsA
	 https://stackoverflow.com/questions/68144318/html-how-to-display-toggle-a-table-after-a-button-is-clicked
	 https://www.youtube.com/watch?v=jBIoUWLghnY
	 https://www.youtube.com/watch?v=ieKaRXRjsGg
	 https://www.geeksforgeeks.org/how-to-toggle-between-hiding-and-showing-an-element-using-javascript/
	 https://ux.stackexchange.com/questions/129889/toggle-button-on-a-table-field
	 https://www.w3schools.com/php/php_mysql_create_table.asp
	 https://stackoverflow.com/questions/27038037/creating-html-table-with-php-output
	 https://stackoverflow.com/questions/27038037/creating-html-table-with-php-output
	 
	 -->
