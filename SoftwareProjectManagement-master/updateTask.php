<?php include "header.php"?>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="viewResource.php" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to task information</span>  </a>

  <h2 style="text-align: center; margin-top:50px; color:#007acc">Edit Task</h2>

  <div id="formdiv" style="margin-left:33%;">
    <form method="POST" action="">
      <?php
      $id=$_REQUEST["id"];
      $sql ="SELECT * FROM `task` WHERE `ID` = $id";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result)
      ?>
	   <label Style = "color:#1f3d7a;">Task Name:</label><br>
      <input type="text" name="taskename"  placeholder="Task Name" value="<?php echo $row['name'];?>" required >


  <div class="form-group">
				<label for="exampleFormControlInput1">TASK START Date</label>

                 <input type="date" class="form-control" name="task_date" value="<?php echo $row['stratDate'];?>" id="task_date"   min="<?php echo date('Y-m-d') ?>"  onkeydown="return true"   required data-rule="required"  data-msg="Please write date" />
                  <div class="validation"></div>
                </div>

                 <div class="form-group">
				<label for="exampleFormControlInput1">TASK END Date</label>

                 <input type="date" class="form-control" name="task_Edate" id="task_Edate" value="<?php echo $row['endDate'];?>"  min="<?php echo date('Y-m-d') ?>"  onkeydown="return true"   required data-rule="required"  data-msg="Please write date" />
                  <div class="validation"></div>
                </div>

    <label Style = "color:#1f3d7a;">Hour:</label><br>
    <input type="text" name="hour"  placeholder="Task Hour" value="<?php echo $row['hours'];?>" required >
<br><br>
    <input type="submit" name="submit"value="Submit">
  </form>
</div>
<br>
<br>

</body>
</html>
<?php
if (isset($_POST['submit'])){
  $id=$_REQUEST["id"];
  $name = $_POST['taskename'];
  $task_date=$_POST ['task_date'];
  $task_Edate= $_POST ['task_Edate'];
  $hour= $_POST['hour'];
  $sql ="UPDATE `task` SET `stratDate`='$task_date',`endDate`='$task_Edate',`name`='$name',`hours`='$hour' WHERE `ID` = $id ";
  $result = mysqli_query($db,$sql);
  header('Location: viewTasks.php');
  if (!$result) {
printf("Error: %s\n", mysqli_error($db));
exit();
}else{
  if (isset ($_GET['pid'])){
    $id=$_GET['pid'] ;
	  header("Location: viewTasks.php?id=$id");

}
}
}

?>
