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
        <a href="javascript:void(0);" onclick="verifyPinAndRedirect('reportMCQ.php')">Report MCQ</a>
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
    include("db.php");

    // selecting my field from my table 
    $query = "SELECT DISTINCT vote_question FROM question ORDER BY vote_question"; $result = mysqli_query($con, $query);


    // Checking and fetching my result for voting question 
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) { $currentQuestion = htmlentities($row['vote_question'], ENT_QUOTES, 'UTF-8');
       
    $formId = "form-" . urlencode($currentQuestion);

    // querying my vote  
    $votesQuery = "SELECT fname, lname, vote_option FROM question WHERE vote_question = ?";
    $votesStmt = $con->prepare($votesQuery);  $votesStmt->bind_param("s", $currentQuestion);  $votesStmt->execute();
    $votesResult = $votesStmt->get_result(); $totalVotes = $votesResult->num_rows; $yesCount = $noCount = $otherCount = 0;
    // counting my vote using while loop
    while ($vote = $votesResult->fetch_assoc()){ 
    $voteOption = strtolower($vote['vote_option']); if ($voteOption == 'yes') { $yesCount++;}
    elseif ($voteOption == 'no') {  $noCount++; 
               
    } else { $otherCount++; 
			
			
    }
    }

     // my data for chart 
     $dataPoints = [
    ['label' => "Yes", 'y' => $yesCount],  ['label' => "No", 'y' => $noCount],['label' => "Other", 'y' => $otherCount] ];
?>

    <!-- my container -->
    <div class="container">
   
    <a href="vote.php" class="section">
	<!-- this is button where displaying my question for vote -->
    <button type="button" 
	style="background-color:#e0e0d1; height: 40px; width: 100%;">Question Voted 
	<?php echo $currentQuestion; ?>"</button>
		
    </a>

    <!-- my chart  -->
    <div class="CHART-section section">
    <div style="height: 200px; width: 200px;"
	class="chartContainer" data-points='<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>'></div>
    </div>

    <!-- my table-->

    <div class="TABLE-section section">
    <table border="1"> 
            <tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Vote Option</th></tr>
			
			
    <?php
     $votesResult->data_seek(0); 
    while ($vote = $votesResult->fetch_assoc()) {
    echo "<tr><td>" . htmlspecialchars($vote['fname']) . "</td>";   echo "<td>" . htmlspecialchars($vote['lname']) . "</td>";
     echo "<td>" . htmlspecialchars($vote['vote_option']) . "</td></tr>";
     }
    ?>
    </table>
    </div>
     <!-- getting my % for yes, no , and other / counting them -->
    <div class="PERCENTAGE-section section">
	
    <p>MY TOTAL VOTES: <?php echo $totalVotes; ?></p><p>Yes: <?php echo $yesCount; ?></p>
     <p>No: <?php echo $noCount; ?></p>  <p>Other: <?php echo $otherCount; ?></p>
       
    </div>
    </div>
   <!-- messge if there is no result -->
<?php
    }
    } else {echo "<p>No results founded.</p>";
}
?>
     </form>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>

    <!--javascript for chart  -->
    window.onload = function () {

    var charts = document.querySelectorAll('.chartContainer'); charts.forEach(function(chart) {

	<!-- Using CanvasJS with the parsed data displaying the chart by its requirement -->
    var chartData = JSON.parse(chart.getAttribute('data-points')); new CanvasJS.Chart(chart, {

    animationEnabled: true, theme: "light2",  title: { text: "My Voting Results" },axisY: { includeZero: true },
    data: [{ type: "column", dataPoints: chartData }]}).render();
        });
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
	 
	 -->