<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
    <title>Edit Profile</title>
</head>
<?php
						$id=$_SESSION['First_name'];
						$sql="select * from user_table where user_id=$id";
						$result=mysqli_query($conn,$sql);
						$row=mysqli_fetch_array($result);
						?>
						
						<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['First_name'];?></h5>
						
					<?php
						//session_start();
						$id=$_SESSION['First_name'];
						$sql="select * from user_table where user_id=$id";
						$result=mysqli_query($conn,$sql);
						$row=mysqli_fetch_array($result);
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['e_email'];?>
		
<div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <?php
						                                   $id=$_SESSION['First_name'];
						                                   $sql="select * from user_table where user_id=$id";
						                                   $result=mysqli_query($conn,$sql);
						                                   $row=mysqli_fetch_array($result);
														?>
						
														<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['First_name'];?></h5>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <?php
															//session_start();
															$id=$_SESSION['First_name'];
															$sql="select * from user_table where user_id=$id";
															$result=mysqli_query($conn,$sql);
															$row=mysqli_fetch_array($result);
															?>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['e_email'];?>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                                        </div>
                                                       
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['address'];?>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Contact Number <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                       
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['contact_no'];?>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
											
<div id="profile-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Account Setting</h4>
                                                        <?php
														$id=$_SESSION['First_name'];
														$sql="select * from user_table where user_id= $id ";
														$result=mysqli_query($conn,$sql);
														$row=mysqli_fetch_array($result);
														?>
                                                        <form method="POST">
                                                            <div class="form-row">
															<div class="form-group col-md-6">
                                                                    <label>First Name</label>
                                                                    <input type="text"  class="form-control" name="fname" id="example-text-input" 
																	value="<?php echo $row['First_name'];?>">
                                                                </div>
																<div class="form-group col-md-6">
                                                                    <label>Last Name</label>
                                                                    <input type="text"  class="form-control" name="lname" id="example-text-input" 
																	value="<?php echo $row['Last_name'];?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Email</label>
                                                                    <input type="email"  class="form-control" name="email" id="example-text-input" 
																	value="<?php echo $row['e_email'];?>">
																	
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Password</label>
                                                                    <input type="password" class="form-control"  name="pass" id="example-text-input" 
																	value="<?php echo $row['password'];?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text"  class="form-control"  name="add" id="example-text-input" 
																	value="<?php echo $row['address'];?>">
                                                            </div>
															<div class="mb-3">
                                                               <label>Contact No</label>
                                                               <input type="text" class="form-control" name="contact"  id="example-text-input" 
															   value="<?php echo $row['contact_no'];?>">
                                                           </div>
                                                          
                                                               
                                                                
                                                            </div>
                                                            
                                                            <button class="btn btn-primary" type="submit">Sign
                                                                in</button>
                                                        </form>
														<?php
										if($_SERVER ["REQUEST_METHOD"]== "POST")
										{
											if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) 
												&& isset($_POST["pass"])&& isset($_POST["add"]) && isset($_POST["contact"]))
											{
												$fname=$_POST["fname"];
												$lname=$_POST["lname"];
												$email=$_POST["email"];
												$pass=$_POST["pass"];
												$add=$_POST["add"];	
												$contact=$_POST["contact"];													
					
												if($fname!="" && $lname!="" && $email!="" && $pass!="" && $add	!="" && $contact!="")
												{
													$sql="update user_table set First_name='".$fname."', Last_name='".$lname."',e_email='".$email."',
													password='".$pass."',address='".$add ."',contact_no='".$contact."'
													where user_id='".$id."'";
													//echo $sql;
													//die;
													$result = mysqli_query($conn,$sql);
						
													if($result)
													{
														echo "<meta http-equiv='refresh' content='0;url=index.php'>";
													}
													else
													{
														echo "ERROR:DATA NOT FOUND";
													}
												}
											}
											else
											{
												echo "ERROR:DATA NOT SET";
											}
										}
									?>
														
                                                    </div>
                                                </div>