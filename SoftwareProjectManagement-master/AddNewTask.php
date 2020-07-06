<?php include "header.php";
$hourError ="";
$dateError = "";
$name = "";
$task_date="";
$task_Edate="";
$hour = "";
if (isset($_POST['submit'])){//open
  $name = $_POST['taskename'];
  $task_date=$_POST ['task_date'];
  $task_Edate= $_POST ['task_Edate'];
  $hour= $_POST['hour'];
  if (isset ($_GET['id'])){
    $id=$_GET['id'] ;


  if ($task_Edate>=$task_date){
	  if($hour<=24 && $hour>=0){
  $sql ="INSERT INTO `task` (stratDate, endDate, project, name, hours)   VALUES ('$task_date', '$task_Edate', $id, '$name','$hour')";
  $result = mysqli_query($db,$sql);
  header("location:?id=$id &message=<div class='alert alert-success' role='alert'>The task is added to the required project</div>");

  if (!$result) {
printf("Error: %s\n", mysqli_error($db));
exit();
}
	  }else{
		  $hourError = "<span style='color:red'>* The hours in a regular work day must be less than or equal 24 hours!</span> ";
	  }
  }else{
	  $dateError = "<span style='color:red'>* The end date must be greater than or equal start date</span>";
  }
}//close
}
?>
<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script>
  // hide the message
  $(document).ready(function(){//open the main function
  setTimeout(function() { $("#msg").hide(); }, 1500);
  });
  </script>
  <!---------------start JQuery----------------------->
</head>

<body>
  <?php
  if (isset ($_GET['id'])){
    $id=$_GET['id'] ;
  }
  ?>
  <a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="viewTasks.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to task information</span>  </a>
<h2 style="text-align: center; margin-top:50px; color:#007acc">Add a Task</h2>
<!-------------------------------------------------------------------------------------------------------->

                  <div id="msg" style="width:40%; margin-left:33%; margin-bottom:-2.4%">
                  <?php
                  if (isset($_GET['message'])){//open the if statement
                       // Display sucessful message
                       echo $_GET['message'];
                  }//close the if statement
                  ?>
                  </div>
<!-------------------------------------------------------------------------------------------------------->
  <div id="formdiv" style="margin-left:33%">

    <form method="POST" action="">
      <label Style = "color:#1f3d7a;">Task Name</label><br>
      <input type="text" name="taskename" value = "<?php if(!empty($name)) echo $name; ?>" placeholder="Task Name" required >


  <div class="form-group">
				<label for="exampleFormControlInput1"Style = "color:#1f3d7a;">Task Start Date</label>

                 <input type="date" class="form-control" value = "<?php if(!empty($task_date)) echo $task_date; ?>" name="task_date" id="task_date"   min="<?php echo date('Y-m-d') ?>"  onkeydown="return true"   required data-rule="required"  data-msg="Please write date" />
                  <div class="validation"></div>
                </div>

                 <div class="form-group">
				<label for="exampleFormControlInput1" Style = "color:#1f3d7a;">Task End Date</label>

                 <input type="date" class="form-control" name="task_Edate" id="task_Edate" value = "<?php if(!empty($task_Edate)) echo $task_Edate; ?>"  min="<?php echo date('Y-m-d') ?>"  onkeydown="return true"   required data-rule="required"  data-msg="Please write date" />
                  <div class="validation"><?php echo $dateError;?></div>
                </div>

    <label Style = "color:#1f3d7a;">Hour</label><br>
    <input type="text" name="hour" value = "<?php if(!empty($hour)) echo $hour; ?>" placeholder="Task Hour" required >
	<div class="validation"><?php echo $hourError;?></div>

    <br><br>
    <input type="submit" name="submit"value="Submit">
  </form>

</div>
<br>
<br>

</body>
</html>

</body>
