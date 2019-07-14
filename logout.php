<?php
    session_start();
    
    if(isset($_POST["submit"]) && $_POST["submit"] == "Logout"){
		session_unset();
        echo "<script>alert('You are now logged out.'); window.location.href='login.php'; </script>";
        
    }
?>