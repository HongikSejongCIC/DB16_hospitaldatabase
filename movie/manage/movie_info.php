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
              echo "<p>영화정보를 수정합니다.</p>";
              ?>
            </h2>
        </header>
        <article>

          <table>
            <tr>
              <th>
                영화제목
              </th>
              <th>
                상영관이름
              </th>
              <th>
                상영시간
              </th>
              <th>
                영화추가
              </th>
            </tr>
            <?php
                echo "
                  <form method='POST' action='./insert/insert_movie.php'>
                    <tr>
                      <td>
                        <input type='text' name='moviename' style='width:100px;'  placeholder='영화제목'>
                      </td>
                      <td>
                        <input type='text' name='hallname' style='width:100px;'  placeholder='상영관'>
                      </td>
                      <td>
                        <input type='text' name='screeningtime' style='width:100px;'  placeholder='상영시간'>
                      </td>
                      <td>
                        <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='영화추가'  >
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
                영화제목
              </th>
              <th>
                상영관이름
              </th>
              <th>
                상영시간
              </th>
              <th>
                영화삭제
              </th>
            </tr>
            <?php
              $sql = "SELECT * FROM movie_info";    //입력된 아이디의 예약상태를 알아냄.
              $result = mysqli_query($conn,$sql);

              while($row = mysqli_fetch_assoc($result)){
                $M_ID = $row['M_ID'];
                $moviename = $row['moviename'];
                $hallname = $row['hallname'];
                $screeningtime = $row['screeningtime'];
                echo "
                    <tr>
                      <td>
                        {$M_ID}
                      </td>
                      <td>
                        {$moviename}
                      </td>
                      <td>
                        {$hallname}
                      </td>
                      <td>
                        {$screeningtime}
                      </td>
                      <td>
                      <form method='POST' action='delete/delete_movie.php'>
                        <input type='hidden' name='movie' value='{$M_ID}'>
                        <input type='submit' style='width:80px; height:30px; background-color:yellow; border-color:pink; border-radius:30px;' value='영화삭제'>
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
