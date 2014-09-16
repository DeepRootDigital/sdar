<?php

if ($_POST['coords'] && $_POST['name']) {
  $coords = $_POST['coords'];
  $name = $_POST['name'];

  $mysqli=mysqli_connect("localhost","blk_coords","freelancevps123","blk_coords");
  $querystring = "INSERT INTO coords (name, coords) VALUES ('$name','$coords')";

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 

  $mysqli -> query($querystring);

  echo $coords;
}

?>