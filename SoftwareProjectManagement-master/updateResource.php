<?php include "header.php"?>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <?php if (isset ($_GET['id'])){
    $id=$_GET['id'] ;}?>
  <a style="margin-bottom:-10%;margin-left:5%;background-color:#007acc;" href="viewResource.php?id=<?php echo $id?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Back to resource information</span>  </a>

  <h2 style="text-align: center; margin-top:50px; color:#007acc">Edit Resource</h2>

  <div id="formdiv" style="margin-left:33%;">
    <form method="POST" action="">
      <?php
      $id=$_REQUEST["id"];
      $sql ="SELECT * FROM resource WHERE ID =$id";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result)
      ?>

      <label Style = "color:#1f3d7a;">Resource Name:</label><br>
      <input type="text" name="resourcename"  value="<?php echo $row['name'];?>" required >

      <br><br>
      <label Style = "color:#1f3d7a;">Resource Type</label><br>
      <select name ="type">
        <option value="human"<?php if ($row['type']=='human') echo "selected";?>>People Resource  </option>
        <option value="budget" <?php if ($row['type']=='budget') echo "selected";?>>Cost Resource</option>
        <option value="material" <?php if ($row['type']=='material') echo "selected";?>>Material Resource</option>
      </select>


      <br><br>
      <label Style = "color:#1f3d7a;">Project Name:</label><br>
      <?php
      $sql1="SELECT * FROM project ";
      $result1 = mysqli_query($db,$sql1);
      ?>
      <select name ="project">
        <?php  while($row1 = mysqli_fetch_array($result1)):;
        ?>
        <option value="<?php echo $row1['ID'];?>"  <?php if ($row['project']==$row1['ID']) echo "selected";?>><?php echo $row1['name'];?></option>
      <?php endwhile;?>
    </select>

    <br><br>
    <label Style = "color:#1f3d7a;">Cost:</label><br>
    <input type="text" name="cost"  value="<?php echo $row['cost'];?>" required >
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
  $name = $_POST['resourcename'];
  $type=$_POST ['type'];
  $project= $_POST ['project'];
  $cost= $_POST['cost'];
  $sql ="UPDATE resource SET name= '$name',type= '$type',project= '$project',cost='$cost' WHERE ID=$id";
  $result = mysqli_query($db,$sql);
  if (isset ($_GET['pid'])){
    $id=$_GET['pid'] ;}
  header("Location: viewResource.php?id=$id");
  if (!$result) {
printf("Error: %s\n", mysqli_error($db));
exit();
}
}

?>
