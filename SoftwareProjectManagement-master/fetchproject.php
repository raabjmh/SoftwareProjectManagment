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
  <a style="background-color:#007acc; margin-bottom:-10%; margin-left:1%" href="addproject.php" class="btn btn-info btn-lg">
  <span style='font-size:20px;'> <span class="glyphicon">&#xe081;</span> Add Project </span>  </a>
<h2 style="text-align: center; margin-top:50px; color:#007acc"> Projects </h2>

<style>

#tableStyle {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  color: #003d66;
}

#tableStyle td, #tableStyle th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tableStyle tr:nth-child(even){background-color: #f2f2f2; color:#005c99;}

#tableStyle tr:hover {background-color: #ddd;}

#tableStyle th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#007acc;
  color: white;
}
.glyphicon {
    font-size: 16px;
}
#tableStyle th, #tableStyle tr {
  text-align: center;
  font-family:Arial;
}
table{
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  color: #003d66;
}
table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2; color:#005c99;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#007acc;
  color: white;
}
</style>



</head>
<body>

<?php
include "func.php";
require_once('connection.php');

      $query = "SELECT * FROM project";

      $result = mysqli_query($db, $query);
      $row = mysqli_fetch_array($result);
 if ($result->num_rows > 0) {


$result = mysqli_query($db,$query);

echo "<table border='1'><tr>
<th>Project name</th>
<th>project cost</th>
<th>start date</th>
<th>end Date</th>
<th colspan='2'>   Maintain the Project </th>
</tr>";

                  while($row = $result->fetch_assoc()) {

                    echo "<tr><td  id=".$row['ID'] ."><a href ='viewproject.php? id=".$row['ID'] ."'><label>".$row['name'] . "</label></a><br></td><td >".calculateProjectCost($row['ID']). "</td>

                    <td >".$row['startDate'] . "</td><td >".$row['endDate'] . "</td>";
                    echo"<td><a href='deleteproject.php?id=". $row['ID']  . "'><i class='glyphicon glyphicon-trash'>delete</i></a>";
                    echo" </td><td><a href='editprojectfinal.php?id=". $row['ID']  . "'><i class='glyphicon glyphicon-file'>Edit</a></i></td> </tr>";
                }
                  echo "</table>";
            }
                ?>

</body>
</html>
