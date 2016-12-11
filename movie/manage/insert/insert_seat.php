<?php
  $row = $_POST['row'];
  $col = $_POST['col'];
  $conn = mysqli_connect("localhost","root","123123");
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "INSERT INTO seat_info(row,col) values('$row','$col')";
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('성공적으로 넣었습니다.'); location.href=('../seat_info.php');</script>";

?>
