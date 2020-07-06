<?php
if (isset($_GET['taskID'])&&  !empty($_GET['taskID']) && $_GET['taskID'] !="" && $_GET['taskID'] !==null ){
	//get task id
	$id = $_GET['taskID'];
	//retrieve task name and prject id
	$sql1 ="SELECT `name`, `project` FROM `task` WHERE `ID` =?";
	$task = getResult($id,$sql1);
	if($task['num']>0){
	//get project id
	$projectID=$task['data'][0]['project'];
	//retrive all resources that belongs to project id
	$sql1 ="SELECT `name`, `ID` FROM `resource` WHERE `project` =?";
	$resources = getResult($projectID,$sql1);
	//for loop to check if this resources is assign to this task or not
	if ($resources['num']>0){
		
	for ($x = 0; $x < $resources['num']; $x++) {
		//resource id & the status if check or not
		$sql = "SELECT `resource` FROM `assign` WHERE `task` = ? AND `resource` =?";
		$check = getResult2($id , $resources['data'][$x]['ID'], $sql);
		if($check['num']>0){
			$resources['data'][$x]['status']=true;
		}else{
			$resources['data'][$x]['status']=false;
		}
}
	}
	echo json_encode(array("taskNAme"=>$task['data'][0]['name'], "resourcesNum"=>$resources['num'], "resourcesData"=>$resources['data']));
	}else{
		echo json_encode(array("result"=>"false", "value"=>"There is no task"));
	}	
}

function getResult($id , $sql){

		 require("connection1.php");
//echo "id: ".$id;

	$results = array();
if($stmt = $db->prepare($sql)) { // assuming $mysqli is the connection
	//$id = $id.' ';
$stmt->bind_param('i',  $id);
//$stmt->execute(array('%'.$keyword.'%'));
$stmt->execute();
$row_AcousticDB = $stmt->get_result(); // altenative: $stmt->bind_result($row_AcousticDB);

$results['num'] =  $row_AcousticDB->num_rows;
if($results['num'] > 0){
	$results['data'] = array();

    while($row = $row_AcousticDB->fetch_assoc()) {
		$results['data'][]= $row;
	}

}else $results['data'] = "";
} else {
    $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
}
$db->close();

return $results;
}
function getResult2($taskID , $resID, $sql){

		 require("connection1.php");
//echo "id: ".$id;

	$results = array();
if($stmt = $db->prepare($sql)) { // assuming $mysqli is the connection
	//$id = $id.' ';
$stmt->bind_param('ii',  $taskID , $resID);
//$stmt->execute(array('%'.$keyword.'%'));
$stmt->execute();
$row_AcousticDB = $stmt->get_result(); // altenative: $stmt->bind_result($row_AcousticDB);

$results['num'] =  $row_AcousticDB->num_rows;
if($results['num'] > 0){
	$results['data'] = array();

    while($row = $row_AcousticDB->fetch_assoc()) {
		$results['data'][]= $row;
	}

}else $results['data'] = "";
} else {
    $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
}
$db->close();

return $results;
}
?>