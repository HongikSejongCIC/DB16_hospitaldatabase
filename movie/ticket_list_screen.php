<?php session_start()?>

<!DOCTYPE html>
<?php
session_start();
$U_ID = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./ticket_list_screen.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <header>

        <h2 id="login_info">
          <?php
          if(!isset($U_ID) || !isset($user_name)) {
          echo "<meta http-equiv='refresh' content='0;url=login.php'>";
          exit;
          }
          echo "<p>안녕하세요. $user_name($U_ID)님</p>";
          echo "<p>예약하신 영화목록입니다.</p>";
          echo "<p><a href='logout.php'>로그아웃</a></p>";
          ?>
        </h2>

    </header>
    <table>
      <tr>
        <th>
          일련번호
        </th>
        <th>
          영화제목
        </th>
        <th>
          극장
        </th>
        <th>
          상영관
        </th>
        <th>
          좌석
        </th>
        <th>
          상영시간
        </th>
        <th>
          예약취소
        </th>
      </tr>
      <?php
        $conn = mysqli_connect("localhost","root","123123") ;   //DB접속
        $dbname="movie";
        mysqli_select_db($conn,$dbname);

        $sql = "SELECT * FROM ticket_info where U_ID = '{$U_ID}'";    //입력된 아이디의 예약상태를 알아냄.
        $resultt = mysqli_query($conn,$sql);

        if (empty($roww = mysqli_fetch_assoc($resultt))) {
          echo "
            <tr>
              <td colspan=7>
                예약정보 없음
              </td>
            </tr>
          ";
        }else{
        $sql = "SELECT * FROM ticket_info where U_ID = '{$U_ID}'";    //입력된 아이디의 예약상태를 알아냄.
        $resultt = mysqli_query($conn,$sql);
        while($roww = mysqli_fetch_assoc($resultt)){
          $TK_ID = $roww['TK_ID'];   //ID를 이용하여 아래에서 정보들을 끄집어 낼 것임.
          $M_ID = $roww['M_ID'];
          $T_ID = $roww['T_ID'];
          $S_ID = $roww['S_ID'];

          $sql = "SELECT * FROM movie_info where M_ID = '{$M_ID}'";   // M_ID를 이용하여 MOVIE정보를 알아냄
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $moviename = $row['moviename'];
          $hallname = $row['hallname'];
          $screeningtime = $row['screeningtime'];

          $sql = "SELECT * FROM theater_info where T_ID = '{$T_ID}'";   //T_ID를 이용하여 THEATER정보를 알아냄
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $theatername = $row['theatername'];

          $sql = "SELECT * FROM seat_info where S_ID = '{$S_ID}'";   //S_ID를 이용하여 SEAT정보를 알아냄
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $seat_row = $row['row'];
          $seat_col = $row['col'];


          echo "
              <tr>
                <td>
                  {$TK_ID}
                </td>
                <td>
                  {$moviename}
                </td>
                <td>
                  {$theatername}
                </td>
                <td>
                  {$hallname}
                </td>
                <td>
                  {$seat_row}{$seat_col}
                </td>
                <td>
                  {$screeningtime}
                </td>
                <td>
                  <form method='POST' action='dell.php'>
                    <input type='hidden' name='dell' value='{$TK_ID}'>
                    <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='예약취소'>
                  </form>
                </td>
              </tr>
          ";
        }
      }
      ?>

    </table>

    <h2 id="login_info">
      <a href="select_menu.php">메뉴화면</a>
    </h2>

  </body>
</html>
