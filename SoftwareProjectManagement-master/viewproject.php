<?php include "header.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php include 'tableStyle.html';?>
</head>
<body>
<h2 style="text-align: center;  margin-bottom:-5.4%;margin-left:50px; color:#007acc">Project Information </h2>
<br><br>
<a style="background-color:#007acc; margin-left:5%; " href="fetchproject.php"  class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Projects</span>  </a>

<br><br>
<form method="post" action="">
<table id="tableStyle"  style="width:50%; margin-left:23%">
  <?php
  if (isset ($_GET['id'])){
    include "func.php";

    $id=$_GET['id'] ;
  $sql ="SELECT * FROM project WHERE id='$id'";
  $result = mysqli_query($db,$sql);
  $count= mysqli_num_rows($result);
  ?>
  <tr>
    <?php if ($count!=0){?>
      <th  style="width:30%;">Project Name </th>
      <th  style="width:10%;" > Project Cost</th>
      <th  style="width:10%;" > Start Date</th>
      <th  style="width:10%;" > End Date</th>

    <?php } ?>
    </tr>
    <?php  while($row = mysqli_fetch_array($result)):;
    ?>
    <tr>
      <td><?php echo $row['name'];?></td>
      <td><?php echo calculateProjectCost($row['ID']);?></td>
      <td><?php echo $row['startDate'];?></td>
      <td><?php echo $row['endDate'];?></td>
    </tr>
<?php endwhile;
?>
</table>
<br/><br/>
<a style="background-color:#007acc; margin-left:35%; " href="viewResource.php?id=<?php echo $id;?>"  class="btn btn-info btn-lg">
<span style='font-size:20px;'> View Project Resources</span>  </a>
<a style="background-color:#007acc; " href="viewTasks.php?id=<?php echo $id;?>"  class="btn btn-info btn-lg">
<span style='font-size:20px;'>View Project Tasks</span>  </a>
<?php }?>
</form>
</body>
</html>
