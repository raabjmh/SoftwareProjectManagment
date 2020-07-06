<?php include 'header.php';?>
<head>
<!---------------start JQuery----------------------->
<script>
// hide the message
$(document).ready(function(){//open the main function
setTimeout(function() { $("#msg").hide(); }, 1500);
});
</script>
<!---------------start JQuery----------------------->
</head>

<body>
<h1 Style = "color:#1f3d7a; margin-top:40px; margin-left:50px;">Project Management Software Tool</h1>
<a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="fetchproject.php" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to projects</span>  </a>
<h2 style="text-align: center; margin-top:50px; color:#007acc">Edit Project</h2>
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

<?php
require_once("connection.php");
if (isset($_GET['id'])){
    $query = "select * FROM project where ID='".$_GET['id']."'";
                if( $result = mysqli_query($db, $query)){
                    echo "<div id='formdiv' style='margin-left:33%'><form method='POST'>";
                    $row = $result->fetch_assoc();
echo " <label Style = 'color:#1f3d7a;'>project Name:</label><br>
<input type='text' value='".$row['name']."'name='projectname' id='projectname' require>
<br>";
// echo " project cost:<br>
// <input type='number' value='".$row['cost']."'name='projectcost' id='projectcost'require>
// <br>";
echo "<label Style = 'color:#1f3d7a;'>project Start date:</label><br>
<input type='date' value='".$row['startDate']."'name='startDate'id='startDate' require>
<br>";
echo " <label Style = 'color:#1f3d7a;'>project End date:</label><br>
<input type='date' value='".$row['endDate']."'name='endDate' id='endDate' require>
<br> <input type='submit' name='add' value='Submit'>
</form></div>  ";
                      }
                    else {
                        echo("Error description: " . mysqli_error($db));
                    }
                    }

                    if (isset($_POST["add"])){
                    $sql = "update project set name='".$_POST["projectname"]."', endDate='".$_POST["endDate"]."',startDate='".$_POST["startDate"]."' where
                    ID='".$_GET['id']."'";
                    //                    VALUES ('".$_POST["projectname"]."', '".$_POST["projectcost"]."', '".$_POST["startdate"]."','".$_POST["enddate"]."')";
										echo $id=$_GET['id'];
										if ($db->query($sql) === TRUE) {
											header("location: editprojectfinal.php?id=$id &message=<div class='alert alert-success' role='alert'>The project is modified succesfully</div>");

											if (!$result) {
										printf("Error: %s\n", mysqli_error($db));
										exit();
										}
										}//close

										$db->close();
										}


                ?>


</body>

</html>
