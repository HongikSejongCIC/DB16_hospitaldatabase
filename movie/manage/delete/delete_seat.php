<?php
  $S_ID = $_POST['seat'];
  $conn = mysqli_connect("localhost","root","123123") ;   //DB접속
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "DELETE FROM seat_info where S_ID = '{$S_ID}'";    //입력된 아이디의 예약상태를 알아냄.
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('영화를 삭제했습니다.'); location.href=('../seat_info.php');</script>";

?>
