<?php include "header.php";?>
<!---------------start JQuery----------------------->
<script>
// hide the message
$(document).ready(function(){//open the main function
setTimeout(function() { $("#msg").hide(); }, 1500);
});
</script>
<!---------------start JQuery----------------------->
<a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="fetchproject.php" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to projects </span>  </a>
<h2 style="text-align: center; margin-top:50px; color:#007acc">Add Project</h2>
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
  <form method="POST">
    <label Style = "color:#1f3d7a;">Project Name:</label><br>
    <input type="text" name="projectname"  placeholder="Project name.." require >

	<br><br>
    <label Style = "color:#1f3d7a;">Start date:</label><br>
    <input type="date" name="startdate"  require>

    <br><br>
    <label Style = "color:#1f3d7a;"> End date:</label><br>
    <input type="date" name="enddate" require>

     <br><br>
  	 <input type="submit" name="add"value="Submit">
  </form>
</div>
<br>
<br>
</body>
</html>
<?php
if (isset($_POST["add"])){
$sql = "INSERT INTO project (name, endDate,startDate)
VALUES ('".$_POST["projectname"]."', '".$_POST["startdate"]."','".$_POST["enddate"]."')";

if ($db->query($sql) === TRUE) {
	header("location:?message=<div class='alert alert-success' role='alert'>The project is added succesfully</div>");

	if (!$result) {
printf("Error: %s\n", mysqli_error($db));
exit();
}
}//close

$db->close();
}
?>
