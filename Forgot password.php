<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
		require_once('db_connect.php');
		require_once("lib/function.php");
		include('PHP Mailer/PHPMailerAutoload.php');
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
<?php
$emailErr = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["email"]))
	{
		 $emailErr="Email is required";
	}
	else
	{
		$email=$_POST["email"];
	}
	
}
?>
		
		
		
		<title>Admin | Online MCQ Examination</title>
<style>
   .error{color:red;}
</style>
	</head>

	<body id='login-body' class="bg-light">

        <div class="card col-md-6 offset-md-3 text-center bg-primary mb-4">
            <h3 class="he3-responsive text-white">Online MCQ Examination</h3>
        </div>
		<div class="card col-md-4 offset-md-4 mt-4">
                <div class="card-header-edge text-white">
                    <strong>Forgot Password</strong>
                </div>
            <div class="card-body">
                     <form id="login-frm" METHOD="POST">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
							<span class="error">*<?php echo $emailErr;?></span>
							
                        </div>
                        
                        <div class="form-group text-right">
                            <input class="btn btn-primary btn-block" type="submit"></input>
                        </div>
                        
                    </form>
					<a href="Reset password.php"></a>
            </div>
        </div>

		</body>

        </script>
		<?php
		if ($_SERVER["REQUEST_METHOD"]=="POST") {
	
	if(isset($_POST['email']) && !empty($_POST['email']))
		

	{
		
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		
		$query = "select * from users where email = '".$email."'";
		
		$result = mysqli_query($conn, $query);
		$row=mysqli_fetch_array($result);
		if (mysqli_num_rows($result) == 1) {
		
			$arr = array();
		
				$to = $row['email'];
				$arr = $row	;
				
			$otp = mt_rand(000000,999999);
			$query1 = "update users set otp = ".$otp.", otpused = 0 where 
			email = '".$to."'";
	
			$result1 = mysqli_query($conn,$query1);
			
			if ($result1) {
				$message = "<h3>Your new OTP is ".$otp.". Please do not share</h3>";
				$subject = "Request For OTP";		
				$mailSent = send_mail($to, $message, $subject);
				if ($mailSent) {
					session_start();
					$_SESSION['id'] = $to;
					echo "<script>
								window.location='Reset password.php';
					      </script>";
				} else {
					
				}
				$array = array('status' => '200' , 'details' => $arr);
			}	
			
		}	
		
	} else {
		//echo "asdasasdad"; 
	}	 
}


?>
</script>
</html>