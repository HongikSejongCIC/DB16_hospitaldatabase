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
              echo "<p>좌석정보를 수정합니다.</p>";
              ?>
            </h2>
        </header>
        <article>

          <table>
            <tr>
              <th>
                가로열
              </th>
              <th>
                세로열
              </th>
              <th>
                좌석추가
              </th>
            </tr>
            <?php
                echo "
                  <form method='POST' action='./insert/insert_seat.php'>
                    <tr>
                      <td>
                        <input type='text' name='row' style='width:100px;'  placeholder='가로열'>
                      </td>
                      <td>
                        <input type='text' name='col' style='width:100px;'  placeholder='세로열'>
                      </td>
                      <td>
                        <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='좌석추가'  >
                      </td>
                    </tr>
                  </form>
                ";


            ?>

          </table>

          <br>

          <table>
            <tr>
              <th>
                ID
              </th>
              <th>
                가로열
              </th>
              <th>
                세로열
              </th>
              <th>
                좌석삭제
              </th>
            </tr>
            <?php
              $sql = "SELECT * FROM seat_info";    //입력된 아이디의 예약상태를 알아냄.
              $result = mysqli_query($conn,$sql);

              while($row = mysqli_fetch_assoc($result)){
                $S_ID = $row['S_ID'];
                $seat_row = $row['row'];
                $seat_col = $row['col'];
                echo "
                    <tr>
                      <td>
                        {$S_ID}
                      </td>
                      <td>
                        {$seat_row}
                      </td>
                      <td>
                        {$seat_col}
                      </td>
                      <td>
                      <form method='POST' action='delete/delete_seat.php'>
                        <input type='hidden' name='seat' value='{$S_ID}'>
                        <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='좌석삭제'>
                      </form>
                      </td>
                    </tr>
                ";
              }

            ?>

          </table>

        </article>
      </body>
    </html>

  </body>
</html>
