<?php

$mlsid = $_POST['mlsid'];
$mlsname = $_POST['mlsname'];

$database=mysqli_connect("localhost","blk_sdarmlslist","freelancevps123","blk_sdarmlslist");

$querystring = "SELECT * FROM sdarmlslist WHERE (MemberNumber='" . $mlsid . "') AND (FullName LIKE '" . $mlsname . "%' OR FirstName='" . $mlsname . "' OR Nickname='" . $mlsname . "' OR LastName='" . $mlsname . "')";

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
  $result = mysqli_query($database,$querystring);
  $tempArray = array();
  $myArray = array();
  while($row = $result->fetch_object()) {
    $tempArray = $row;
    array_push($myArray, $tempArray);
  }
  echo json_encode($myArray);
}

?>