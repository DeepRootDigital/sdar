<?php

if ($_GET['namequery'] && !$_GET['otherquery']) {
  $namequery = $_GET['namequery'];
  $querystring = "SELECT * FROM sdarmlslist WHERE FullName LIKE '%" . $namequery . "%' OR FirstName='" . $namequery . "' OR Nickname='" . $namequery . "' OR LastName='" . $namequery . "'";
} elseif (!$_GET['namequery'] && $_GET['otherquery']) {
  $otherquery = $_GET['otherquery'];
  $querystring = "SELECT * FROM sdarmlslist WHERE City='" . $otherquery . "' OR Zip='" . $otherquery . "' OR OfficeName LIKE '%" . $otherquery . "%'";
} elseif ($_GET['namequery'] && $_GET['otherquery']) {
  $namequery = $_GET['namequery'];
  $otherquery = $_GET['otherquery'];
  $querystring = "SELECT * FROM sdarmlslist WHERE (FullName LIKE '" . $namequery . "%' OR FirstName='" . $namequery . "' OR Nickname='" . $namequery . "' OR LastName='" . $namequery . "') OR (City='" . $otherquery . "' OR Zip='" . $otherquery . "' OR OfficeName LIKE '%" . $otherquery . "%')";
}

$database=mysqli_connect("localhost","blk_sdarmlslist","freelancevps123","blk_sdarmlslist");

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