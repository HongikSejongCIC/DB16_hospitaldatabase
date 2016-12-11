<?php
  $theatername = $_POST['theatername'];
  $location = $_POST['location'];
  $callnumber= $_POST['callnumber'];
  $conn = mysqli_connect("localhost","root","123123");
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "INSERT INTO theater_info(theatername,location,callnumber) values('$theatername','$location','$callnumber')";
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('성공적으로 넣었습니다.'); location.href=('../theater_info.php');</script>";

?>
