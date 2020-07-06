<?php
if (isset($_GET['taskID'])&&  !empty($_GET['taskID']) && $_GET['taskID'] !="" && $_GET['taskID'] !==null
&& isset($_GET['resourceID'])&&  !empty($_GET['resourceID']) && $_GET['resourceID'] !="" && $_GET['resourceID'] !==null){
$taskID = $_GET['taskID'];
$resourceID = $_GET['resourceID'];
$sql = "INSERT INTO `assign`(`task`, `resource`) VALUES (?,?)";
$result = insertRecord($taskID, $resourceID, $sql);
echo json_encode($result);
}

function insertRecord($taskID, $resourceID, $sql){

	require("connection1.php");
	$results = array();
if($stmt = $db->prepare($sql)) { // assuming $mysqli is the connection

$stmt->bind_param('ii', $taskID, $resourceID);

$stmt->execute();
 if($stmt->affected_rows > 0){

$results ['result']= "true";
$results ['value']= "the resource is assigned to task successfully";
 }else{
	$results ['result']= "false";
$results ['value']= "the resource is not assigned to task"; 
 }
}else{
	$results ['result']= "error";
$results ['value']= "the resource is not assigned to task";
}
$stmt->close();
$db->close();

return $results;
}


?>