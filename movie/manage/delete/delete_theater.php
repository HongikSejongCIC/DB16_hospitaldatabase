<?php
  $T_ID = $_POST['theater'];
  $conn = mysqli_connect("localhost","root","123123") ;   //DB접속
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "DELETE FROM theater_info where T_ID = '{$T_ID}'";    //입력된 아이디의 예약상태를 알아냄.
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('극장을 삭제했습니다.'); location.href=('../theater_info.php');</script>";

?>
