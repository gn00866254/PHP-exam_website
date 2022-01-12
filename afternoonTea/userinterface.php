<?php session_start(); ?>
<html>

<link href="assets/css/main.css" type="text/css" rel="stylesheet" />

<head>
  <title>Welcome User</title>
    <div class="head_up">
      <h1><img class ="logo" src="assets/images/icon.png"></h1>
    </div>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>
<?php
  if(isset($_SESSION['student_id'])){
    $user_id = $_SESSION['student_id'];
    require_once('includes/conn.php'); //使用 require_once 引入 conn.php 如果Success就會持續執行
    $query_str = "select student_name from student where student_id = '$user_id';";
    $result = $conn->query($query_str);
    $student_name = mysqli_fetch_row($result)[0];
    //echo $student_name;
    echo "<div class='head_down'>";
    echo "<div class='username'>Welcome $student_name <button class='logout'><img src='assets/images/logout_button.png' ></button></div>";
    echo '</div>'; 
  }
?>

    <div class="div_center">
        <div class="div_left">
            <button type="button" class="testbutton"><img src="assets/images/test_button.png"></img></button>
            <button type="button" class="gradebutton"><img src="assets/images/Grade.png"></img></button>
        </div>
        <div class="div_right" >
            
            <?php
                // 所有考試表單
                require_once('includes/conn.php'); //使用 require_once 引入 conn.php 如果Success就會持續執行
                $query_str = "select * from exampaper;";
                //echo $query_str ;
                $result = $conn->query($query_str);
                print("<form action='exampaper_b.php' method='POST'>");
                while ($row = $result->fetch_assoc()) {
                    printf( "<button type='submit' class='gototest' value = '%s' name='ex_id' > %s </input>",$row['exampaper_id'], $row['exampaper_name']);
                }
                print('</form>')
            ?>

        </div>
        <div style="clear:both"></div> 
    </div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>