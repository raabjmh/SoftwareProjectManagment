<?php function calculateTaskCose($taskID){
    require_once ("connection.php");
    global $db;
$sql = "SELECT sum((task.`endDate` - task.`stratDate`) *  task.`hours` * resource.cost) as taskCost
 FROM ( `task` inner join assign on task.ID = assign.task) inner join resource
 on resource.ID = assign.resource WHERE task.ID = $taskID";
 $result1 = mysqli_query($db,$sql);
    $row1 = mysqli_fetch_array($result1);
    if($row1['taskCost']!== null){
    return $row1['taskCost'];
    }else{
        return 0;
    }


}
function calculateProjectCost($projectID){
        require_once ("connection.php");
          global $db;
$projectCost =0;
$sql = "SELECT `ID` FROM `task` WHERE `project` = $projectID";
$result = mysqli_query($db,$sql);
  $count= mysqli_num_rows($result);
  if($count != 0 ){
  while($row = mysqli_fetch_array($result)){
      $projectCost += (float)calculateTaskCose($row['ID']);
  }
  }
  return $projectCost;

}
?>
