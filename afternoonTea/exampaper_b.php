<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <form action='a.php' method='POST'>
    <?php
      $exampaper_id = $_POST['ex_id'];
      // echo $exampaper_id;
      require_once('includes/conn.php'); //使用 require_once 引入 conn.php 如果Success就會持續執行
    
      $query_str = "select exampaper_name from exampaper where exampaper_id = '$exampaper_id';";
      $result = $conn->query($query_str);
      $exampaper_name = mysqli_fetch_row($result)[0];
      printf("<h1 class='display-2'>%s</h1> </br>", $exampaper_name);

      $query_str = "SELECT * FROM question WHERE exampaper_id = '$exampaper_id';";
      //echo $query_str;
      $result = $conn->query($query_str);
      if (!$result) {
        die($conn->error);
      }
      $ans_array = array();  // 答案陣列

      $count = 0;
      while ($row = $result->fetch_assoc()) {
        print("<div class='card text-white bg-primary mb-3' style='max-width: 30rem;'>");
        $count_q = "Q. ".strval($count+1);
        print("<div class='card-header'> $count_q </div>");
        print("<div class='card-body'>");
        printf("<h5 class='card-title'> %s </h5>", $row["question_content"]);
        printf("<p class='card-text'>");
        $radio_name = "radio_name".strval($count+1);
        for ($i = 1; $i <= 4; $i++) {
          print("<div class='form-check'>");
          print("<input class='form-check-input' type='radio' name='$radio_name' id='exampleRadios1' value='option1'>");
          print("<label class='form-check-label' for='exampleRadios1'>");
          $question_options = "question_options".strval($i);
          print($row[$question_options]);
          print("</label></div>");
        }


        //$row["question_options1"],$row["question_options2"],$row["question_options3"],$row["question_options4"]
        print("</p></div></dsiv>");
        array_push($ans_array, $row["question_ans"]);
        $count++;
      }
      print_r($ans_array);
      print("<input type='hidden' value='$count' name='count_q'>");
      
    ?>
    <input type="submit" value="OK"/> 
    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

