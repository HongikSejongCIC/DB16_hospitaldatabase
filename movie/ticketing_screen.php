<?php session_start()?>
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
    <link rel="stylesheet" href="./ticketing_screen.css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript">
    function displayImage(elem) {
      var image = document.getElementById("canvas");
      image.src = "http://localhost/movie/image/"+elem.value+".jpg";
    }
    </script>
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
          echo "<p><a href='logout.php'>로그아웃</a></p>";
          echo "<p><a href='select_menu.php'>메뉴화면</a></p>";
          ?>

        </h2>

    </header>
    <article>
      <form action="end_ticketing.php" method="post">
  <!-- div0 ------------------------------------------------------------------>
        <div id="div0">

        </div>
  <!-- div0 ------------------------------------------------------------------>
  <!-- div1 ------------------------------------------------------------------>
        <div id="div1">
          <table>
            <tr>
              <th colspan="3">
                예약정보입력
              </th>
            </tr>
            <tr>
              <td>
                극장 :
              </td>
              <td>
                <select name = "theatername">
                  <?php
                    $sql = "select theatername from theater_info";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='{$row["theatername"]}'>{$row["theatername"]}</option>";
                    }
                   ?>
                </select>
              </td>
              <td rowspan="5">
                <input type="submit" name="div3" value="예약" >
              </td>
            </tr>
            <tr>
              <td>
                영화 :
              </td>
              <td>
                <select name = "moviename" onchange="displayImage(this);">
                  <?php
                    $sql = "select distinct moviename from movie_info";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='{$row["moviename"]}'>{$row["moviename"]}</option>";
                    }
                   ?>
                </select>
              </td>
              <td>

              </td>
            </tr>
            <tr>
              <td>
                시간 :
              </td>
              <td>
                <select name = "screeningtime">
                  <?php
                    $sql = "select distinct screeningtime from movie_info";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='{$row["screeningtime"]}'>{$row["screeningtime"]}</option>";
                    }
                   ?>
                </select>
              </td>
              <td>

              </td>
            </tr>
            <tr>
              <td>
                가로열 :
              </td>
              <td>
                <select name = "seat_row">
                 <?php
                   $sql = "select distinct row from seat_info";
                   $result = mysqli_query($conn,$sql);
                   while ($row = mysqli_fetch_assoc($result)) {
                     echo "<option value='{$row["row"]}'>{$row["row"]}</option>";
                   }
                  ?>
                </select>
              </td>
              <td>

              </td>
            </tr>
            <tr>
              <td>
                세로열 :
              </td>
              <td>
                <select name = "seat_col">
                 <?php
                   $sql = "select distinct col from seat_info";
                   $result = mysqli_query($conn,$sql);
                   while ($row = mysqli_fetch_assoc($result)) {
                     echo "<option value='{$row["col"]}'>{$row["col"]}</option>";
                   }
                  ?>
                </select>
              </td>
              <td>

              </td>
            </tr>
            <tr>
              <td colspan="3">
                <img src="./seat.png" alt="좌석" width="100%" />
              </td>
            </tr>
          </table>
        </div>
  <!-- div1 ------------------------------------------------------------------>
  <!-- div2 ------------------------------------------------------------------>
        <div id="div2">
          <img id="canvas" src="./image/시빌워.jpg" height="100%"/>
        </div>
  <!-- div2 ------------------------------------------------------------------>
  <!-- div3 ------------------------------------------------------------------>
        <div id="div3">

        </div>
  <!-- div3 ------------------------------------------------------------------>
      </form>
    </article>
  </body>
</html>
