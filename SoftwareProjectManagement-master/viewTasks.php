<?php
include ("header.php");
include ("generateCost.php");
?>
<head>
  <title>View Tasks </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php include 'tableStyle.html';?>
<style>
.container{
	margin-bottom:50px;
}
#tableStyleResources {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  color: #003d66;
}
#tableStyleResources td, #tableStyleResources th{
  border: 1px solid #ddd;
  padding: 8px;
}
#tableStyleResources tr:hover  {background-color: #ddd;}

#tableStyle th  #tableStyleResources th{
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#007acc;
  color: white;
}
#tableStyleResources th, #tableStyleResources tr , .modal-header .modal-title {
  text-align: center;
  font-family:Arial;
}
</style>
</head>
<body>

<h2 style="text-align: center; margin-top:50px; color:#007acc">Task Information </h2>
<br><br>
<div class="container">
                      <div class="row ">
					  <div class = "col-12">
              <?php
              if (isset ($_GET['id'])){
                $id=$_GET['id'] ;
              }
              ?>
<a style="background-color:#007acc;" href="viewProject.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
<span style='font-size:20px;'>&#8634; Project Information</span>  </a>
        <a style="background-color:#007acc;" href="AddNewTask.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-plus"></span> Add a task
        </a>
<br><br>
<form method="post" action="">
<table id="tableStyle">
  <?php
  if (isset ($_GET['id'])){
    $id=$_GET['id'] ;
  $sql ="SELECT * FROM `task` WHERE `project` =$id";
  $result = mysqli_query($db,$sql);
  $count= mysqli_num_rows($result);
  ?>
  <tr>
    <?php if ($count!=0){?>
      <th>Task Name </th>
      <th>Start date</th>
      <th>End date</th>
      <th>Hour</th>
	  <th>Cost</th>
	  <th>Assign</th>
      <th colspan="2">   Maintain the task </th>

    <?php } else {echo "<center><h4> No task to show </h4></center>";}?>
    </tr>
    <?php  while($row = mysqli_fetch_array($result)):;
    ?>
    <tr>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['stratDate'];?></td>
      <td><?php echo $row['endDate'];?></td>
    <td><?php echo $row['hours'];?></td>
	   <td><?php echo calculateTaskCose($row['ID']); ?></td>
	     <td style="width:10%">   <center> <button type="button"  class="btn btn-info btn-lg assign" style="background-color: #007acc;" data-toggle="modal" data-target="#AssignRes" data-id = "<?php echo $row['ID'];?>" >Assign</button></center></td>

    <td style ="width:7%">
      <?php if (isset ($_GET['id'])){
        $id=$_GET['id'] ;?>
      <a href="updateTask.php?id=<?php echo $row['ID'];?> &pid=<?php echo $id?>"><i class="glyphicon glyphicon-file">Edit</i><a>
   </td>
    <td style ="width:7%">
    <a href="DeleteTask.php?id=<?php echo $row['ID'];?>"><i class="glyphicon glyphicon-trash">Delete </i></a></td>

    </tr>
<?php } endwhile;}?>
</table>
</form>
</div>
</div>
</div>
  <div class="modal fade" id="AssignRes" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" style="text-align: right; margin-right:0;" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center; margin-top:50px; color:#007acc">Assign resources to <span id="taskName"></h4>
        </div>
        <div class="modal-body">
		<p id="msgResource"></p>
			<table id="tableStyleResources">



			</table>
		</div>
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
<br>
<br>

<br>
<br>
<script>
var url = "http://localhost/SPM/";
$('.assign').click(function(){
$("#msgResource").html("");
 var taskID = $(this).attr('data-id');
     $.ajax({
        type: "get",
        url: url+"Assign.php?taskID="+taskID+"&type=getResources" ,
              dataType: 'json',
        success: function(data) {
			console.log(data);
		console.log("data.resourcesNum: "+data.resourcesNum);
		$('#taskName').html(data.taskNAme)
		if(data.resourcesNum>0){
			//for loop
			var ResourcesTable = $('#tableStyleResources');
			ResourcesTable.html("<tr><th>Resource Name </th></tr>");

			for(var i = 0 ; i<data.resourcesNum;i++){
					console.log("data.resourcesNum: "+data.resourcesData[i].name);

				if (data.resourcesData[i].status){
				console.log("stustes true");
					//checked
					ResourcesTable.append('<tr><td><div class="checkbox"><label><input type="checkbox" class="resourceCheck" value="'+data.resourcesData[i].ID+'" checked>'+data.resourcesData[i].name+'</label></div></td></tr>');
				}else{
					console.log("stustes false");
					//not checked
					ResourcesTable.append('<tr><td><div class="checkbox"><label><input type="checkbox" class="resourceCheck" value="'+data.resourcesData[i].ID+'">'+data.resourcesData[i].name+'</label></div></td></tr>');
				}
			}
			//add event for check box
			$('.resourceCheck').change(function() {
				if(this.checked) {
					//get resource id
					var resourceID = $(this).val();
					//insert this resource to this task
					insertAssign(resourceID, taskID);


			}else{
			//get resource id
			var resourceID = $(this).val();
			//delete this resource to this task
			deleteAssign(resourceID, taskID);
			}
        $('#textbox1').val(this.checked);
    });
		}else{
			$('#tableStyleResources').remove();
			$("#msgResource").html("There is no resource for this project <br> <a href='viewResource.php' class='btn btn-info btn-lg' style='background-color: #007acc;'>Add new resource</a> ");

		}



     },
    error: function(xhr,textStatus,err){
    console.log("xhr="+xhr.status+" textStatus= "+textStatus+" err = "+err);
    if(xhr.status==0)
      alert("please check your internet connection");
    else if (xhr.status!=0&&xhr.status!=200)
      alert("there is an error.. please try again");
//--------------------------------------------------------
    }
     });
});

function insertAssign(resourceID, taskID){
     $.ajax({
        type: "get",
        url: url+"insertAssign.php?taskID="+taskID+"&resourceID="+resourceID ,
              dataType: 'json',
        success: function(data) {
		if(data.result === "true"){
		$("#msgResource").html('<div class="alert alert-success" role="alert">'+data.value+'</div>');
		setTimeout(function(){
            $("#msgResource .alert-success").remove();
            }, 3000);
		}else{
		$("#msgResource").html('<div class="alert alert-danger" role="alert">'+data.value+'</div>');
		setTimeout(function(){
            $("#msgResource .alert-danger").remove();
            }, 3000);
		}

     },
    error: function(xhr,textStatus,err){
    console.log("xhr="+xhr.status+" textStatus= "+textStatus+" err = "+err);
    if(xhr.status==0)
      alert("please check your internet connection");
    else if (xhr.status!=0&&xhr.status!=200)
      alert("there is an error.. please try again");

    }
     });

}
function deleteAssign(resourceID, taskID){
     $.ajax({
        type: "get",
        url: url+"deleteAssign.php?taskID="+taskID+"&resourceID="+resourceID ,
              dataType: 'json',
        success: function(data) {
				if(data.result === "true"){
					$("#msgResource").html('<div class="alert alert-success" role="alert">'+data.value+'</div>');
					setTimeout(function(){
						$("#msgResource .alert-success").remove();
					}, 3000);
				}else{
					$("#msgResource").html('<div class="alert alert-danger" role="alert">'+data.value+'</div>');
					setTimeout(function(){
						$("#msgResource .alert-danger").remove();
					}, 3000);
				}

     },
    error: function(xhr,textStatus,err){
    console.log("xhr="+xhr.status+" textStatus= "+textStatus+" err = "+err);
    if(xhr.status==0)
      alert("please check your internet connection");
    else if (xhr.status!=0&&xhr.status!=200)
      alert("there is an error.. please try again");
    }
     });

}

</script>
</body>

</html>
