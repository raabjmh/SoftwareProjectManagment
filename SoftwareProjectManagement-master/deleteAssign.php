<?php
if (isset($_GET['taskID'])&&  !empty($_GET['taskID']) && $_GET['taskID'] !="" && $_GET['taskID'] !==null
&& isset($_GET['resourceID'])&&  !empty($_GET['resourceID']) && $_GET['resourceID'] !="" && $_GET['resourceID'] !==null){
$taskID = $_GET['taskID'];
$resourceID = $_GET['resourceID'];
$sql = "DELETE FROM `assign` WHERE `task` =? AND `resource` = ?";
$result = deleteRecord($taskID, $resourceID, $sql);
echo json_encode($result);
}

function deleteRecord($taskID, $resourceID, $sql){
    require("connection.php");
$stmt = $db->prepare($sql);

// Check if prepare() failed.
// prepare() can fail because of syntax errors, missing privileges, ....

if ( false === $stmt ) {
error_log('mysqli prepare() failed: ');
error_log( print_r( htmlspecialchars($stmt->error), true ) );

// Since all the following operations need a valid/ready statement object
// it doesn't make sense to go on
exit();

}

// Bind the value to the statement

$bind = $stmt->bind_param('ii', $taskID, $resourceID);

// Check if bind_param() failed.
// bind_param() can fail because the number of parameter doesn't match the placeholders
// in the statement, or there's a type conflict, or ....

if ( false === $bind ) {
error_log('bind_param() failed:');
error_log( print_r( htmlspecialchars($stmt->error), true ) );
exit();
}

// Execute the query

$exec = $stmt->execute();

// Check if execute() failed. 
// execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable

if($stmt->affected_rows){
if ( false === $exec ) {
error_log('mysqli execute() failed: ');
error_log( print_r( htmlspecialchars($stmt->error), true ) );
$results ['result']= "error";
$results ['value']= "Not deleted the resource from this task";
}else {
$results ['result']= "true";
$results ['value']= "Deleted the resource from this task successfully";
}
}else{
    $results ['result']= "false";
$results ['value']= "Not deleted the resource from this task";
}

// Close the prepared statement

$stmt->close();

// Close connection

$db->close();
return $results;
}

?>