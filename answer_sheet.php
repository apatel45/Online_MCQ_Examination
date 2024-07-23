<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<?php 
	//echo "<pre>"; print_r($_REQUEST); 
	//echo "SELECT * FROM quiz_list where id='".$_REQUEST['id']."' order by RAND();"; exit;
	//exit;
	$quiz = $conn->query("SELECT * FROM quiz_list where id='".$_REQUEST['id']."' order by RAND();")->fetch_array();
	//echo "<pre>"; print_r($quiz); 
	//echo $quiz['title'] ;
	//exit;
	?>
	<title>
		<?php echo $quiz['title'] ?> | Answer Sheet
	</title>
</head>
<body>
	<style>
		p 
		{
  			text-align: center;
  			font-size: 60px;
  			margin-top: 0px;
		}
		li.answer
		{
			cursor: pointer;
		}
		li.answer:hover
		{
			background: #00c4ff3d;
		}
		li.answer input:checked
		{
			background: #00c4ff3d;
		}
		li.q-field-list-group-item
		{
			user-select: none;
		}
	</style>
	<?php include('nav_bar.php') ?>
	<?php
		
	?>
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">
			<?php echo $quiz['title']; ?> | <?php echo $quiz['qpoints'].' Points Each Question'; ?>
		</div>
		<form name="cd">
            <label>Remaining Time : </label>
            <div id="timer" style="border:none; background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" size="5" readonly></div>
        </form>
		<br>
		<div class="card">
			<div class="card-body">
				<form action="" id="answer-sheet">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
					<input type="hidden" name="quiz_id" value="<?php echo $quiz['id'] ?>">
					<input type="hidden" name="qpoints" value="<?php echo $quiz['qpoints'] ?>">
					<?php
						$question = $conn->query("SELECT * FROM questions where qid = '".$quiz['id']."' order by order_by asc ");
						$i = 1 ;
						while($row =$question->fetch_assoc())
						{
							$opt = $conn->query("SELECT * FROM question_opt where question_id = '".$row['id']."' order by RAND() ");
						
					?>
					<ul class="q-items list-group mt-4 mb-4">
						<li class="q-field-list-group-item">
							<strong>
								<?php echo ($i++). '. '; ?> <?php echo $row['question'] ?>
							</strong>
							<input type="hidden" name="question_id[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>">
							<br>
							<ul class='list-group mt-4 mb-4'>
								<?php while($orow = $opt->fetch_assoc()){ ?>
								<li class="answer list-group-item">
								<label><input type="radio" name="option_id[<?php echo $row['id'] ?>]" value="<?php echo $orow['id'] ?>"> <?php echo $orow['option_txt'] ?></label>
								</li>
							<?php } ?>
							</ul>
						</li>
					</ul>
					<?php } ?>
					<input type="hidden" name="destination" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
					<button class="btn btn-block btn-primary">Submit</button>
					
					<?php
  					/*	if(isset($_REQUEST["destination"]))
						{
      						header("Location: {$_REQUEST["destination"]}");
  						}
						else if(isset($_SERVER["HTTP_REFERER"]))
						{
      						header("Location: {$_SERVER["HTTP_REFERER"]}");
  						}
						else
						{
       						header("Location: student_quiz_list.php");
  						}*/
					?> 
				</form>
			</div>
		</div>
	</div>
</body>
<script>

var countDownDate = new Date("March 25, 2022 11:19:00").getTime();
var x = setInterval(function() 
{
	var now = new Date().getTime();
	var distance = countDownDate - now;

	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	document.getElementById("timer").innerHTML = minutes + "m " + seconds +"s ";
  	
	if(minutes < 1)
	{
		//document.bgColor = "#FF0000";
		document.body.style.backgroundColor = "red";
		//$('body').css('background', '#FF0000');
	}
	
	if(minutes == 1 && seconds == 0)
	{
		alert('You have only One Minute Left..!');
	}
  
	if (distance < 0) 
	{
    	clearInterval(x);
		alert('Timeout.! Please Submit Quiz.!');
		/*$(document).ready(function(){
        	$("#answer-sheet :radio").prop("disabled", true)
    	});*/
		//document.forms["answer-sheet"].submit();
    	document.getElementById("timer").innerHTML = "TIMEOUT";
  	}
}, 1000);
$(document).ready(function()
{
	$('.answer').each(function()
	{
		$(this).click(function()
		{
			$(this).find('input[type="radio"]').prop('checked',true)
			$(this).css('background','#00c4ff3d')
			$(this).siblings('li').css('background','white')
		})
	})
$('#answer-sheet').submit(function(e)
{
	e.preventDefault()
	$('#answer-sheet [type="submit"]').attr('disabled',true)
	$('#answer-sheet [type="submit"]').html('Saving...')
	$.ajax(
	{
		url:'submit_answer.php',
		method:'POST',
		data:$(this).serialize(),
		error:err=>console.log(err),
		success:function(resp)
		{
			if(typeof resp != undefined)
			{
				resp = JSON.parse(resp)
				if(resp.status == 1)
				{
					alert('You completed the quiz your score is '+resp.score)
					location.replace('view_answer.php?id=<?php echo $_GET['id'] ?>')
				}
			}
		}
	})
})
})
</script>
</html>