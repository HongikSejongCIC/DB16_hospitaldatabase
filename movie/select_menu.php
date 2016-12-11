<?php session_start()?>
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
        <link rel="stylesheet" href="./ticketing_screen.css" media="screen" title="no title" charset="utf-8">
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
              ?>
            </h2>
        </header>
        <article>
          <div id = "select_button">
            <input type="button" style="width:200px; height:200px; background-color:pink; border-color:pink; border-radius:30px;" onclick="location.href='./ticketing_screen.php'"; value="영화예약" >
            <input type="button" style="width:200px; height:200px; background-color:pink; border-color:pink; border-radius:30px;" onclick="location.href='./ticket_list_screen.php'"; value="예약확인" >
          </div>
        </article>
      </body>
    </html>

  </body>
</html>
