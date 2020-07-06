<?php include "header.php";?>
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
  <?php   if (isset ($_GET['id'])){ $id=$_GET['id'];}?>
  <a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="viewResource.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to resource information</span>  </a>
<h2 style="text-align: center; margin-top:50px; color:#007acc">Add a Resource</h2>
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
      <label Style = "color:#1f3d7a;">Resource Name:</label><br>
      <input type="text" name="resourcename"  placeholder="Resource Name" required >

      <br><br>
      <label Style = "color:#1f3d7a;">Resource Type</label><br>
      <select name ="type">
        <option value="human">People Resource</option>
        <option value="budget">Cost Resource</option>
        <option value="material">Material Resource</option>
      </select>


      <br><br>


    <label Style = "color:#1f3d7a;">Cost:</label><br>
    <input type="text" name="cost"  placeholder="Resource Cost" required >
    <br><br>
    <input type="submit" name="submit"value="Submit">
  </form>

</div>
<br>
<br>

</body>
</html>
<?php
if (isset($_POST['submit'])){//open
  $name = $_POST['resourcename'];
  $type=$_POST ['type'];
  $project= $_POST ['project'];
  $cost= $_POST['cost'];
  if (isset ($_GET['id'])){ $id=$_GET['id'];
  $sql ="INSERT INTO resource (name, type, project, cost)  VALUES ('$name','$type','$id','$cost')";
  $result = mysqli_query($db,$sql);
  header("location:?id=$id &message=<div class='alert alert-success' role='alert'>The resource is added to the required project</div>");
}
  if (!$result) {
printf("Error: %s\n", mysqli_error($db));
exit();
}
}//close

?>
</body>
