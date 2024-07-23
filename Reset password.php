<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
		require_once('db_connect.php');
		
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<?php		
$otp = $pass = $cpass = "";
$otpErr = $passErr = $cpassErr = "";
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
	if(empty($_POST["otp"]))
	{
		$otpErr="OTP is required";
	}
	else
	{
		$otp=$_POST["otp"];
	}
	if(empty($_POST["pass"]))
	{
		$passwordErr="Password is required";
	}
	else
	{
		$pass=$_POST["pass"];
	}
	if(empty($_POST["cpass"]))
	{
		$cpasswordErr="Confirm Password is required";
	}
	else
	{
		$cpass=$_POST["cpass"];
	}
	if(isset($_POST["otp"]) && $_POST["pass"])
	{
	
	$id=$_SESSION['id'];
	$otp = $_POST['otp'];
	$nPass = $_POST['pass'];
	//$enpass=password_hash($nPass,PASSWORD_DEFAULT);
	$cPass = $_POST['cpass'];
	
	if ($nPass != $cPass) {
		echo "password must be same";
		exit;
	}
	
	$query = "update users  set otpused = 1, 
	password = '".$pass."' where email='".$id."' and 
	otp = '".$otp."'";
	
	echo $query;
	//echo $sql;
	//die;
	
	$result = mysqli_query($conn, $query);
	if ($result) {
		
		echo "		<script>
						alert('Password Sucessfully Reset !');
						window.location='login.php';
					</script>";
	
	
	}
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
                            <label>OTP</label>
                            <input type="text" name="otp" class="form-control">
							<span class="error">*<?php echo $otpErr;?></span>
                        </div>
			            
						<div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="pass" class="form-control">
							<span class="error">*<?php echo $passErr;?></span>
                        </div>
						
						<div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="cpass" class="form-control">
                            <span class="error">*<?php echo $cpassErr;?></span>
                       </div>
                        
                        <div class="form-group text-right">
                         <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </div>
                        
                    </form>
					
            </div>
        </div>

		</body>
		

