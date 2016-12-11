<?php
  $TK_ID = $_POST['ticket'];
  $conn = mysqli_connect("localhost","root","123123") ;   //DB접속
  $dbname="movie";
  mysqli_select_db($conn,$dbname);
  $sql = "DELETE FROM ticket_info where TK_ID = '{$TK_ID}'";    //입력된 아이디의 예약상태를 알아냄.
  $result = mysqli_query($conn,$sql);
  echo "<script>alert('예약을 취소했습니다.'); location.href=('../user_info.php');</script>";

?>
