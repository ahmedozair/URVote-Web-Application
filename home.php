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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin for Home</title>
	<!-- style link to my css page -->
    <link rel="stylesheet" href="homeah.css">
    
</head>
<!-- my body include all they need -->
<body>	
<!-- h1 -h3 title which i want to be displayed -->
    <h1>Welcome to URVote Web - Application</h1>
	<h2> URVote will bring</h2>
    <h3> nelexible easy to get feedback from employee you wish URVOTE</h3>
	<!-- my images i  am inputing for slide image for my page putting each image inside a dive -->
   <div>
        <img class="mySlides" src="slide3.jpg">
    </div>
    <div>
        <img class="mySlides" src="slide2.jpg">
    </div>
    <div>
        <img class="mySlides" src="slide4.jpg">
    </div>
    <div>
        <img class="mySlides" src="slide5.jpg">
    </div>
    <div>
        <img class="mySlides" src="slide6.jpg">
    </div>
	
   <!-- javscript for slide images --> 
<script>

         <!-- sarting my slide with 0 and strating my  slide -->
         let slideIndex = 0; startSlideShow(); function startSlideShow() {
         <!--leting my slide to seen and giving it a name myslides  -->
         let slides = document.getElementsByClassName("mySlides");for (let slide of slides) { slide.style.display = "none";
         }

         <!-- slides and its length -->
         slideIndex++; if (slideIndex > slides.length) {
         slideIndex = 1;
         }
         <!-- coming back to image 1 and strt,  displaying style, and letting each image for 3 second or 3000 miliSEC -->
         slides[slideIndex - 1].style.display = "block";  setTimeout(startSlideShow, 3000);
		
    }
</script>

   <!-- adding pargrapgh about my web - application for user to read what is the website about -->
<div class="row">
  <div class="column" style="background-color:#fff; color: ">
  
    <img src="img1p.jpg" alt="Image 1"><br></br>
    <p>URVote web is design by admin
		or remployer ,URVote voting system
        allows them input any question or
        anything they need to inpt for any 
		changes within company they want 
		employees feedback the web is recommended
		and it an easy and flexible way of 
		casting voting anytime and from anywhere.</p>
  </div>
  <div class="column" style="background-color:#fff;">
    
    <img src="img2p.jpg" alt="Image 2"><br></br>
    <p>The organizations need to
		get employees' votes for any new
		policy regulation or issues. The
		issues or arguments are fed into
		the system by the admin. Employees 
		can then cast their vote as yes or no , other.
		or it depend type of answer need MCQ .
		One voter can only post one vote for 
		an argument. Every vote cast is stored 
		in the database for the respective argument</p>
  </div>
  <div class="column" style="background-color:#fff;">

    <img src="img3p.jpg" alt="Image 3"><br></br>
    <p>At the End of the voting process,
		the system counts the total 
		votes and generates a brief 
		report of it to the admin</p>
  </div>
</div>

     <br>
		
<footer>
         <!-- link to site pages and basically contact information about the website -->
        <div class="Address">Address: Ireland</div>
        <div class="Telephone">Telephone: 123456789</div>
        <div class="Contact"><a href="contact.php" class="button contact">Contact</a></div>
        <div class="Linkedin"><a href="https://www.linkedin.com/" class="button linkedin">Linkedin</a></div>
        <div class="Team"><a href="https://www.microsoft.com/en-us/microsoft-teams/download-app?ocid=ORSEARCH_Bing" class="button team">Team</a></div>
        <!-- ending footer -->
</footer>
	 
</body>

<!-- reference  -->
<!-- https://stackoverflow.com/questions/55798300/how-to-execute-onclick-before-navigating-to-a-different-page -->
<!-- https://daily-dev-tips.com/posts/vanilla-javascript-four-digit-pincode-field/
     https://webdeveloper.com/community/174451-pin-entry-to-a-webpage/
	 https://www.quora.com/How-do-you-pass-a-variable-from-one-page-to-another-in-JavaScript-and-jQuery#:~:text=The%20easiest%20way%20to%20do,put%20it%20in%20the%20input.
     https://www.youtube.com/watch?v=749ta0nvj8s
	 https://developer.mozilla.org/en-US/docs/Web/HTML/Element/footer
	 https://www.w3schools.com/howto/howto_css_fixed_footer.asp
	 https://getbootstrap.com/docs/4.0/components/navbar/
	 https://www.w3schools.com/css/css_navbar.asp
	 https://www.youtube.com/watch?v=PwWHL3RyQgk
	 https://www.youtube.com/watch?v=-Yw9gBHE60E
	 https://www.youtube.com/watch?v=WJAYtyKzrn8
	 https://www.youtube.com/watch?v=42Cvtx7TPDQ

-->