<?php
		session_start();
		$firstName=$_POST["firstName"];
        $_SESSION["firstName"] = $firstName;
		$lastName=$_POST["lastName"];
        $_SESSION["lastName"] = $lastName;
        $userName = $_POST["userName"];
		$email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_PW = $_POST["confirm_PW"];
		$ID = uniqid();
		
        if($firstName=="" || $lastName=="" || $userName == "" || $password == "" || $confirm_PW == "")  
        {  
            echo "<script>alert('Please confirm the information is completed.'); history.go(-1);</script>";  
        } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            echo "<script>alert('Please enter a valid email address. For example yourname@domain.com.'); history.go(-1);</script>";
        } 
        else  
        {  
            if($password == $confirm_PW)  
            {  
                $con=mysqli_connect("localhost","root","","fashiondb");

                mysqli_query($con, "set names 'gdk'");
                $sql = "select email from clients where email = '$email'";
				$sql_check = "select user_name from clients where user_name = '$userName'";
                $result = mysqli_query($con,$sql);
				$result_check = mysqli_query($con,$sql_check);
                $num = mysqli_num_rows($result);
				$num_check = mysqli_num_rows($result_check);
                if($num) {  
                    echo "<script>alert('The email address has already been registered.'); history.go(-1);</script>";  
                }else if($num_check){
					echo "<script>alert('The username has already been registered.'); history.go(-1);</script>";
				}else{
                    $sql_insert = "insert into clients(first_name,last_name,avatar,ID,user_name,password,email) values('$firstName','$lastName','','$ID','$userName','$password','$email')";  
                    $insert = mysqli_query($con, $sql_insert);  
                    mysqli_close($con);
					
					session_unset();
					$_SESSION["firstName"] = $firstName;
					$_SESSION["lastName"] = $lastName;
					$_SESSION["ID"] = $ID;
					
                    if($insert)  
                    {
						/*$subject="Registration Confirmation";
                        $email_body = '<html>
                                    <head>
                                        <title>Registration Confirmation Email</title>
                                    </head>
                                    <body>
                                    <h1>Registration Confirmation Email</h1>
                                        <p>Dear '.$firstName.',</p>
                                        <p>Your email address '.$email.' has been registered in Fashion Closet.</p>
                                        <p>Thank you for your registration! Your information is as below.</p>
										<p>If you have any questions, please send emails to FashionCloset@gmail.com. Thank you.</p>
                                        <table>
                                            <tr>
                                            <th>First Name</th>
											<th>Last Name</th>
											<th>Username</th>
                                            <th>Email Address</th>
                                            </tr>
                                            <tr>
                                            <td>'.$firstName.'</td>
											<td>'.$lastName.'</td>
											<td>'.$userName.'</td>
                                            <td>'.$email.'</td>
                                            </tr>
                                            </table>
                                    </body>
                                    </html>';
					 $email_alert = "<script type='text/javascript'>alert('Oops...Sorry, there seems to be some technical issues so we did not send the confirmation email.');</script>";
					 require_once 'sendEmail.php';*/
					 
					 echo "<script>window.location.href='account.php';</script>";
                    }  
                    else  
                    {  
                        echo "<script>alert('The system is busy!');</script>";
                    }  
                }  
            }  
            else  
            {  
                echo "<script>alert('Please make sure your passwords match.'); history.go(-1);</script>";  
            }  
        }
?> 