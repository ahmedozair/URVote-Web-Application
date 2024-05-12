<?php

        session_start();

         // Setting validation and given code to the page 
         $permitPin = "8175"; $selectPage = $_POST['page'];

         // Checking if my PIN is correct if in case pin is correct they rediect me to page i want if not give messege
         if ($_POST['pin'] === $permit) {header("Location: $selectPage"); exit;
		 
}        else {$_SESSION['error'] = "The pin entered is not valid Please contact us.";
        header("Location: home.php");exit;
}


?>

<script>
         <!-- function to enter pin  -->          <!-- a prompt allowing user to enter passcode-->
         function enterPinAndNavigate(pageUrl) {const pass = prompt("please enter passcode to acces this page:");
    
	     <!-- coming back to my php page 
         fetch('confirmPin.php', { method: 'POST',  headers: {'content-type': 'application/x-www-form-urlencoded', 
         body: 'code=' + encodeURIComponent(pin) + '&page=' + encodeURIComponent(pageUrl) 
		
    })
	
	     <!-- when user is sucess it will response ND BRING TO THE Pelse it will not --> 
         .then(response => {
         if (response.ok) { window.location.href = pageUrl;
         } else {alert("Please enter the correct pass");
         }
    })
	     <!-- any fault -->
         } catch (fault) {   console.error('Fault:', fault);
         }
    }
	
</script>

<!-- reference  -->
<!-- https://stackoverflow.com/questions/55798300/how-to-execute-onclick-before-navigating-to-a-different-page -->
<!-- https://daily-dev-tips.com/posts/vanilla-javascript-four-digit-pincode-field/
     https://webdeveloper.com/community/174451-pin-entry-to-a-webpage/
	 https://www.quora.com/How-do-you-pass-a-variable-from-one-page-to-another-in-JavaScript-and-jQuery#:~:text=The%20easiest%20way%20to%20do,put%20it%20in%20the%20input.
-->