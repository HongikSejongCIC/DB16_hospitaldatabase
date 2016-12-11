<?php session_start()?>
<meta charset="UTF-8">
<?php
$conn = mysqli_connect("localhost","root","123123") ;
$dbname="movie";

mysqli_select_db($conn,$dbname); //데이터베이스 연결
mysqli_query($conn,"set names utf8");



if(mysqli_connect_errno()){ //연결실패시
   echo "MySQL로의 연결에 실패했습니다.:".mysqli_connect_error();
}

$sql="SELECT * from USER_INFO where USER_ID='".$_POST["id"]."' AND USER_PASSWORD='".$_POST['password']."'";
//로그인 입력 화면(LOGIN_SCREEN.php)에서 id와 password 찾아 받아옴.(위 소스의 주황글씨 부분)

//sql 해석 - 전 화면에서 입력받은 id값과 password값이  데이터베이스에 있는지 찾은 후 있다면, 그 row의 값을 다 가져옴.​

$qresult = mysqli_query($conn, $sql);
$qarray = mysqli_fetch_assoc($qresult); //qarray는 해당 row의 값을 다 가지고 있다.



if(!empty($qarray)){ //qarray가 비어있지 않다면, 가져온 정보가 데이터베이스에 있다는 것이다.

  session_start();
  $_SESSION['user_id'] = $_POST["id"];
  $_SESSION['user_name'] = $qarray['USER_NAME'];

      if($_POST["id"] == 'localhost'){
        echo "<script>alert('관리자모드로 접속하셨습니다.'); location.href=('./manage/manage.php');</script>";  //관리자 로그인
      }else{
        echo "<script>alert('$qarray[USER_NAME]님 로그인 되었습니다.'); location.href=('select_menu.php');</script>";  //일반회원 로그인
      }
   }

else
{
   echo "<script>alert('아이디와 비밀번호를 확인해 주세요.'); location.href=('LOGIN_SCREEN.php');</script>"; //정보가 없다면, 다시 로그인화면으로 돌아간다.
}


mysqli_close($conn);
?>
