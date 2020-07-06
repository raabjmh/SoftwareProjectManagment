<?php
require ('connection.php');
if (isset($_GET['id'])){
    $query = "Delete FROM project where ID='".$_GET['id']."'";
                if($result = mysqli_query($db, $query)){
              //  $message = "deleted successfully";
//echo "<script type='text/javascript'>alert('deleted successfully');</script>";
header("Location: fetchproject.php");
}
else {
    echo("Error description: " . mysqli_error($db));
}
}
?>
