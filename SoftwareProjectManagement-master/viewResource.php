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

<h2 style="text-align: center;  margin-bottom:-5.4%;margin-top:50px; color:#007acc">Resource Information </h2>
<br><br>
<?php
if (isset ($_GET['id'])){
  $id=$_GET['id'] ;
}
?>
<a style="background-color:#007acc;" href="viewproject.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Project Information</span>  </a>

<a style="background-color:#007acc;" href="AddNewResource.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'> <span class="glyphicon">&#xe081;</span> Add Resource </span>  </a>
<br><br>
<form method="post" action="">
<table id="tableStyle"  style="width:50%; margin-left:23%">
  <?php
  if (isset ($_GET['id'])){
    $id=$_GET['id'] ;
  $sql ="SELECT * FROM resource WHERE project='$id'";
  $result = mysqli_query($db,$sql);
  $count= mysqli_num_rows($result);
  ?>
  <tr>
    <?php if ($count!=0){?>
      <th  style="width:30%;">Resource Name </th>
      <th  style="width:10%;">Rsource Type</th>
      <!--<th>Project Name</th>-->
      <th  style="width:10%;" >Cost</th>
      <th colspan="2">   Maintain the resource </th>

    <?php } else {echo "<center><h4> No resource to show </h4></center>";}?>
    </tr>
    <?php  while($row = mysqli_fetch_array($result)):;
    ?>
    <tr>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['type'];?></td>
      <!--
      <td>

      <?php
      /*
      $id =$row['project'];
      $sql1 ="SELECT * FROM project WHERE id='$id'";
      $result1 = mysqli_query($db,$sql1);
      $row1 = mysqli_fetch_array($result1);
      echo $row1['name'];
      */?>
    </td>
  -->
    <td><?php echo $row['cost'];?></td>
    <td style ="width:7%">
      <?php if (isset ($_GET['id'])){
        $id=$_GET['id'] ;?>
      <a href="UpdateResource.php?id=<?php echo $row['ID'];?> &pid=<?php echo $id?>"><i class="glyphicon glyphicon-file">Edit</i><a>
   </td>
    <td style ="width:7%">
    <a href="DeleteResource.php?id='<?php echo $row['ID'];?>'"><i class="glyphicon glyphicon-trash">Delete </i></a></td>

    </tr>
<?php } endwhile;}?>
</table>
</form>
</body>
</html>
