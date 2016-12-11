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
              echo "<p>회원정보를 확인합니다.</p>";
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
                핸드폰번호
              </th>
              <th>
                예약확인
              </th>
            </tr>
            <?php
              $sql = "SELECT * FROM user_info";    //입력된 아이디의 예약상태를 알아냄.
              $result = mysqli_query($conn,$sql);

              while($row = mysqli_fetch_assoc($result)){
                $USER_ID = $row['USER_ID'];
                $USER_NAME = $row['USER_NAME'];
                $USER_PHONENUMBER = $row['USER_PHONENUMBER'];
                echo "
                    <tr>
                      <td>
                        {$USER_ID}
                      </td>
                      <td>
                        {$USER_NAME}
                      </td>
                      <td>
                        {$USER_PHONENUMBER}
                      </td>
                      <td>
                      <form method='POST' action='ticket_info.php'>
                        <input type='hidden' name='user' value='{$USER_ID}'>
                        <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='예약정보'>
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
