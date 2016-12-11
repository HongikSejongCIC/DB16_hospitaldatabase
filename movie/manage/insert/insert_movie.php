<?php
  $moviename = $_POST['moviename'];
  $hallname = $_POST['hallname'];
  $screeningtime= $_POST['screeningtime'];
  $conn = mysqli_connect("localhost","root","123123");
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "INSERT INTO movie_info(moviename,hallname,screeningtime) values('$moviename','$hallname','$screeningtime')";
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('성공적으로 넣었습니다.'); location.href=('../movie_info.php');</script>";

?>
