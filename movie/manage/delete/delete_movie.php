<?php
  $M_ID = $_POST['movie'];
  $conn = mysqli_connect("localhost","root","123123") ;   //DB접속
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "DELETE FROM movie_info where M_ID = '{$M_ID}'";    //입력된 아이디의 예약상태를 알아냄.
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('영화를 삭제했습니다.'); location.href=('../movie_info.php');</script>";

?>
