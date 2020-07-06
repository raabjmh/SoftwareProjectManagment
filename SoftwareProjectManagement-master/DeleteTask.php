<!--- Delete a resource ----->

<?php
//-------------------------
include 'connection.php';
//-------------------------
// define the needed variable
$id= $_REQUEST["id"];
//-------------------------
$query="DELETE FROM `task` WHERE `ID` = $id";
        $result= mysqli_query($db, $query);
        // Go back to the pervious page

header('Location: ' . $_SERVER['HTTP_REFERER']); // redirect to the pervious page


 ?>
 <!--- Delete a resource  ----->
