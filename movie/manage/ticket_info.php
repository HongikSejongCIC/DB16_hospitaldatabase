<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>메뉴선택</title>
  </head>
  <body>
    <?php
      $conn = mysqli_connect("localhost","root","123123") ;
      $dbname="movie";
      mysqli_select_db($conn,$dbname); //데이터베이스 연결
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>
          SCSC CINEMA
        </title>
        <link rel="stylesheet" href="./manage.css" media="screen" title="no title" charset="utf-8">
      </head>
      <body>
        <header>
            <h2 id="login_info">
              <?php
              session_start();
              if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
              echo "<meta http-equiv='refresh' content='0;url=login.php'>";
              exit;
              }
              $user_id = $_SESSION['user_id'];
              $user_name = $_SESSION['user_name'];
              echo "<p>안녕하세요. $user_name($user_id)님</p>";
              echo "<p><a href='../logout.php'>로그아웃</a></p>";
              echo "<p><a href='./manage.php'>메뉴화면</a></p>";
              $USER_ID=$_POST['user'];
              echo "<p>{$USER_ID}님의 예약정보를 확인합니다.</p>";
              ?>
            </h2>
        </header>
        <article>
          <table>
            <tr>
              <th>
                회원ID
              </th>
              <th>
                회원이름
              </th>
              <th>
                일련번호
              </th>
              <th>
                영화이름
              </th>
              <th>
                극장이름
              </th>
              <th>
                상영관이름
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
              $USER_ID=$_POST['user'];
              $sql = "SELECT user_id,user_name,tk_id,moviename,theatername,hallname,row,col,screeningtime
                      from user_info,movie_info,theater_info,seat_info,ticket_info
                      where ticket_info.u_id=user_info.user_id and ticket_info.m_id = movie_info.m_id and ticket_info.t_id = theater_info.t_id and ticket_info.s_id=seat_info.s_id and ticket_info.u_id = '$USER_ID'";
              $result = mysqli_query($conn,$sql);
              if (empty(mysqli_fetch_assoc($result))) {
                echo "
                  <tr>
                    <td colspan='9'>
                      예약정보가 없습니다.
                    </td>
                  </tr>
                  ";

              }else {
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                  $user_id = $row['user_id'];
                  $user_name = $row['user_name'];
                  $tk_id = $row['tk_id'];
                  $moviename = $row['moviename'];
                  $theatername = $row['theatername'];
                  $hallname = $row['hallname'];
                  $seat_row = $row['row'];
                  $seat_col = $row['col'];
                  $screeningtime = $row['screeningtime'];

                  echo "
                      <tr>
                        <td>
                          {$user_id}
                        </td>
                        <td>
                          {$user_name}
                        </td>
                        <td>
                          {$tk_id}
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
                        <form method='POST' action='delete/delete_ticket.php'>
                          <input type='hidden' name='ticket' value='{$tk_id}'>
                          <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='예약취소'>
                        </form>
                        </td>
                      </tr>
                  ";
                }
              }


            ?>

          </table>

        </article>
      </body>
    </html>

  </body>
</html>
