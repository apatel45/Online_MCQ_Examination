<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php require_once('db_connect.php');
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<title>Login | Online MCQ Examination</title>
	</head>

	<body id='login-body' class="bg-light">

        <div class="card col-md-6 offset-md-3 text-center bg-primary mb-4">
            <h3 class="he3-responsive text-white">Online MCQ Examination</h3>
        </div>
		<div class="card col-md-4 offset-md-4 mt-4">
                <div class="card-header-edge text-white">
                    <strong>REGISTRATION FORM</strong>
                </div>
            <div class="card-body">
                     <form id="login-frm" Method="POST">
                        
						<div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
						<div class="form-group">
                            <label>Username</label>
                            <input type="username" name="username" class="form-control">
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
							<label>Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>
						 <div class="form-group">
						<select name="role">
							<option value="1">Admin</option>
							<option value="2">Faculty</option>
							<option value="3">Student</option>
							</select>
						 </div>
                        <div class="form-group text-right">
                            <input class="btn btn-primary btn-block" type="submit">
                        </div>
						
							
						
                        
                    </form>
            </div>
        </div>
		<?php
				   if($_SERVER["REQUEST_METHOD"]=="POST")
				   {
					   if( isset($_POST["username"]) && isset($_POST["email"]) 
						   &&  isset($_POST["password"])&&  isset($_POST["name"])&& isset($_POST["role"]) 
						  )
					   {
						 
						 $name=$_POST["name"];
						 $username=$_POST["username"];
						 $email=$_POST["email"];
						 $password=$_POST["password"];
					     $role=$_POST["role"];
					    
			             // $pwd=implode("",$password);
						 
	                     
						 if($name!='' && $username!='' && $email!='' &&  $password!='')
					   {
						   $sql="insert into users(name,username,email,password,status,user_type)
						   values('".$name."','".$username."','".$email."','".$password."','1','".$role."')";
						  // echo $sql;
						   //die;
						   $result=mysqli_query($conn,$sql);
						   
						   if($result)
						   {
							   echo"<meta http-equiv='refresh' content='0;url=login.php'>";
						   }
						   else
						   {
							   echo"check your result";
						   }
					   }
				   }
				   else
				   {
					   echo"value not set";
				   }
	}
?>

		</body>

        
</html>