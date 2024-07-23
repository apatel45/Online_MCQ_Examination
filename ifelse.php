<!DOCTYPE html>
<html>
	<head>
		<?php include('header.php') ?>
        <?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:home.php');
        }
        ?>
		<title>Login | Online MCQ Examination</title>
	</head>

	<body id='login-body' class="bg-light">

        <div class="card col-md-6 offset-md-3 text-center  mb-4" style="background-color:#F19CBB;">
            <h3 class="he3-responsive text-black">Online MCQ Examination</h3>
        </div>
		<div class="card col-md-4 offset-md-4 mt-4" style="background-color:#F19CBB;">
                <div style="background-color:#F19CBB;">
                    <strong>Login</strong>
                </div>
            <div class="card-body">
                     <form id="login-frm">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
							<label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
						
                        <div class="form-group text-right"  style="background-color:#F19CBB;">
                            <button class="btn btn-block" style="background-color:#FFE4E1;"name="submit">Login</button>
                        </div>
						<?php
							
								$a = admin("a");
								if($a == "1"){
									echo "Succesfully Register in Admin";
								} elseif($a == "Faculty"){
									echo "Succesfully Register in Faculty";
								} else{
									echo "Succesfully Register in Student";
								}
								
						?>
                        
                    </form>
            </div>
        </div>

		</body>